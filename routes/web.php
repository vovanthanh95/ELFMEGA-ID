<?php

use App\Http\Controllers\AccumulatController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AppClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckOnlineController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientChangeController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\GiftCodeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PayController;
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


Route::group(['middleware' => 'locale'], function () {
    Route::get('/change-language/{language}', [LocaleController::class, 'setLocale'])->name('change-language');

    Route::middleware('loginclient')->get('/', [ClientController::class, 'index']);
    Route::middleware('loginclient')->get('/account', [ClientController::class, 'index'])->name('account');

    Route::get('register', [ClientAuthController::class, 'register'])->name('register');
    Route::post('register', [ClientAuthController::class, 'postRegister'])->name('post-register');

    Route::get('login', [ClientAuthController::class, 'login'])->name('login');
    Route::post('login', [ClientAuthController::class, 'postLogin'])->name('post-login');
    Route::middleware('loginclient')->get('logout', [ClientAuthController::class, 'logout'])->name('logout');

    Route::get('reloadCaptcha', [AjaxController::class, 'reloadCaptcha'])->name('reload-captcha');

    Route::get('forgot-pass', [ClientChangeController::class, 'forgotPass'])->name('forgot-pass');
    Route::post('forgot-pass', [ClientChangeController::class, 'postForgotPass'])->name('post-forgot-pass');


    Route::middleware('loginclient')->get('change-pass', [ClientChangeController::class, 'changePass'])->name('change-pass');
    Route::middleware('loginclient')->post('change-pass', [ClientChangeController::class, 'postChangePass'])->name('post-change-pass');

    Route::middleware('loginclient')->get('update-email', [ClientChangeController::class, 'updateEmail'])->name('update-email');
    Route::middleware('loginclient')->post('update-email', [ClientChangeController::class, 'postUpdateEmail'])->name('post-update-email');

    Route::middleware('loginclient')->get('update-phone', [ClientChangeController::class, 'updatePhone'])->name('update-phone');
    Route::middleware('loginclient')->post('update-phone', [ClientChangeController::class, 'postUpdatePhone'])->name('post-update-phone');

    Route::middleware('loginclient')->get('top-up-vn', [TopUpController::class, 'topUpVn'])->name('top-up-vn');
    Route::middleware('loginclient')->post('top-up-vn', [TopUpController::class, 'postTopUpVn'])->name('post-top-up-vn');
    Route::middleware('loginclient')->get('top-up-banking', [TopUpController::class, 'topUpBanking'])->name('top-up-banking');
    Route::middleware('loginclient')->get('top-up-mo-mo', [TopUpController::class, 'topUpMoMo'])->name('top-up-mo-mo');
    Route::middleware('loginclient')->get('selection-top-up', [TopUpController::class, 'selectiontopup'])->name('selection-top-up');

    Route::middleware('loginclient')->get('accumulat', [AccumulatController::class, 'index'])->name('accumulat');
    Route::middleware('loginclient')->post('get-award-accumulat', [AccumulatController::class, 'getAwardByAccumulat'])->name('get-award-accumulat');
    Route::middleware('loginclient')->post('get-giftcode-accumulat', [AccumulatController::class, 'getGiftCode'])->name('get-giftcode-accumulat');

    Route::get('history', [HistoryController::class, 'history'])->name('history');
    Route::post('ajaxhistory', [AjaxController::class, 'ajaxHistory'])->name('ajax-history');

    Route::get('test', [AccumulatController::class, 'test'])->name('test');
});


//callbacktopup
Route::get('/call-back-top-up/{Code?}/{Mess?}/{Reason?}/{CardValue?}/{TrxID?}', [TopUpController::class, 'callBackTopUp'])->name('call-back-top-up');

// check online
Route::get('checkonline/{num?}/{svr?}', [CheckOnlineController::class, 'index']);
