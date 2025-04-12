<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [ShopController::class, 'index'])->name('index');

Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::get('/mypage', function () {
        return view('welcome');
    })->name('mypage');
});
