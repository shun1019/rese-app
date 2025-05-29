<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * 店舗一覧を表示
     */
    public function index(Request $request)
    {
        $query = Shop::query();

        if ($request->filled('area') && $request->area !== 'All area') {
            $query->where('area', $request->area);
        }

        if ($request->filled('genre') && $request->genre !== 'All genre') {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $shops = $query->paginate(12);

        $areas = Shop::distinct()->pluck('area');
        $genres = Shop::distinct()->pluck('genre');

        $favorites = [];
        if (Auth::check()) {
            $favorites = Auth::user()->favorites()->pluck('shop_id')->toArray();
        }

        return view('shops.index', compact('shops', 'areas', 'genres', 'favorites'));
    }

    /**
     * 店舗詳細を表示
     */
    public function show($id)
    {
        $shop = Shop::findOrFail($id);

        $isFavorite = false;
        if (Auth::check()) {
            $isFavorite = Auth::user()->favorites()->where('shop_id', $id)->exists();
        }

        return view('shops.show', compact('shop', 'isFavorite'));
    }
}
