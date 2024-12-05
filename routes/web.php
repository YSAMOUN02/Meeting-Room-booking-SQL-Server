<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RoomController;
use PhpParser\Builder\Class_;
use App\Http\Controllers\Frontend\bookingRoomController;
use App\Http\Controllers\Frontend\AdminController;

use App\Http\Controllers\Backend\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Public Access
Route::get('/login',[AdminController::class, 'login'])->name('login');

Route::get('/forgot/password',[AdminController::class, 'forgot_password']);

Route::post('/login/submit', [AdminController::class, 'login_submit']);

Route::get('/forgot/password/via/{username}/{code}',[AdminController::class, 'forgot_password_with_user']);

Route::get('/',[RoomController::class, 'all_room']);

Route::get('/room/detail/{id}',[RoomController::class, 'room_detail']);

Route::middleware(['auth'])->group(function () {

    // Access Booking
    Route::POST('/room/detial/store',[bookingRoomController::class, 'new_booking']);

    // Booked Data
    Route::get('/list/room/booked',[bookingRoomController::class, 'booked_room']);

    Route::get('/list/history/booked',[bookingRoomController::class, 'booked_room_history']);

    // Room

    Route::get('/room/add',[RoomController::class, 'add_room']);

    Route::get('/room/list',[RoomController::class, 'list_room']);

    Route::POST('/room/cancel',[bookingRoomController::class, 'cancel_booking']);

    Route::post('/room/update/submit',[RoomController::class, 'update_room_submit']);

    Route::post('/room/delete/submit',[RoomController::class, 'delete_room_submit']);

    Route::post('/room/create/submit',[RoomController::class, 'create_room_submit']);

    // User
    Route::get('/list/user/{page}',[UserController::class, 'list_user']);

    Route::post('/user/delete/submit',[UserController::class, 'delete_user_submit']);

    Route::post('/user/update/submit',[UserController::class, 'update_user']);

    Route::post('/user/update/profile/submit',[UserController::class, 'update_user_profile']);

    Route::get('/user/create', [UserController::class, 'create_user_form']);

    Route::post('/user/create/submit', [UserController::class, 'create_user_submit']);

    Route::get('/user/profile',[UserController::class, 'my_profile']);

    Route::get('/logout', [AdminController::class, 'logout']);


    // Test
    Route::get('/user/send', [AdminController::class, 'register_mail']);

});

