<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('isLogin')->group(function () {
    Route::middleware('isAdmin')->group(function () {
        Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/create/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/edit/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.destroy');
    });
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/goods/product', [DashboardController::class, 'product'])->name('product');
    Route::get('/goods/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/goods/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/goods/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/goods/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::put('/goods/product/update/stock/{id}', [ProductController::class, 'updateStock'])->name('product.update.stock');
    Route::delete('/goods/product/edit/{id}', [ProductController::class, 'delete'])->name('product.destroy');

    Route::get('/dashboard/sales', [DashboardController::class, 'sales'])->name('sale');
    Route::post('/dashboard/sales/store', [SaleController::class, 'store'])->name('sale.store');
    Route::post('/dashboard/sales/invoice/delete/{id}', [SaleController::class, 'delete_sale'])->name('delete.sale');
    Route::get('/dashboard/sales/invoice/{id}', [SaleController::class, 'invoice'])->name('sale.invoice');
    Route::get('/dashboard/detail', [DashboardController::class, 'detail'])->name('detail');
    Route::delete('/dashboard/detail/destroy/{id}', [SaleController::class, 'detail_destroy'])->name('detail.destroy');

    Route::get('/dashboard/detail/report', [SaleController::class, 'export_excel_detail'])->name('report');
});
