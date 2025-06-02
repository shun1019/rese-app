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

        if ($user->isOwner()) {
            $shop = $user->shop;
            $reservations = $shop ? $shop->reservations()->with('user')->get() : collect();

            return view('mypage.owner', compact('user', 'shop', 'reservations'));
        }

        $reservations = $user->reservations()->with(['shop', 'rating'])->get();
        $favorites = $user->favoriteShops()->get();

        return view('mypage.index', compact('user', 'reservations', 'favorites'));
    }
}
