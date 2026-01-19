@extends('layouts.app')

@section('title', '購入確認')

@section('content')
<div class="container">
    <h2>購入確認</h2>

    <div class="mb-3">
        <p>商品名：{{ $product->name }}</p>
        <p>価格：{{ $product->price }}円</p>
    </div>

    {{-- ここを「商品名・価格」のすぐ下に追加 --}}
    <div class="mb-3">
        <h5>配送先住所</h5>

        <p>
            郵便番号：
            {{ Auth::user()->postal_code ?? '未登録' }}
        </p>
        <p>
            住所：
            {{ Auth::user()->address ?? '未登録' }}
        </p>

        <a href="{{ route('address.edit') }}" class="btn btn-sm btn-outline-secondary">
            住所を変更する
        </a>
    </div>

    <form action="{{ route('purchase.store', $product) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">
            購入を確定する
        </button>
    </form>

    <a href="{{ route('products.show', $product) }}" class="btn btn-secondary mt-2">
        戻る
    </a>
</div>
@endsection
