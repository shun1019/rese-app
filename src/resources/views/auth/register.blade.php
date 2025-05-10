@extends('layouts.app')

@section('title', '会員登録 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            Registration
        </div>
        <div class="auth-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <div class="input-wrapper">
                        <img src="{{ asset('storage/image/user_icon.png') }}" class="icon-image">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Username" autofocus>
                    </div>
                    @error('name')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

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

                <button type="submit" class="btn">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection