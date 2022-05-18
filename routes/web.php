<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ClientController;
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
Route::get('/test', [ClientController::class, 'test']);

Route::middleware('loginclient')->get('/', [ClientController::class, 'index'])->name('account');

Route::get('login', [ClientController::class, 'login'])->name('login');
Route::post('login', [ClientController::class, 'postLogin'])->name('post-login');
Route::middleware('loginclient')->get('logout', [ClientController::class, 'logout'])->name('logout');

Route::get('register', [ClientController::class, 'register'])->name('register');
Route::post('register', [ClientController::class, 'postRegister'])->name('post-register');
Route::get('reloadCaptcha', [ClientController::class, 'reloadCaptcha'])->name('reload-captcha');

Route::get('forgot-pass', [ClientController::class, 'forgotPass'])->name('forgot-pass');
Route::post('forgot-pass', [ClientController::class, 'postForgotPass'])->name('post-forgot-pass');

Route::middleware('loginclient')->get('change-pass', [ClientController::class, 'changePass'])->name('change-pass');
Route::middleware('loginclient')->post('change-pass', [ClientController::class, 'postChangePass'])->name('post-change-pass');

Route::middleware('loginclient')->get('change-email', [ClientController::class, 'changeEmail'])->name('change-email');
Route::middleware('loginclient')->post('change-email', [ClientController::class, 'postChangeEmail'])->name('post-change-email');

Route::middleware('loginclient')->get('change-phone', [ClientController::class, 'changePhone'])->name('change-phone');
Route::middleware('loginclient')->post('change-phone', [ClientController::class, 'postChangePhone'])->name('post-change-phone');

Route::middleware('loginclient')->get('top-up', [ClientController::class, 'topUp'])->name('top-up');

Route::middleware('loginclient')->get('gift-code', [ClientController::class, 'giftCode'])->name('gift-code');
Route::post('ajax-show-role', [AjaxController::class, 'showRole'])->name('ajax-show-role');
Route::middleware('loginclient')->post('gift-code', [ClientController::class, 'postGiftCode'])->name('post-gift-code');

Route::middleware('loginclient')->get('top-up-vn', [ClientController::class, 'topUpVn'])->name('top-up-vn');

Route::middleware('loginclient')->get('top-up-mo-mo', [ClientController::class, 'topUpMoMo'])->name('top-up-mo-mo');

Route::get('history', [ClientController::class, 'history'])->name('history');
Route::post('ajaxhistory', [ClientController::class, 'ajaxHistory'])->name('ajax-history');

