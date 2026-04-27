{{-- resources/views/profile/index.blade.php --}}
@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
</style>

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

<h2>
    取引中の商品
    @if ($totalUnreadCount > 0)
        <span style="color: red; margin-left: 8px;">
            {{ $totalUnreadCount }}
        </span>
    @endif
</h2>

@forelse ($tradeProducts as $product)
    <div style="position: relative; margin-bottom: 15px;">

        {{-- 未読バッジ（0のとき非表示） --}}
        @if (($unreadCounts[$product->id] ?? 0) > 0)
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
                {{ $unreadCounts[$product->id] }}
            </span>
        @endif

        <a href="{{ route('chat.show', $product) }}"
        style="display: flex; align-items: center; gap: 10px; padding-left: 25px; text-decoration: none; color: inherit;">

            {{-- 商品画像 --}}
            @if ($product->image_path)
        @if(\Illuminate\Support\Str::startsWith($product->image_path, 'products/'))
        <img
            src="{{ asset('storage/' . $product->image_path) }}"
            alt="{{ $product->name }}"
            style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;"
        >
    @else
        <img
            src="{{ asset($product->image_path) }}"
            alt="{{ $product->name }}"
            style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;"
        >
        @endif
    @endif

            {{-- 商品名 --}}
            <span>{{ $product->name }}</span>
        </a>

    </div>
@empty
    <p>データないよ</p>
@endforelse
</div>
@endsection