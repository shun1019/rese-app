<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    /**
     * マイページの表示
     */
    public function index()
    {
        $user = Auth::user();

        // オーナーの場合は、店舗情報とその予約一覧を表示
        if ($user->isOwner()) {
            $shop = $user->shop;
            $reservations = $shop ? $shop->reservations()->with('user')->get() : collect(); // 店舗未登録なら空コレクション

            return view('mypage.owner', compact('user', 'shop', 'reservations'));
        }

        // 一般ユーザーの場合
        $reservations = $user->reservations()->with(['shop', 'rating'])->get();
        $favorites = $user->favoriteShops()->get();

        return view('mypage.index', compact('user', 'reservations', 'favorites'));
    }
}
