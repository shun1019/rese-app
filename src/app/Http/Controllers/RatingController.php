<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * 評価フォーム表示
     */
    public function create(Reservation $reservation)
    {
        // 認証ユーザーの予約であるかチェック
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage');
        }

        // すでに評価済みならマイページにリダイレクト
        if ($reservation->rating) {
            return redirect()->route('mypage');
        }

        return view('ratings.create', compact('reservation'));
    }

    /**
     * 評価の保存処理
     */
    public function store(Request $request, Reservation $reservation)
    {
        // 認証ユーザーの予約であるかチェック
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage');
        }

        // 重複評価の防止
        if ($reservation->rating) {
            return redirect()->route('mypage');
        }

        // 保存処理
        $reservation->rating()->create([
            'score' => ['score'],
            'comment' => ['comment'],
        ]);

        return redirect()->route('mypage');
    }
}
