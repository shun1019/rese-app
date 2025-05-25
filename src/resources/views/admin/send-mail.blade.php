@extends('layouts.app')

@section('title', '利用者へメール送信 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-container">
    <h1>利用者へメール送信</h1>

    @if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.mail.send') }}" method="POST" class="mail-form">
        @csrf

        <div class="form-group">
            <label for="user_id">送信先ユーザー</label>
            <select name="user_id" class="form-control">
                <option value="">選択してください</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}（{{ $user->email }}）</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="subject">件名</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control">
            @error('subject')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">本文</label>
            <textarea name="message" rows="6" class="form-control">{{ old('message') }}</textarea>
            @error('message')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="create-btn">送信する</button>
    </form>
</div>
@endsection