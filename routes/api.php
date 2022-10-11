<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\PayController;
use Illuminate\Http\Request;
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

Route::post('/users/register', [ApiController::class, 'register']);

Route::post('/users/login', [ApiController::class, 'login']);

Route::post('/users/forgotpassword', [ApiController::class, 'forgotPass']);

Route::post('/pay/genpay', [PayController::class, 'pay']);

Route::post('/pay/checkpay', [PayController::class, 'checkPay']);

Route::post('/pay/auth', [PayController::class, 'auth']);

Route::post('/pay/test', [PayController::class, 'test']);