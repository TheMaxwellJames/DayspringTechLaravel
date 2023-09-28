<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user()
    {
        $data['getRecord'] = User::getRecordUser();
        return view('backend.user.list', $data);
    }



    public function add_user(Request $request)
    {
        return view('backend.user.add');
    }



    public function insert_user(Request $request)
    {
        request()->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);


       $save = new User;
       $save ->name = trim($request->name);
       $save ->email = trim($request->email);
       $save ->password = Hash::make($request->password);
       $save ->status = trim($request->status);

       $save->save();

       return redirect('panel/user/list')->with('success', "User successfully created");

    }



    public function edit_user($id)
    {
        $data['getRecord'] = User::getSingle($id);
        return view('backend.user.edit', $data);
    }



    public function update_user($id, Request $request )
    {
        request()->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email,'.$id

        ]);


        $save = User::getSingle($id);
        $save ->name = trim($request->name);
        $save ->email = trim($request->email);
        if(!empty($request->password))
        {
            $save ->password = Hash::make($request->password);
        }

        $save ->status = trim($request->status);

        $save->save();

        return redirect('panel/user/list')->with('success', "User successfully updated");
    }



    public function delete_user($id)
    {
        $save = User::getSingle($id);

        $save->is_delete = 1;

       $save->save();


        return redirect('panel/user/list')->with('success', "User successfully deleted");
    }

}
