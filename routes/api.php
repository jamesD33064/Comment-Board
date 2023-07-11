<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api as api;

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

Route::apiResource('comment', api\CommentController::class);
Route::apiResource('user', api\UserController::class);

Route::get('/log', [api\LogController::class, 'export'])->name('export-log');
Route::get('/Top10_ActiviteUser', [api\CommentController::class, 'Top10_ActiviteUser'])->name('Top10_ActiviteUser');

