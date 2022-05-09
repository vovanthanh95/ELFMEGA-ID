<?php

use App\Http\Controllers\ClientController;
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

Route::get('/', [ClientController::class, 'index'])->name('account');

Route::get('login', [ClientController::class, 'login'])->name('login');
Route::post('login', [ClientController::class, 'postLogin'])->name('post-login');

Route::get('register', [ClientController::class, 'register'])->name('register');

Route::get('forgot-pass', [ClientController::class, 'forgotPass'])->name('forgot-pass');

Route::get('change-pass', [ClientController::class, 'changePass'])->name('change-pass');

Route::get('change-email', [ClientController::class, 'changeEmail'])->name('change-email');

Route::get('change-phone', [ClientController::class, 'changePhone'])->name('change-phone');

Route::get('top-up', [ClientController::class, 'topUp'])->name('top-up');

Route::get('top-up-vn', [ClientController::class, 'topUpVn'])->name('top-up-vn');

Route::get('top-up-mo-mo', [ClientController::class, 'topUpMoMo'])->name('top-up-mo-mo');
