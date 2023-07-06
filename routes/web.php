<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentTableController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/comment/{Comment_table}', [CommentTableController::class, 'index']);