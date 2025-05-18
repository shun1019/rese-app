<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * お気に入りの追加・削除（トグル機能）
     */
    public function toggle($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        $user = Auth::user();

        $favorite = $user->favorites()->where('shop_id', $shop->id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $user->id;
            $favorite->shop_id = $shop->id;
            $favorite->save();
            return response()->json(['status' => 'added']);
        }
    }
}
