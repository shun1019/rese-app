@extends('layouts.app')

@section('title', '店舗代表者の追加 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-container">
    <h2>店舗代表者を追加</h2>

    <form method="POST" action="{{ route('admin.owner.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error('email')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
            @error('password')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="create-btn">登録する</button>
    </form>
</div>
@endsection