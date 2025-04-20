<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    /**
     * マイページの表示
     */
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->with('shop')->get();
        $favorites = $user->favoriteShops()->get();

        return view('mypage.index', compact('user', 'reservations', 'favorites'));
    }
}
