@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <h1 class="text-center mb-4">プロフィール編集</h1>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">更新する</button>
        </div>
    </form>
@endsection
