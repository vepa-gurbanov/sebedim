<?php

use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\Auth\VerificationController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest:customer_web')
    ->group(function () {
        Route::controller(LoginController::class)
            ->group(function () {
                Route::get('/login', 'create')->name('login');
                Route::post('/login', 'store');
            });

        Route::controller(RegisterController::class)
            ->group(function () {
                Route::get('/register', 'create')->name('register');
                Route::post('/register', 'store');
            });

        Route::controller(VerificationController::class)
            ->group(function () {
                Route::get('/verify/{token}/', 'create')->name('verify');
                Route::post('/verify/{token}/', 'store');
            });
    });

Route::middleware('auth:customer_web')
    ->group(function () {
        Route::controller(LoginController::class)
            ->group(function () {
                Route::post('/logout', 'destroy')->name('logout');
            });
    });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(ProductController::class)
    ->prefix('products')
    ->name('products')
    ->group(function () {
        Route::get('', 'index')->name('.index');
        Route::get('/create', 'create')->name('.create');
        Route::post('', 'store')->name('.store');
        Route::get('/{slug}', 'show')->name('.show');
        Route::get('/{slug}/edit', 'edit')->name('.edit');
        Route::put('/{slug}', 'update')->name('.update');
        Route::delete('/{slug}', 'destroy')->name('.destroy');
    });

