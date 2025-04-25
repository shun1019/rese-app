@extends('layouts.app')

@section('title', 'メール認証 | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            メールアドレスの確認
        </div>
        <div class="auth-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                新しい確認リンクがあなたのメールアドレスに送信されました。
            </div>
            @endif

            <p>ご登録いただいたメールアドレスに確認リンクを送信しました。</p>
            <p>メールが届かない場合は、下記のボタンをクリックして再送信してください。</p>

            <form method="POST" action="{{ route('verification.send') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn">
                    確認メールを再送信
                </button>
            </form>
        </div>
    </div>
</div>
@endsection