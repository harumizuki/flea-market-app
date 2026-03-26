@extends('layouts.app')

@section('content')
<h1>取引中の商品一覧</h1>

@foreach($products as $product)
    <div>
        <a href="{{ route('chat.show', $product) }}">
            {{ $product->name }}
        </a>
    </div>
@endforeach

@endsection