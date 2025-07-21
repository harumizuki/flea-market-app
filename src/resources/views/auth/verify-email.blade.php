<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メール認証</title>
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
        .form-container {
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="logo-bar">
        <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH">
    </div>

    <div class="container my-5 form-container">
        <h1 class="text-center mb-4">メール認証が必要です</h1>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success text-center">
                新しい認証リンクを送信しました。
            </div>
        @endif

        <p class="text-center">ご登録のメールアドレスに認証リンクを送信しました。<br>メールをご確認ください。</p>

        <form method="POST" action="{{ route('verification.send') }}" class="text-center my-3">
            @csrf
            <button type="submit" class="btn btn-primary">認証メールを再送信する</button>
        </form>

        <div class="text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link">ログアウト</button>
            </form>
        </div>
    </div>
</body>
</html>
