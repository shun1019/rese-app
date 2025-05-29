<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ReservationController extends Controller
{
    /**
     * 予約のキャンセル
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage');
        }

        $shopName = $reservation->shop->name;
        $reservation->delete();

        return redirect()->route('mypage')->with('success', "{$shopName}の予約をキャンセルしました。");
    }

    /**
     * 予約の実行（Stripe決済連携）
     */
    public function store(ReservationRequest $request)
    {
        $shop = Shop::findOrFail($request->shop_id);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'shop_id' => $shop->id,
            'date'    => $request->date,
            'time'    => $request->time,
            'number'  => $request->number,
            'price'   => $shop->price,
            'status'  => 'unpaid',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $shop->name . ' 予約',
                    ],
                    'unit_amount' => $reservation->price * $reservation->number,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('reservations.done', ['reservation_id' => $reservation->id]),
            'cancel_url' => route('mypage'),
        ]);

        return redirect($session->url);
    }

    /**
     * キャンセル確認画面
     */
    public function confirmCancel(Reservation $reservation)
    {
        if (Auth::id() !== $reservation->user_id) {
            return redirect()->route('mypage');
        }

        return view('reservations.confirm-cancel', compact('reservation'));
    }

    /**
     * 予約情報の変更
     */
    public function update(ReservationRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('mypage');
        }

        $reservation->update($request->only(['date', 'time', 'number']));

        return redirect()->route('mypage');
    }

    /**
     * 決済完了後のリダイレクト処理
     */
    public function done(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
        $reservation->update(['status' => 'paid']);
        return view('reservations.complete', compact('reservation'));
    }
}
