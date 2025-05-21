<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;


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

    // お気に入り登録・解除
    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // 予約操作
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations/{reservation}/confirm-cancel', [ReservationController::class, 'confirmCancel'])->name('reservations.confirm-cancel');

    // マイページ・予約完了画面
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
    Route::get('/done', function () {
        return view('reservations.complete');
    })->name('reservations.done');

    // 店舗評価機能
    Route::get('/rating/{reservation}/create', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/ratings/{reservation}', [RatingController::class, 'store'])->name('ratings.store');
});

// 管理者専用ルート（admin ロール）
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/owners/create', [AdminController::class, 'createOwner'])->name('admin.owner.create');
    Route::post('/owners', [AdminController::class, 'storeOwner'])->name('admin.owner.store');
});

// 店舗代表者専用ルート（owner ロール）
Route::middleware(['auth', 'verified', 'owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    Route::get('/shop/edit', [OwnerController::class, 'editShop'])->name('owner.shop.edit');
    Route::post('/shop/update', [OwnerController::class, 'updateShop'])->name('owner.shop.update');
    Route::get('/reservations', [OwnerController::class, 'reservations'])->name('owner.reservations.index');
});