@extends('layouts.app')

@section('title', '購入完了')

@section('content')
<div class="container text-center">
    <h1 class="mb-4">購入ありがとうございました！</h1>

    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h5 class="card-title">{{ $item['name'] }}</h5>
            <p class="card-text">価格: ¥{{ number_format($item['price']) }}</p>
            <p class="card-text">支払い方法: {{ $payment_method }}</p>
        </div>
    </div>

    <a href="{{ url('/') }}" class="btn btn-primary mt-4">トップに戻る</a>
</div>
@endsection
