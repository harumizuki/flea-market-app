@extends('layouts.app')

@section('title', 'パスワード再設定メール送信')

@section('content')
<div class="container">
    <h2 class="mb-4">パスワード再設定メール送信</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">送信</button>
    </form>

    <p class="mt-3">
        <a href="{{ route('login') }}">ログイン画面に戻る</a>
    </p>
</div>
@endsection
