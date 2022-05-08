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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [ClientController::class, 'login'])->name('login');

Route::get('register', [ClientController::class, 'register'])->name('register');

Route::get('forgotpass', [ClientController::class, 'forgotPass'])->name('forgotpass');
