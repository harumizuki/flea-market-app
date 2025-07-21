<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $item['name'] }} の詳細ページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card">
            <img src="{{ asset('images/' . $item['image']) }}" class="card-img-top" alt="{{ $item['name'] }}" style="max-width: 300px; height: auto; display: block; margin: 0 auto;">

                <h3 class="card-title">{{ $item['name'] }}</h3>
                <p class="card-text">価格: ¥{{ number_format($item['price']) }}</p>
                <p class="card-text">説明: {{ $item['description'] }}</p>
                <p class="card-text"><small class="text-muted">状態: {{ $item['condition'] }}</small></p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">一覧に戻る</a>
            </div>
        </div>
    </div>
</body>
</html>
