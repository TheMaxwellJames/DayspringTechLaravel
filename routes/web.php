<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'home']);

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'auth_login']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'create_user']);

Route::get('verify/{token}', [AuthController::class, 'verify']);

Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'reset_password']);


Route::get('forgot-password', [AuthController::class, 'forgot']);
Route::post('forgot-password', [AuthController::class, 'forgot_password']);








Route::group(['middleware' => 'adminuser'], function(){

    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('panel/user/list', [UserController::class, 'user']);


});

