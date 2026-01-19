@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
@php
    $tab = $tab ?? request('tab', 'recommend');
    $keyword = request('keyword', '');

    $baseUrl = url('/products');

    $recommendUrl = $baseUrl . '?' . http_build_query([
        'tab' => 'recommend',
        'keyword' => $keyword,
    ]);

    $mylistUrl = $baseUrl . '?' . http_build_query([
        'tab' => 'mylist',
        'keyword' => $keyword,
    ]);

    $clearUrl = $baseUrl . '?' . http_build_query([
        'tab' => $tab,
    ]);
@endphp

<div class="container">

    {{-- タブ --}}
    <div class="tab-menu">
        <a href="{{ $recommendUrl }}" class="tab-item {{ $tab === 'recommend' ? 'active' : '' }}">
            おすすめ
        </a>
        <a href="{{ $mylistUrl }}" class="tab-item {{ $tab === 'mylist' ? 'active' : '' }}">
            マイリスト
        </a>
    </div>

    {{-- 検索 --}}
    <div class="search-area">
        <form action="{{ $baseUrl }}" method="GET" class="search-form">
            <input type="hidden" name="tab" value="{{ $tab }}">

            <input
                type="text"
                name="keyword"
                value="{{ $keyword }}"
                placeholder="商品名で検索"
                class="search-input"
            >
            <button type="submit" class="search-btn">検索</button>

            @if(!empty($keyword))
                <a href="{{ $clearUrl }}" class="search-clear">クリア</a>
            @endif
        </form>
    </div>

    {{-- 商品一覧 --}}
    @if($products->isEmpty())
        <p class="empty-text">商品がありません</p>
    @else
        <div class="product-grid">
            @foreach($products as $product)
                <a href="{{ url('/products/' . $product->id) }}" class="product-card">
                    <div class="product-image-wrap">
                        @if(!empty($product->image_path))
                            <img
                                src="{{ asset('storage/' . $product->image_path) }}"
                                alt="{{ $product->name }}"
                                class="product-image"
                            >
                        @else
                            <div class="product-image-placeholder"></div>
                        @endif

                        @if (($product->stock ?? 0) <= 0)
                            <span class="sold-badge">SOLD</span>
                        @endif
                    </div>

                    <div class="product-body">
                        <p class="product-name">{{ $product->name }}</p>

                        <div class="product-like">
                            ♡ {{ $product->likes_count ?? 0 }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</div>
@endsection
