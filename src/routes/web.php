<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;

// トップページ（店舗一覧）
Route::get('/', [ShopController::class, 'index'])->name('index');

// 店舗詳細ページ
Route::get('/detail/{id}', [ShopController::class, 'show'])->name('shops.show');

// 認証が必要なルート
Route::middleware(['auth'])->group(function () {
    // お気に入り機能
    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // 予約機能
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');

    // マイページ
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');

    Route::get('/done', function () {
        return view('reservations.complete');
    })->name('reservations.done');
});
