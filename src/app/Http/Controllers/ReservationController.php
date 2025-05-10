<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    /**
     * 予約のキャンセル
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage')->with('error', '不正なアクセスです。');
        }

        $shopName = $reservation->shop->name;
        $reservation->delete();

        return redirect()->route('mypage')->with('success', "{$shopName}の予約をキャンセルしました。");
    }

    /**
     * 予約の実行
     */
    public function store(ReservationRequest $request)
    {
        Reservation::create([
            'user_id' => Auth::id(),
            'shop_id' => $request->shop_id,
            'date'    => $request->date,
            'time'    => $request->time,
            'number'  => $request->number,
        ]);

        return redirect()->route('reservations.done');
    }

    /**
     * キャンセル確認画面
     */
    public function confirmCancel(Reservation $reservation)
    {
        if (Auth::id() !== $reservation->user_id) {
            return redirect()->route('mypage')->with('error', '不正なアクセスです。');
        }

        return view('reservations.confirm-cancel', compact('reservation'));
    }
}
