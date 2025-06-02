@extends('layouts.app')

@section('title', '予約キャンセルの確認 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/confirm-cancel.css') }}">
@endsection

@section('content')
<div class="cancel-container">
    <div class="cancel-card">
        <h1 class="cancel-title">予約キャンセルの確認</h1>

        <div class="reservation-details">
            <p><strong>店舗名:</strong> {{ $reservation->shop->name }}</p>
            <p><strong>予約日:</strong> {{ date('Y年m月d日', strtotime($reservation->date)) }}</p>
            <p><strong>時間:</strong> {{ date('H:i', strtotime($reservation->time)) }}</p>
            <p><strong>人数:</strong> {{ $reservation->number }}人</p>
        </div>

        <p class="cancel-warning">この予約をキャンセルしますか？</p>

        <div class="button-group">
            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('mypage') }}" class="back-btn">戻る</a>
                <button type="submit" class="cancel-btn">キャンセルする</button>
            </form>
        </div>
    </div>
</div>
@endsection