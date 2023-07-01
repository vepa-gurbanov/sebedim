<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
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

Route::name('admin')
    ->prefix('admin')
    ->group(function () {
        Route::middleware('guest')
            ->group(function () {
                Route::get('/auth/login', [LoginController::class, 'create'])
                    ->name('.auth.login');

                Route::post('/auth/login', [LoginController::class, 'store']);

                Route::get('/auth/verify/{id}', [LoginController::class, 'verification'])
                    ->name('.auth.verify');

                Route::post('/auth/verify/{id}', [LoginController::class, 'verify'])
                    ->where('id', '[0-9]+');
            });

        Route::middleware(['auth'])
            ->group(function () {
                Route::post('/auth/logout', [LoginController::class, 'destroy'])->name('.auth.logout');
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('.dashboard');
            });
    });
