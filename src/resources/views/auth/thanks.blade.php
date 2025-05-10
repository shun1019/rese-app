@extends('layouts.app')

@section('title', '会員登録完了 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')
<div class="complete-container">
    <div class="complete-card">
        <p class="complete-message">会員登録ありがとうございます</p>
        <a href="{{ route('login') }}" class="complete-button">
            ログインする
        </a>
    </div>
</div>
@endsection