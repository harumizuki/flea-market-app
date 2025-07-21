<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'アプリ名')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo-bar {
            background-color: black;
            padding: 10px;
            text-align: center;
        }
        .logo-bar img {
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="logo-bar">
        <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH">
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center my-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="container my-5">
        @yield('content')
    </div>
</body>
</html>
