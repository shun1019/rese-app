@extends('layouts.app')

@section('title', '店舗一覧 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('header-content')
<div class="search-container">
    <select name="area" id="area-select">
        <option>All area</option>
        @foreach($areas as $area)
        <option {{ request('area') == $area ? 'selected' : '' }}>{{ $area }}</option>
        @endforeach
    </select>

    <select name="genre" id="genre-select">
        <option>All genre</option>
        @foreach($genres as $genre)
        <option {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
        @endforeach
    </select>

    <input type="text" name="search" id="search-input" placeholder="Search ..." value="{{ request('search') }}">
    <i class="fas fa-search search-icon"></i>
</div>
@endsection

@section('content')
<div class="shops-container">
    @foreach($shops as $shop)
    <div class="shop-card">
        <img src="{{ asset('storage/image/' . $shop->image) }}" alt="{{ $shop->name }}" class="shop-image">
        <div class="shop-content">
            <div class="shop-name">{{ $shop->name }}</div>
            <div class="shop-tags">
                #{{ $shop->area }} #{{ $shop->genre }}
            </div>
            <div class="shop-actions">
                <a href="{{ route('shops.show', $shop->id) }}" class="detail-btn">詳しく見る</a>
                @auth
                <button class="favorite-btn {{ in_array($shop->id, $favorites) ? 'active' : '' }}" data-shop-id="{{ $shop->id }}">
                    <i class="fas fa-heart"></i>
                </button>
                @else
                <button class="favorite-btn" onclick="location.href='{{ route('login') }}'">
                    <i class="far fa-heart"></i>
                </button>
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/shop.js') }}"></script>
@endsection