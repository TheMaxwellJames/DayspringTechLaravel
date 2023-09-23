<?php

namespace App\Http\Controllers;

use App\Mail\ForgotMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\RegisterMail;
use Hash;
use Mail;
use Str;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function register()
    {
        return view('auth.register');
    }



    public function forgot()
    {
        return view('auth.forgot');
    }


    public function forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->save();


            Mail::to($user->email)->send(new ForgotMail($user));

            return redirect()->back()->with('success', "Check your email and reset password");
        } else {
            return redirect()->back()->with('error', "Email does  not exist");
        }
    }


    public function reset($token)
    {
        $user = User::where('remember_token', $token)->first();
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }


    public function reset_password($token, Request $request)
    {
        $user = User::where('remember_token', $token)->first();
        if (!empty($user))
        {
            if($request->password == $request->cpassword)
            {

                $user->password = Hash::make($request->password);
                if(empty( $user->email_verified_at))
                {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                }

                $user->remember_token = Str::random(40);
                $user->save();

                return redirect('login')->with('success', "Password Successfully reset");
            }
            else
            {
                return redirect()->back()->with('error', "Password and confirm password does not match");
            }
        }
        else
        {
            abort(404);
        }
    } 




    public function create_user(Request $request)
    {

        request()->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);


        $save = new User;

        // Trim and assign values
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->remember_token = Str::random(40);


        $save->save();

        Mail::to($save->email)->send(new RegisterMail($save));
        return redirect('login')->with('success', "A Verification Link Has Been sent To Your Mail, Please Click On It To Verify");
    }




    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();

        if (!empty($user)) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect('login')->with('success', "Your Account Is Verified || Please Log In");
        } else {
            abort(404);
        }
    }


    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if (!empty(Auth::user()->email_verified_at)) {
                echo "success";
            } else {

                $user_id = Auth::user()->id;
                Auth::logout();


                $save = User::getSingle($user_id);

                // Trim and assign values

                $save->remember_token = Str::random(40);


                $save->save();



                Mail::to($save->email)->send(new RegisterMail($save));

                return redirect()->back()->with('success', " Please verify your email address ");
            }
        } else {
            return redirect()->back()->with('error', "Please enter the correct email and password");
        }
    }
}
