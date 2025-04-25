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
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Username" autofocus>
                    @error('name')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password">
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