@extends('layouts.app')

@section('title', 'ログイン | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            Login
        </div>
        <div class="auth-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <div class="input-wrapper">
                        <img src="{{ asset('storage/image/mail_icon.png') }}" class="icon-image">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <img src="{{ asset('storage/image/password_icon.jpg') }}" class="icon-image">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn">ログイン</button>
            </form>
        </div>
    </div>
</div>
@endsection