<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Routes des produits
    Route::resource('product', 'App\Http\Controllers\ProductController')->except(['show']);
    Route::delete('/multipleDeleteProducts', [ProductController::class, 'multipleDelete'])->name('product.multipleDelete');
    Route::delete('/multipleDefinitiveDelete', [ProductController::class, 'multipleDefinitiveDelete'])->name('product.multipleDefinitiveDelete');
    Route::get('/productsTrash', [ProductController::class, 'productsTrash'])->name('product.trash');
    Route::delete('/productsTrash/{id}', [ProductController::class, 'definitiveDestroy'])->name('product.definitiveDestroy');

    
    //Routes des catégories
    Route::resource('category', 'App\Http\Controllers\CategoryController')->except(['show']);
    Route::delete('/multipleDeleteCategories', [CategoryController::class, 'multipleDelete'])->name('category.multipleDelete');

});

Route::get('/', [ProductController::class, 'clientIndex'])->name("product.clientIndex");
Route::get('/product/{id}', [ProductController::class, 'show'])->name("product.show");
Route::get('/soldes', [ProductController::class, 'clientPromotionsIndex'])->name("product.promotions");
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name("category.show");

require __DIR__.'/auth.php';
