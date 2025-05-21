@extends('layouts.app')

@section('title', '管理者ダッシュボード | Rese')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-dashboard">
    <h1>管理者ダッシュボード</h1>

    <p>ようこそ、管理者画面へ！</p>

    <a href="{{ route('admin.owner.create') }}" class="btn">店舗代表ユーザーを追加する</a>
</div>
@endsection