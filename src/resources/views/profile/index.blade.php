{{-- resources/views/profile/index.blade.php --}}
@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
<div class="container">

    <h1 class="text-center mb-4">プロフィール</h1>

    <div class="d-flex justify-content-center">
        <div class="card" style="max-width: 600px; width: 100%;">
            <div class="card-body">

                <dl class="row mb-0">
                    <dt class="col-sm-4">ユーザー名</dt>
                    <dd class="col-sm-8">{{ $user->name }}</dd>

                    <dt class="col-sm-4">メールアドレス</dt>
                    <dd class="col-sm-8">{{ $user->email }}</dd>

                    <dt class="col-sm-4">郵便番号</dt>
                    <dd class="col-sm-8">{{ $user->postal_code ?? '未登録' }}</dd>

                    <dt class="col-sm-4">住所</dt>
                    <dd class="col-sm-8">{{ $user->address ?? '未登録' }}</dd>
                </dl>

                <div class="mt-3">
                    <a href="{{ route('address.edit') }}" class="btn btn-secondary">
                        住所変更
                    </a>
                </div>

            </div>
        </div>
    </div>

    <hr class="my-4">

    <h2 class="mb-3">購入した商品一覧</h2>

    @if ($purchases->isEmpty())
        <p>購入した商品はありません。</p>
    @else
        <div class="list-group">
            @foreach ($purchases as $purchase)
                <div class="list-group-item">
                    {{ $purchase->product->name ?? '商品名未設定' }}
                    （¥{{ number_format($purchase->price) }}）
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
