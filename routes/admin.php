<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->group(function () {
    // Authentication
    // Route::group(['controller' => AdminController::class], function () {
    //     Route::get('/login', 'loginPage')->name('login');
    //     Route::post('/login', 'login')->name('doLogin');
    //     Route::post('/logout', 'logout')->middleware('admin.auth')->name('logout');
    //     Route::get('/forgot-password', 'forgotPasswordPage')->name('forgotPassword');
    //     Route::post('/forgot-password', 'forgotPassword')->name('doForgotPassword');
    //     Route::get('/reset-password/{token}', 'resetPasswordPage')->name('resetPassword');
    //     Route::post('/reset-password', 'resetPassword')->name('doResetPassword');
    // });

    // Dashboard
    // Route::get('/', [DashboardController::class, 'root'])->name('root');
    // Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('admin.auth')->name('dashboard');

    // Users
    Route::group(['prefix' => 'users', 'middleware' => ['admin.auth'], 'controller' => UserController::class], function () {
        Route::get('/', 'list')->name('usersList');
        Route::get('/{id}', 'details')->name('userDetails');
        Route::get('/{id}/download-qr', 'downloadQr')->name('userQrDownload');
        Route::post('/{id}/toggle-block', 'toggleBlock')->name('userToggleBlock');
    });

    // Countries
    // Route::group(['prefix' => 'countries', 'middleware' => ['admin.auth'], 'controller' => CountryController::class], function () {
    //     Route::get('/', 'list')->name('countriesList');
    //     Route::post('/{id}/toggle-kyc', 'toggleKyc')->name('countryToggleKyc');
    // });

    // Admins
    // Route::group(['prefix' => 'admins', 'middleware' => ['admin.auth'], 'controller' => AdminController::class], function () {
    //     Route::get('/', 'list')->name('adminsList');
    //     Route::get('/create', 'createPage')->name('adminCreatePage');
    //     Route::post('/create', 'create')->name('adminCreate');
    //     Route::get('/{id}/edit', 'editPage')->name('adminEditPage');
    //     Route::post('/{id}/edit', 'edit')->name('adminEdit');
    //     Route::post('/{id}/delete', 'delete')->name('adminDelete');
    // });
});
