<?php

use App\Http\Controllers\Api\Posts\CreatePostController;
use App\Http\Controllers\Api\Subscriptions\SubscribeUserController;
use Illuminate\Support\Facades\Route;

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

Route::post('subscriptions', SubscribeUserController::class);
Route::post('posts', CreatePostController::class);