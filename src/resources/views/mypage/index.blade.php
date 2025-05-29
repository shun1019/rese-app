@extends('layouts.app')

@section('title', 'マイページ | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection

@section('header-content')

@auth
@if(Auth::user()->isAdmin())
<a href="{{ route('admin.owner.create') }}" class="header-btn">店舗代表者を追加</a>
<a href="{{ route('admin.mail.form') }}" class="header-btn">利用者へメール送信</a>
@endif
@endauth
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
            <p>予約はまだありません</p>
            @else
            @foreach($reservations as $reservation)
            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="reservation-edit-form">
                @csrf
                @method('PUT')

                <div class="reservation-card">
                    <div class="reservation-header">
                        <i class="fa fa-clock-o"></i>
                        <div class="reservation-number">予約{{ $loop->iteration }}</div>
                        <a href="{{ route('reservations.confirm-cancel', $reservation->id) }}" class="cancel-btn">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>

                    <div class="reservation-detail">
                        <div class="detail-item">
                            <div class="detail-label">Shop</div>
                            <div class="detail-value">{{ $reservation->shop->name }}</div>
                        </div>

                        <div class="detail-item editable" data-field="date">
                            <div class="detail-label">Date</div>
                            <div class="detail-value view-mode">{{ $reservation->date }}</div>
                            <input type="date" name="date" value="{{ $reservation->date }}" class="edit-mode hidden" min="{{ date('Y-m-d') }}">
                            @error('date')
                            <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="detail-item editable" data-field="time">
                            <div class="detail-label">Time</div>
                            <div class="detail-value view-mode">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</div>
                            <select name="time" class="edit-mode hidden">
                                @foreach (["10:00","10:30","11:00","11:30","12:00","17:00","17:30","18:00","18:30","19:00","19:30","20:00","20:30","21:00"] as $time)
                                <option value="{{ $time }}" {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') === $time ? 'selected' : '' }}>
                                    {{ $time }}
                                </option>
                                @endforeach
                            </select>
                            @error('time')
                            <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="detail-item editable" data-field="number">
                            <div class="detail-label">Number</div>
                            <div class="detail-value view-mode">{{ $reservation->number }}人</div>
                            <select name="number" class="edit-mode hidden">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ $reservation->number == $i ? 'selected' : '' }}>{{ $i }}人</option>
                                    @endfor
                            </select>
                            @error('number')
                            <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 評価ボタンの表示条件 --}}
                        @php
                        $resDate = \Carbon\Carbon::parse($reservation->date);
                        @endphp

                        @if (!$reservation->rating && $resDate->lte(\Carbon\Carbon::today()))
                        <div class="detail-item">
                            <a href="{{ route('ratings.create', $reservation->id) }}" class="rating-btn">評価する</a>
                        </div>
                        @elseif ($reservation->rating)
                        <div class="detail-item">
                            <span class="rated-label">評価済み</span>
                        </div>
                        @endif
                    </div>

                    <button type="submit" class="update-btn hidden">変更を保存</button>
                </div>
            </form>
            @endforeach
            @endif
        </div>

        <!-- 右側：お気に入り店舗 -->
        <div class="favorites-section">
            <h2 class="section-title">お気に入り店舗</h2>

            @if($favorites->isEmpty())
            <p>お気に入りの店舗はまだありません</p>
            @else
            <div class="favorites-grid">
                @foreach($favorites as $shop)
                <div class="shop-card">
                    <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" class="shop-image">
                    <div class="shop-content">
                        <div class="shop-name">{{ $shop->name }}</div>
                        <div class="shop-tags">#{{ $shop->area }} #{{ $shop->genre }}</div>
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
        // お気に入りボタン
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function() {
                const shopId = this.getAttribute('data-shop-id');
                fetch('/favorites/' + shopId, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    }).then(res => res.json())
                    .then(data => {
                        if (data.status === 'removed') {
                            this.closest('.shop-card').style.display = 'none';
                        }
                    });
            });
        });

        // 編集モード切替
        document.querySelectorAll('.editable').forEach(item => {
            item.addEventListener('click', function() {
                const view = this.querySelector('.view-mode');
                const input = this.querySelector('.edit-mode');
                const form = this.closest('form');
                const saveBtn = form.querySelector('.update-btn');

                if (view && input && saveBtn) {
                    view.classList.add('hidden');
                    input.classList.remove('hidden');
                    saveBtn.classList.remove('hidden');
                }
            });
        });
    });
</script>
@endsection