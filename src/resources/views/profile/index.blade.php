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

                    @if (!is_null($averageRating))
                    <dt class="col-sm-4">評価</dt>
                    <dd class="col-sm-8">
                    {{ $averageRating }} / 5
                    </dd>
    @endif
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

    <hr class="my-4">

    <h2>取引中の商品</h2>

    @forelse ($tradeProducts as $product)
        <div style="position: relative; margin-bottom: 15px;">
            <a href="{{ route('chat.show', $product) }}" style="display: inline-block; padding-left: 25px;">
                {{ $product->name }}
            </a>

            {{-- 未読バッジ --}}
            <span style="
                position: absolute;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                background: red;
                color: white;
                border-radius: 50%;
                min-width: 18px;
                height: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 11px;
            ">
                {{ $unreadCounts[$product->id] ?? 0 }}
            </span>
        </div>
    @empty
        <p>データないよ</p>
    @endforelse

</div>
@endsection