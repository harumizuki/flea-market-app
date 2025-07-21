@extends('layouts.app')

@section('title', $item['name'] . ' の詳細ページ')

@section('content')
    <div class="card mx-auto" style="max-width: 400px;">
        <img src="{{ asset('images/' . $item['image']) }}" class="card-img-top" alt="{{ $item['name'] }}">
        <div class="card-body">
            <h3 class="card-title">{{ $item['name'] }}</h3>
            <p class="card-text">価格: ¥{{ number_format($item['price']) }}</p>
            <p class="card-text">説明: {{ $item['description'] }}</p>
            <p class="card-text"><small class="text-muted">状態: {{ $item['condition'] }}</small></p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">一覧に戻る</a>
        </div>
    </div>
@endsection
