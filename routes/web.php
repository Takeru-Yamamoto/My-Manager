<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controller;
use App\Consts\ContentConst;
use App\Consts\RoleConst;
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

if (config("application.required_login")) {
    Route::redirect('/', '/login');
} else {
    Route::redirect('/', '/home');
}

Route::get('/login', [Controller\Auth\LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [Controller\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [Controller\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/password_forgot', [Controller\PasswordForgotController::class, 'showEmailInputForm'])->name('showEmailInputForm');
Route::post('/password_forgot', [Controller\PasswordForgotController::class, 'receiveEmailAddress'])->name('receiveEmailAddress');
Route::get('/password_reset/{token}/{email}', [Controller\PasswordForgotController::class, 'passwordResetForm'])->name('passwordResetForm');
Route::post('/password_reset', [Controller\PasswordForgotController::class, 'passwordReset'])->name('passwordReset');

if (!config("application.required_login")) {
    Route::get('/home', [Controller\HomeController::class, 'index'])->name('home');
}

Route::group(['middleware' => 'auth'], function () {
    if (config("application.required_login")) {
        Route::get('/home', [Controller\HomeController::class, 'index'])->name('home');
    }

    Route::post('/search', [Controller\SearchController::class, 'search'])->name('search');

    // ユーザ
    Route::group(['middleware' => ['can:' . RoleConst::USER_HIGHER]], function () {
        Route::group(["prefix" => ContentConst::LOGIN_INFO_URL, "as" => ContentConst::LOGIN_INFO . "."], function () {
            Route::get('/', [Controller\LoginInfoController::class, 'index'])->name('index');
            Route::post('/update', [Controller\LoginInfoController::class, 'update'])->name('update');
            Route::get('/change_email', [Controller\LoginInfoController::class, 'changeEmailForm'])->name('changeEmailForm');
            Route::get('/authentication_code', [Controller\LoginInfoController::class, 'authenticationCodeForm'])->name('authenticationCodeForm');
            Route::post('/change_email', [Controller\LoginInfoController::class, 'changeEmail'])->name('changeEmail');
        });

        Route::group(["prefix" => ContentConst::ATTENDANCE_URL, "as" => ContentConst::ATTENDANCE . "."], function () {
            Route::get('/', [Controller\AttendanceController::class, 'index'])->name('index');
            Route::post('/create', [Controller\AttendanceController::class, 'create'])->name('create');
        });

        Route::group(["prefix" => ContentConst::TASK_URL, "as" => ContentConst::TASK . "."], function () {
            Route::get('/', [Controller\TaskController::class, 'index'])->name('index');
            Route::post('/fetch', [Controller\TaskController::class, 'fetch'])->name('fetch');
            Route::get('/create', [Controller\TaskController::class, 'createModal'])->name('createModal');
            Route::post('/create', [Controller\TaskController::class, 'create'])->name('create');
            Route::get('/update', [Controller\TaskController::class, 'updateModal'])->name('updateModal');
            Route::post('/update', [Controller\TaskController::class, 'update'])->name('update');
            Route::post('/delete', [Controller\TaskController::class, 'delete'])->name('delete');
        });

        Route::group(["prefix" => ContentConst::TASK_COLOR_URL, "as" => ContentConst::TASK_COLOR . "."], function () {
            Route::get('/', [Controller\TaskColorController::class, 'index'])->name('index');
            Route::post('/create', [Controller\TaskColorController::class, 'create'])->name('create');
            Route::post('/update', [Controller\TaskColorController::class, 'update'])->name('update');
            Route::post('/delete', [Controller\TaskColorController::class, 'delete'])->name('delete');
        });
    });

    // 管理者
    Route::group(['middleware' => ['can:' . RoleConst::ADMIN_HIGHER]], function () {
        Route::group(["prefix" => ContentConst::USER_URL, "as" => ContentConst::USER . "."], function () {
            Route::get('/', [Controller\UserController::class, 'index'])->name('index');
            Route::get('/create', [Controller\UserController::class, 'createForm'])->name('createForm');
            Route::post('/create', [Controller\UserController::class, 'create'])->name('create');
            Route::get('/update/{id}', [Controller\UserController::class, 'updateForm'])->name('updateForm');
            Route::post('/update', [Controller\UserController::class, 'update'])->name('update');
            Route::post('/delete', [Controller\UserController::class, 'delete'])->name('delete');
            Route::post('/change_is_valid', [Controller\UserController::class, 'changeIsValid'])->name('changeIsValid');
        });

        Route::group(["prefix" => ContentConst::ATTENDANCE_URL, "as" => ContentConst::ATTENDANCE . "."], function () {
            Route::get('/admin', [Controller\AttendanceController::class, 'adminIndex'])->name('adminIndex');
        });
    });

    // システム管理者
    Route::group(['middleware' => ['can:' . RoleConst::SYSTEM]], function () {
    });
});
