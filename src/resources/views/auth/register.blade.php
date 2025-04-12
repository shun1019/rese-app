<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録 | Rese</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div id="menu-popup" class="menu-popup">
        <div id="close-menu" class="close-button">
            <i class="fas fa-times"></i>
        </div>
        <div class="menu-links">
            <a href="/">Home</a>
            <a href="{{ route('register') }}">Registration</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

    <div class="logo-container">
        <div class="logo">
            <i class="fas fa-bars"></i>
        </div>
        <a href="/" class="logo-text">Rese</a>
    </div>

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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Username" autofocus>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="display: none;">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <button type="submit" class="btn">登録</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/menu.js') }}"></script>
</body>

</html>