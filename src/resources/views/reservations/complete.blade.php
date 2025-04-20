@extends('layouts.app')

@section('title', '予約完了 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')
<div class="complete-container">
    <div class="complete-card">
        <p class="complete-message">ご予約ありがとうございます</p>
        <a href="{{ route('index') }}" class="complete-button">戻る</a>
    </div>
</div>
@endsection