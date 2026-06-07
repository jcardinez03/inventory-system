<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockLogController;
use App\Models\StockLog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/test-env', function () {
    return [
        'APP_KEY_exists' => env('APP_KEY') ? 'YES' : 'NO',
        'APP_KEY_length' => strlen(env('APP_KEY') ?? ''),
    ];
});

Route::group(['middleware' => 'auth'], function(){
    // homepage
    Route::get('/', [HomeController::class,'index'])->name('index');

    // products
    Route::get('/products/index', [ProductController::class,'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class,'create'])->name('product.create');
    Route::post('/products/store', [ProductController::class,'store'])->name('product.store');
    Route::delete('/products/{id}/destroy', [ProductController::class,'destroy'])->name('product.destroy');

    // stock
    Route::post('/stock/{product_id}/store', [StockController::class,'store'])->name('stock.store');
    Route::patch('/stock/{product_id}/update', [StockController::class,'update'])->name('stock.update');
    Route::delete('/stock/{product_id}/destroy', [StockController::class,'destroy'])->name('stock.destroy');

    // stock log
    Route::get('/stock-log/index', [StockLogController::class,'index'])->name('stocklog.index');

    // categirues
    Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
    Route::post('/categories/store', [CategoryController::class,'store'])->name('category.store');
});