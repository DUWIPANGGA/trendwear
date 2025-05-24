<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Livewire\Admin\Product\ProductIndex;
use App\Livewire\Admin\Product\ProductUpdate;
use App\Livewire\Admin\Category\CategoryIndex;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard.index');
ROute::middleware(['auth'])->prefix('admin')->name('admin')->group(function() {
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/products', [ProductIndex::class,'render'])->name('products.index');
    Route::get('/products/{id}/edit', ProductUpdate::class)->name('products.update');
});
Route::prefix('users')->name('users.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});
Route::prefix('product')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index'); // /product
    Route::get('/create', [ProductController::class, 'create'])->name('create'); // /product/create
    Route::post('/', [ProductController::class, 'store'])->name('store'); // POST /product

    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit'); // /product/{product}/edit
    Route::put('/{product}', [ProductController::class, 'update'])->name('update'); // PUT /product/{product}
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy'); // DELETE /product/{product}

    Route::get('/{id}', [ProductController::class, 'show'])->name('show'); // HARUS PALING BAWAH
});

Route::prefix('categories')->name('categories.')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});
Route::prefix('orders')->group(function () {
    // Order Routes
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::post('orders/{order}/approve', [\App\Http\Controllers\Admin\OrderController::class, 'approve'])->name('admin.orders.approve');
    Route::post('orders/{order}/cancel', [\App\Http\Controllers\Admin\OrderController::class, 'cancel'])->name('admin.orders.cancel');
});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Activity Log Routes
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs.index');
    Route::get('activity-logs/{activityLog}', [\App\Http\Controllers\Admin\ActivityLogController::class, 'show'])->name('admin.activity-logs.show');
    Route::delete('activity-logs/{activityLog}', [\App\Http\Controllers\Admin\ActivityLogController::class, 'destroy'])->name('admin.activity-logs.destroy');
    Route::delete('activity-logs/clear', [\App\Http\Controllers\Admin\ActivityLogController::class, 'clearOldLogs'])->name('admin.activity-logs.clear');
});