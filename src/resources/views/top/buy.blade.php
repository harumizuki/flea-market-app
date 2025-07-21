@extends('layouts.app')

@section('title', '商品購入画面')

@section('content')
    <h1 class="text-center mb-4">商品購入画面</h1>

    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h5 class="card-title">購入する商品</h5>
            <p class="card-text">商品名: {{ $item['name'] }}</p>
            <p class="card-text">価格: ¥{{ number_format($item['price']) }}</p>

            <form action="{{ route('buy.confirm', $loop->index) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="payment_method" class="form-label">支払い方法</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="クレジットカード">クレジットカード</option>
                        <option value="銀行振込">銀行振込</option>
                        <option value="コンビニ払い">コンビニ払い</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/') }}" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-success">購入確定</button>
                </div>
            </form>
        </div>
    </div>
@endsection
