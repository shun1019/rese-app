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

// メール認証確認通知ページ
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 会員登録完了ページ
Route::get('/thanks', function () {
    return view('auth.thanks');
})->middleware('auth')->name('thanks');

// 認証が必要なルート
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
    Route::get('/reservations/{reservation}/confirm-cancel', [ReservationController::class, 'confirmCancel'])
        ->name('reservations.confirm-cancel');
    Route::get('/done', function () {
        return view('reservations.complete');
    })->name('reservations.done');
});
