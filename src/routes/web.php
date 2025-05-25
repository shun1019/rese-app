<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;

// トップページ
Route::get('/', [ShopController::class, 'index'])->name('index');

// 店舗詳細
Route::get('/detail/{id}', [ShopController::class, 'show'])->name('shops.show');

// メール認証ページ
Route::get('/email/verify', fn() => view('auth.verify-email'))->middleware('auth')->name('verification.notice');

// 会員登録完了
Route::get('/thanks', fn() => view('auth.thanks'))->middleware('auth')->name('thanks');

// 認証ユーザー用ルート
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations/{reservation}/confirm-cancel', [ReservationController::class, 'confirmCancel'])->name('reservations.confirm-cancel');

    Route::get('/done', [ReservationController::class, 'done'])->name('reservations.done');

    Route::get('/rating/{reservation}/create', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('/ratings/{reservation}', [RatingController::class, 'store'])->name('ratings.store');

    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
});

// 管理者専用ルート
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/owners/create', [AdminController::class, 'createOwner'])->name('admin.owner.create');
    Route::post('/owners', [AdminController::class, 'storeOwner'])->name('admin.owner.store');
    Route::get('/mail', [AdminController::class, 'showMailForm'])->name('admin.mail.form');
    Route::post('/mail/send', [AdminController::class, 'sendMail'])->name('admin.mail.send');
});

// 店舗代表者専用ルート
Route::middleware(['auth', 'verified', 'owner'])->prefix('owner')->group(function () {
    Route::get('/mypage', [MyPageController::class, 'index'])->name('owner.mypage');
    Route::post('/shop/store', [OwnerController::class, 'storeShop'])->name('owner.shop.store');
    Route::get('/shop/edit', [OwnerController::class, 'editShop'])->name('owner.shop.edit');
    Route::post('/shop/update', [OwnerController::class, 'updateShop'])->name('owner.shop.update');
    Route::get('/reservations', [OwnerController::class, 'reservations'])->name('owner.reservations.index');
});
