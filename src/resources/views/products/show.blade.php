@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="container">

    <div class="product-show">
        {{-- 左：商品画像 --}}
        <div class="product-image-wrap">
            @if (!empty($product->image_path))
                <img
                    src="{{ asset('storage/' . $product->image_path) }}"
                    alt="{{ $product->name }}"
                    class="product-image"
                >
            @else
                <div class="product-image-placeholder">
                    商品画像
                </div>
            @endif

            {{-- SOLD（在庫0以下なら表示） --}}
            @if (($product->stock ?? 0) <= 0)
                <span class="sold-badge">SOLD</span>
            @endif
        </div>

        {{-- 右：商品情報 --}}
        <div class="product-info">
            <h2 class="product-name">
                {{ $product->name ?? '商品名未設定' }}
            </h2>

            <p class="product-price">
                ¥{{ number_format($product->price ?? 0) }}（税込）
            </p>

            {{-- 購入ボタン --}}
            @guest
                <a href="{{ route('login') }}" class="purchase-btn">
                    購入手続きへ
                </a>
            @else
                <a href="{{ route('purchase.show', $product->id) }}" class="purchase-btn">
                    購入手続きへ
                </a>
            @endguest

            {{-- いいね・コメント --}}
            <div class="product-actions">
    @auth
        <form action="{{ route('likes.toggle', $product) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="like-btn">
                ♡ いいね {{ $product->likes_count ?? 0 }}
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="like-btn">
            ♡ いいね {{ $product->likes_count ?? 0 }}
        </a>
    @endauth

    <span class="comment-count">💬 0</span>
</div>


            <div class="product-description">
                <h3>商品説明</h3>
                <p>{{ $product->description ?? '説明なし' }}</p>
            </div>
        </div>
    </div>

    {{-- 戻る --}}
<div style="margin-top: 30px;">
    <a href="{{ route('products.index', request()->only(['tab','keyword'])) }}">
        ← 戻る
    </a>
</div>

@endsection
