<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\LogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('comment', CommentController::class);
Route::apiResource('user', UserController::class);

// Route::group(['middleware' => 'auth_manager'], function () {
    Route::get('/log', [LogController::class, 'export'])->name('export-log');
// });

