@extends('layouts.app')

@section('title', 'マイページ | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-container">
    <div class="user-info">
        <h1 class="user-name">{{ $user->name }}さん</h1>
    </div>

    <div class="mypage-content">
        <!-- 左側：予約状況 -->
        <div class="reservations-section">
            <h2 class="section-title">予約状況</h2>

            @if($reservations->isEmpty())
            <p class="no-data">予約はまだありません</p>
            @else
            @foreach($reservations as $reservation)
            <div class="reservation-card">
                <div class="reservation-header">
                    <div class="reservation-number">予約{{ $loop->iteration }}</div>
                    <a href="{{ route('reservations.confirm-cancel', $reservation->id) }}" class="cancel-btn">
                        <i class="fas fa-times"></i></button>
                    </a>
                    </form>
                </div>

                <div class="reservation-detail">
                    <div class="detail-item">
                        <div class="detail-label">Shop</div>
                        <div class="detail-value">{{ $reservation->shop->name }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Date</div>
                        <div class="detail-value">{{ date('Y-m-d', strtotime($reservation->date)) }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Time</div>
                        <div class="detail-value">{{ date('H:i', strtotime($reservation->time)) }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Number</div>
                        <div class="detail-value">{{ $reservation->number }}人</div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <!-- 右側：お気に入り店舗 -->
        <div class="favorites-section">
            <h2 class="section-title">お気に入り店舗</h2>

            @if($favorites->isEmpty())
            <p class="no-data">お気に入りの店舗はまだありません</p>
            @else
            <div class="favorites-grid">
                @foreach($favorites as $shop)
                <div class="shop-card">
                    <img src="{{ asset('storage/image/' . $shop->image) }}" alt="{{ $shop->name }}" class="shop-image">
                    <div class="shop-content">
                        <div class="shop-name">{{ $shop->name }}</div>
                        <div class="shop-tags">
                            #{{ $shop->area }} #{{ $shop->genre }}
                        </div>
                        <div class="shop-actions">
                            <a href="{{ route('shops.show', $shop->id) }}" class="detail-btn">詳しく見る</a>
                            <button class="favorite-btn active" data-shop-id="{{ $shop->id }}">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const favoriteButtons = document.querySelectorAll('.favorite-btn');

        favoriteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const shopId = this.getAttribute('data-shop-id');

                fetch('/favorites/' + shopId, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'removed') {
                            this.closest('.shop-card').style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection