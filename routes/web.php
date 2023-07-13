<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentTableController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerAuthController;

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


Route::get('/', [CommentTableController::class, 'index'])->name('home');
Route::get('/auth', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth_user'], function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// manage page
Route::get('/manage', [ManagerAuthController::class, 'showManagePage'])->name('manage');
Route::post('/manage', [ManagerAuthController::class, 'login'])->name('manage_login');
Route::get('/manage/log', [ManagerAuthController::class, 'showLogRecordPage'])->name('manage_logRecord');
Route::get('/manage/account/superManager', [ManagerAuthController::class, 'showSuperManagerdPage'])->name('manage_supaerManager');
Route::get('/manage/account/LV1Manager', [ManagerAuthController::class, 'showLV1ManagerdPage'])->name('manage_LV1Manager');

Route::group(['middleware' => 'auth_manager'], function () {
    Route::get('/manage_logout', [ManagerAuthController::class, 'logout'])->name('manage_logout');
});
