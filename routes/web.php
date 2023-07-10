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

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/auth', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/manage', function () {
    return view('manage');
})->name('manage');

Route::post('/manage', [ManagerAuthController::class, 'login'])->name('manage_login');
Route::post('/manage_logout', [ManagerAuthController::class, 'logout'])->name('manage_logout');
