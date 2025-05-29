@extends('layouts.app')

@section('title', $shop->name . ' | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/shop-detail.css') }}">
@endsection

@section('content')
<div class="detail-container">
    <div class="shop-detail">
        <div class="shop-header">
            <a href="/" class="back-btn"><i class="fas fa-chevron-left"></i></a>
            <h1 class="shop-title">{{ $shop->name }}</h1>
        </div>

        <div class="shop-image-container">
            <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" class="shop-image">
        </div>

        <div class="shop-tags">
            #{{ $shop->area }} #{{ $shop->genre }}
        </div>

        <div class="shop-description">
            {{ $shop->description }}
        </div>

        <div class="shop-price">
            <strong>料金:</strong> {{ number_format($shop->price) }}円
        </div>
    </div>

    <div class="reservation-form">
        <h2>予約</h2>
        <form action="{{ route('reservations.store') }}" method="POST" class="reservation-form-inner">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="form-group">
                <input type="date" name="date" id="date"
                    class="form-control input-date"
                    min="{{ date('Y-m-d') }}"
                    value="{{ old('date', session('reservation_input.date')) }}">
            </div>
            @error('date')
            <div class="form-error">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <select name="time" id="time" class="form-control">
                    <option value="">選択してください</option>

                    {{-- 午前:10:00〜12:30 --}}
                    @for ($hour = 10; $hour <= 12; $hour++)
                        @foreach ([0, 30] as $minute)
                        @php
                        if ($hour===12 && $minute===60) break;
                        $time=sprintf('%02d:%02d', $hour, $minute);
                        @endphp
                        @if (!($hour===12 && $minute===60))
                        <option value="{{ $time }}" {{ old('time', session('reservation_input.time')) == $time ? 'selected' : '' }}>
                        {{ $time }}
                        </option>
                        @endif
                        @endforeach
                        @endfor
                        @for ($hour = 17; $hour <= 21; $hour++)
                            @foreach ([0, 30] as $minute)
                            @php
                            $time=sprintf('%02d:%02d', $hour, $minute);
                            @endphp
                            <option value="{{ $time }}" {{ old('time', session('reservation_input.time')) == $time ? 'selected' : '' }}>
                            {{ $time }}
                            </option>
                            @endforeach
                            @endfor
                </select>
                @error('time')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <select name="number" id="number" class="form-control">
                    <option value="">選択してください</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('number', session('reservation_input.number')) == $i ? 'selected' : '' }}>
                        {{ $i }}人
                        </option>
                        @endfor
                </select>
                @error('number')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="reservation-summary">
                <div class="summary-item">
                    <div class="summary-label">Shop</div>
                    <div class="summary-value">{{ $shop->name }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Date</div>
                    <div class="summary-value" id="summary-date">-</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Time</div>
                    <div class="summary-value" id="summary-time">-</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Number</div>
                    <div class="summary-value" id="summary-number">-</div>
                </div>
            </div>

            <button type="submit" class="reserve-btn">予約する</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const numberInput = document.getElementById('number');

        const summaryDate = document.getElementById('summary-date');
        const summaryTime = document.getElementById('summary-time');
        const summaryNumber = document.getElementById('summary-number');

        dateInput.addEventListener('change', function() {
            const date = new Date(this.value);
            const formattedDate = date.getFullYear() + '-' +
                ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                ('0' + date.getDate()).slice(-2);
            summaryDate.textContent = formattedDate;
        });

        timeInput.addEventListener('change', function() {
            summaryTime.textContent = this.value;
        });

        numberInput.addEventListener('change', function() {
            summaryNumber.textContent = this.value + '人';
        });
    });
</script>
@endsection