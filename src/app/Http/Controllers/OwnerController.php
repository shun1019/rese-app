<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * 店舗代表者用ダッシュボード
     */
    public function index()
    {
        return view('owner.dashboard');
    }

    /**
     * 店舗編集画面（仮）
     */
    public function editShop()
    {
        return view('owner.edit-shop');
    }

    /**
     * 店舗更新処理（仮）
     */
    public function updateShop(Request $request)
    {
        // 後で実装
        return redirect()->route('owner.dashboard')->with('success', '店舗情報を更新しました。');
    }

    /**
     * 予約一覧表示（仮）
     */
    public function reservations()
    {
        // 後で実装
        return view('owner.reservations');
    }
}
