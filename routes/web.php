<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForecastController;
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
    return redirect()->route('forecast.view');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showSignup'])->name('register.form');
    Route::post('register', [AuthController::class, 'signUp'])->name('register');
    Route::get('login', [AuthController::class, 'showLogin'])->name('login.form');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('forecast', [ForecastController::class, 'forecastShow'])->name('forecast.view');
    Route::post('forecast', [ForecastController::class, 'forecastGet'])->name('forecast.get');
});
