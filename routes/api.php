<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CircleController;

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



Route::post('/authenticate', [AuthController::class, 'authenticate']);

Route::post('/verify_code', [AuthController::class, 'verify_code']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/get_circles', [CircleController::class, 'get_circles']);
});
