@extends('layouts.app')

@section('title', 'ようこそ')

@section('content')
    <div class="text-center">
        <h1 class="mb-4">ようこそ COACHTECH フリマアプリへ！</h1>
        <p>ログインまたは新規登録して始めましょう。</p>

        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary me-2">ログイン</a>
            <a href="{{ route('register') }}" class="btn btn-success">新規登録</a>
        </div>
    </div>
@endsection
