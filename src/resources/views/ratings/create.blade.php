@extends('layouts.app')

@section('title', '店舗の評価 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/rating.css') }}">
@endsection

@section('content')
<div class="rating-form">
    <h2>{{ $reservation->shop->name }} を評価する</h2>

    <form method="POST" action="{{ route('ratings.store', $reservation->id) }}" >
        @csrf
        <div class="form-group">
        <label for="score">評価（1〜５）</label>
        <select name="score" id="score" class="score-form star-select">
            <option value="">選択してください</option>
            @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}" {{old('score') == $i ? 'sectioned' : '' }}>★ {{ $i }}</option>
            @endfor
        </select>
        </div>

        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="comment-form">{{ old('comment') }}</textarea>
        </div>

        <button type="submit" class="rating-btn">評価を投稿</button>
    </form>
</div>
@endsection