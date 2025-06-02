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
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage');
        }

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
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage');
        }

        if ($reservation->rating) {
            return redirect()->route('mypage');
        }

        $reservation->rating()->create([
            'score' => ['score'],
            'comment' => ['comment'],
        ]);

        return redirect()->route('mypage');
    }
}
