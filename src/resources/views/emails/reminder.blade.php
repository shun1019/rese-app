<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>予約リマインダー</title>
</head>

<body>
    <p>{{ $reservation->user->name }} 様</p>

    <p>本日、以下の内容でご予約をいただいております。</p>

    <ul>
        <li><strong>店舗名:</strong> {{ $reservation->shop->name }}</li>
        <li><strong>日付:</strong> {{ $reservation->date }}</li>
        <li><strong>時間:</strong> {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</li>
        <li><strong>人数:</strong> {{ $reservation->number }} 人</li>
    </ul>

    <p>ご来店をお待ちしております。</p>
</body>

</html>