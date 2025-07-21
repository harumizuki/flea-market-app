@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <h1 class="text-center mb-4">商品一覧</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($items as $item)
            <div class="col">
                <div class="card h-100 position-relative">
                    <img src="{{ asset('images/' . $item['image']) }}" class="card-img-top" alt="{{ $item['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <p class="card-text">¥{{ number_format($item['price']) }}</p>
                        <p class="card-text">{{ $item['description'] }}</p>
                        <p class="card-text"><small class="text-muted">状態: {{ $item['condition'] }}</small></p>
                    </div>
                    <a href="{{ route('item.show', $loop->index) }}" class="stretched-link"></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
