<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール確認 | Rese</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="logo-container">
        <div class="logo">
            <i class="fas fa-bars"></i>
        </div>
        <a href="/" class="logo-text">Rese</a>
    </div>

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
</body>

</html>