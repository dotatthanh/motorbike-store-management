<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\ImportOrderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WarehouseController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return redirect()->route('users.index');
    });

    Route::post('/products/upload-image-details', [ProductController::class, 'uploadImageDetails'])->name('products.upload-image-details');
    Route::post('/products/get-variants/{id}', [ProductController::class, 'getVariants'])->name('products.get-variants');
    Route::post('/products/supplier/{id}', [ProductController::class, 'getProductsBySupplierId'])->name('products.get-products-by-supplier-id');
    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('discount-codes', DiscountCodeController::class);

    Route::resource('users', UserController::class);
    Route::get('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/users/change-password/{user}', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');

    Route::resource('warehouses', WarehouseController::class);

    Route::resource('import-orders', ImportOrderController::class);

    Route::resource('reports', ReportController::class);

    Route::resource('orders', OrderController::class);
    Route::post('update-status-order/{order}', [OrderController::class, 'updateStatusOrder'])->name('orders.update-status-order');
    Route::post('cancel-order/{order}', [OrderController::class, 'cancelOrder'])->name('orders.cancel-order');

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);
});

require __DIR__ . '/auth.php';

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
