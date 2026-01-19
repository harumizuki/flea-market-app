@extends('layouts.app')

@section('title', '新規登録')

@section('content')
<div class="w-50 mx-auto">
    <h2 class="mb-4">新規登録</h2>

    <form action="{{ route('register.store') }}" method="POST" novalidate>
        @csrf
        <div class="mb-3">
            <label class="form-label">ユーザー名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">パスワード</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">パスワード（確認）</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>

    <p class="mt-3">
        すでにアカウントをお持ちの方は
        <a href="{{ route('login') }}">ログイン</a>
    </p>
</div>
@endsection
