<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rese - 飲食店予約サービス')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('styles')
</head>

<body>
    <!-- ポップアップメニュー -->
    <div id="menu-popup" class="menu-popup">
        <div id="close-menu" class="close-button">
            <i class="fas fa-times"></i>
        </div>
        <div class="menu-links">
            <a href="/">Home</a>
            @guest
            <a href="{{ route('register') }}">Registration</a>
            <a href="{{ route('login') }}">Login</a>
            @else
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <a href="{{ route('mypage') }}">Mypage</a>
            @endguest
        </div>
    </div>

    <header class="header">
        <div class="logo-container">
            <div class="logo" id="menu-button">
                <i class="fas fa-bars"></i>
            </div>
            <a href="/" class="logo-text">Rese</a>
        </div>
        @yield('header-content')
    </header>
    @yield('content')
    <script src="{{ asset('js/menu.js') }}"></script>
    @yield('scripts')
</body>

</html>