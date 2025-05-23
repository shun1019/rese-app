<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;

class OwnerController extends Controller
{
    /**
     * オーナーマイページ表示
     */
    public function index()
    {
        return view('owner.mypage');
    }

    /**
     * 店舗情報の編集フォーム表示（登録済み or 空）
     */
    public function editShop()
    {
        $shop = Auth::user()->shop;

        return view('owner.edit-shop', compact('shop'));
    }

    /**
     * 店舗情報の新規登録処理
     */
    public function storeShop(StoreShopRequest $request)
    {
        if (Auth::user()->shop) {
            return redirect()->route('owner.mypage')->with('error', 'すでに店舗が登録されています。');
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('image', 'public');
        }

        Shop::create([
            'name' => $request->name,
            'area' => $request->area,
            'genre' => $request->genre,
            'description' => $request->description,
            'image' => $imageName,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('owner.mypage')->with('success', '店舗情報を登録しました。');
    }

    /**
     * 店舗情報の更新処理
     */
    public function updateShop(StoreShopRequest $request)
    {
        $shop = Auth::user()->shop;

        $imageName = $shop->image;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('image', 'public');
        }

        $shop->update([
            'name' => $request->name,
            'area' => $request->area,
            'genre' => $request->genre,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('owner.mypage')->with('success', '店舗情報を更新しました。');
    }

    /**
     * 予約一覧表示（後で実装）
     */
    public function reservations()
    {
        return view('owner.reservations');
    }
}
