@extends('layouts.app')

@section('title', 'オーナーマイページ | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/owner.css') }}">
@endsection

@section('content')
<div class="owner-container">
    <h1 class="page-title">{{ $user->name }}さんの店舗管理</h1>

    <div class="shop-section">
        <h2>店舗情報</h2>

        <form action="{{ $shop ? route('owner.shop.update') : route('owner.shop.store') }}" method="POST" enctype="multipart/form-data" class="shop-form">
            @csrf
            @if($shop)
            @method('POST')
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            @endif

            <div class="form-group">
                <label for="image">店舗画像</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            @if ($shop && $shop->image)
            <div class="form-group">
                <img src="{{ asset('storage/' . $shop->image) }}" alt="店舗画像" class="preview-image">
            </div>
            @endif

            <div class="form-group">
                <label for="name">店舗名</label>
                <input type="text" name="name" value="{{ old('name', $shop->name ?? '') }}" class="form-control">
                @error('name')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="area">エリア</label>
                <input type="text" name="area" value="{{ old('area', $shop->area ?? '') }}" class="form-control">
                @error('area')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="genre">ジャンル</label>
                <input type="text" name="genre" value="{{ old('genre', $shop->genre ?? '') }}" class="form-control">
                @error('genre')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">説明</label>
                <textarea name="description" class="form-control">{{ old('description', $shop->description ?? '') }}</textarea>
                @error('description')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="primary-btn">{{ $shop ? '更新する' : '登録する' }}</button>
        </form>
    </div>

    <div class="reservation-section">
        <h2>予約一覧</h2>

        @if ($reservations->isEmpty())
        <p>予約はまだありません。</p>
        @else
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>利用者名</th>
                    <th>日付</th>
                    <th>時間</th>
                    <th>人数</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                    <td>{{ $reservation->number }}人</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection