@extends('layouts.app')

@section('title', 'プロフィール画面')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">プロフィール</h1>

    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">ユーザー名</dt>
                <dd class="col-sm-8">{{ Auth::user()->name }}</dd>

                <dt class="col-sm-4">メールアドレス</dt>
                <dd class="col-sm-8">{{ Auth::user()->email }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">プロフィール編集</a>
                <a href="{{ route('profile.address') }}" class="btn btn-secondary">住所変更</a>
            </div>
        </div>
    </div>
</div>
@endsection
