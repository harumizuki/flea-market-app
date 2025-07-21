<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'アプリ名')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- ヘッダー（黒背景、ロゴ中央揃え） -->
    <nav class="navbar navbar-dark bg-dark justify-content-center">
        <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH" height="40">
    </nav>

    <!-- 成功メッセージ（任意） -->
    @if (session('success'))
        <div class="alert alert-success text-center my-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- メインコンテンツ -->
    <div class="container my-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS（必要なら） -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
