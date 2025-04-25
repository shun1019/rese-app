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
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
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

                <button type="submit" class="btn">ログイン</button>
            </form>
        </div>
    </div>
</div>
@endsection