<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('companies.index');
    });

    Route::resource('companies', CompanyController::class);
    Route::resource('shops', ShopController::class);

    Route::get('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/users/change-password/{user}', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
});

require __DIR__.'/auth.php';
