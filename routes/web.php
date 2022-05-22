<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientChangeController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\GiftCodeController;
use App\Http\Controllers\HistoryController;
use App\Mail\ForgotPassEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
Route::middleware('loginclient')->get('/', [ClientController::class, 'index']);
Route::middleware('loginclient')->get('/account', [ClientController::class, 'index'])->name('account');

Route::get('login', [ClientAuthController::class, 'login'])->name('login');
Route::post('login', [ClientAuthController::class, 'postLogin'])->name('post-login');
Route::middleware('loginclient')->get('logout', [ClientAuthController::class, 'logout'])->name('logout');

Route::get('register', [ClientAuthController::class, 'register'])->name('register');
Route::post('register', [ClientAuthController::class, 'postRegister'])->name('post-register');
Route::get('reloadCaptcha', [AjaxController::class, 'reloadCaptcha'])->name('reload-captcha');

Route::get('forgot-pass', [ClientChangeController::class, 'forgotPass'])->name('forgot-pass');
Route::post('forgot-pass', [ClientChangeController::class, 'postForgotPass'])->name('post-forgot-pass');

Route::middleware('loginclient')->get('change-pass', [ClientChangeController::class, 'changePass'])->name('change-pass');
Route::middleware('loginclient')->post('change-pass', [ClientChangeController::class, 'postChangePass'])->name('post-change-pass');

Route::middleware('loginclient')->get('change-email', [ClientChangeController::class, 'changeEmail'])->name('change-email');
Route::middleware('loginclient')->post('change-email', [ClientChangeController::class, 'postChangeEmail'])->name('post-change-email');

Route::middleware('loginclient')->get('change-phone', [ClientChangeController::class, 'changePhone'])->name('change-phone');
Route::middleware('loginclient')->post('change-phone', [ClientChangeController::class, 'postChangePhone'])->name('post-change-phone');

Route::middleware('loginclient')->get('top-up', [TopUpController::class, 'topUp'])->name('top-up');

Route::middleware('loginclient')->get('gift-code', [GiftCodeController::class, 'giftCode'])->name('gift-code');
Route::post('ajax-show-role', [AjaxController::class, 'showRole'])->name('ajax-show-role');
Route::middleware('loginclient')->post('gift-code', [GiftCodeController::class, 'postGiftCode'])->name('post-gift-code');

Route::middleware('loginclient')->get('top-up-vn', [TopUpController::class, 'topUpVn'])->name('top-up-vn');
Route::middleware('loginclient')->post('top-up-vn', [TopUpController::class, 'postTopUpVn'])->name('post-top-up-vn');

Route::middleware('loginclient')->get('top-up-mo-mo', [TopUpController::class, 'topUpMoMo'])->name('top-up-mo-mo');

Route::get('history', [HistoryController::class, 'history'])->name('history');
Route::post('ajaxhistory', [AjaxController::class, 'ajaxHistory'])->name('ajax-history');

//callbacktopup
Route::get('/call-back-top-up/{Code?}/{Mess?}/{Reason?}/{CardValue?}/{TrxID?}', [TopUpController::class, 'callBackTopUp'])->name('call-back-top-up');
