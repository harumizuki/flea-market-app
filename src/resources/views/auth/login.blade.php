@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="container">
    <h2 class="mb-4">ログイン</h2>

    {{-- ★ ここにあった $errors->any() ブロックは削除する --}}

    <form action="{{ route('login.store') }}" method="POST" novalidate>
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
                autofocus
            >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input
                type="password"
                name="password"
                class="form-control"
                required
            >
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">ログイン状態を保持する</label>
        </div>

        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>

    <p class="mt-3">
        アカウントをお持ちでない方は
        <a href="{{ route('register') }}">新規登録はこちら</a>
    </p>
</div>
@endsection
