<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controller;
use App\Consts\GateConst;
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

Route::redirect('/', '/login');

Route::get('/login', [Controller\Auth\LoginController::class, 'showLoginForm'])->name('login-form');
Route::post('/login', [Controller\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [Controller\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/password_forgot', [Controller\PasswordForgotController::class, 'showEmailInputForm'])->name('password_forgot');
Route::post('/password_forgot', [Controller\PasswordForgotController::class, 'receiveEmailAddress'])->name('address_receive');
Route::get('/password_reset/{token}/{email}', [Controller\PasswordForgotController::class, 'passwordResetForm'])->name('password_reset_form');
Route::post('/password_reset', [Controller\PasswordForgotController::class, 'passwordReset'])->name('password_reset');

// ユーザ
Route::group(['middleware' => ['auth', 'can:' . GateConst::USER_HIGHER]], function () {
    Route::get('/home', [Controller\HomeController::class, 'index'])->name('home');

    Route::get('/login_info', [Controller\LoginInfoController::class, 'index'])->name('login_info');
    Route::post('/login_info/update', [Controller\LoginInfoController::class, 'update'])->name('login_info-update');
    Route::get('/login_info/change_email/', [Controller\LoginInfoController::class, 'changeEmailForm'])->name('login_info-change_email_form');
    Route::get('/login_info/authentication_code/', [Controller\LoginInfoController::class, 'authenticationCodeForm'])->name('login_info-authentication_code_form');
    Route::post('/login_info/change_email/', [Controller\LoginInfoController::class, 'changeEmail'])->name('login_info-change_email');

    Route::get('/profile', [Controller\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [Controller\ProfileController::class, 'update'])->name('profile-update');

    Route::get('/attendance', [Controller\AttendanceController::class, 'index'])->name('attendance');
    Route::post('/attendance/create', [Controller\AttendanceController::class, 'create'])->name('attendance-create');
 
    Route::get('/task', [Controller\TaskController::class, 'index'])->name('task');
    Route::post('/task/fetch', [Controller\TaskController::class, 'fetch'])->name('task-fetch');
    Route::get('/task/create', [Controller\TaskController::class, 'createModal'])->name('task-createModal');
    Route::post('/task/create', [Controller\TaskController::class, 'create'])->name('task-create');
    Route::get('/task/update', [Controller\TaskController::class, 'updateModal'])->name('task-updateModal');
    Route::post('/task/update', [Controller\TaskController::class, 'update'])->name('task-update');
    Route::post('/task/delete', [Controller\TaskController::class, 'delete'])->name('task-delete');
    Route::get('/task/task_color', [Controller\TaskController::class, 'taskColorModal'])->name('task-taskColorModal');
    Route::post('/task/task_color/create', [Controller\TaskController::class, 'createTaskColor'])->name('task-createTaskColor');
    Route::post('/task/task_color/update', [Controller\TaskController::class, 'updateTaskColor'])->name('task-updateTaskColor');
    Route::post('/task/task_color/delete', [Controller\TaskController::class, 'deleteTaskColor'])->name('task-deleteTaskColor');
});

// 管理者
Route::group(['middleware' => ['auth', 'can:' . GateConst::ADMIN_HIGHER]], function () {
    Route::get('/user', [Controller\UserController::class, 'index'])->name('user');
    Route::get('/user/create', [Controller\UserController::class, 'createForm'])->name('user-create_form');
    Route::post('/user/create', [Controller\UserController::class, 'create'])->name('user-create');
    Route::get('/user/update/{id}', [Controller\UserController::class, 'updateForm'])->name('user-update_form');
    Route::post('/user/update', [Controller\UserController::class, 'update'])->name('user-update');
    Route::post('/user/delete', [Controller\UserController::class, 'delete'])->name('user-delete');
    Route::post('/user/change_is_valid', [Controller\UserController::class, 'changeIsValid'])->name('user-change_is_valid');
});

// システム管理者
Route::group(['middleware' => ['auth', 'can:' . GateConst::SYSTEM]], function () {
});
