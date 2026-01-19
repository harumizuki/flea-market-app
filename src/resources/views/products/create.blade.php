@extends('layouts.app')

@section('title', '商品登録')

@section('content')
<div class="w-50 mx-auto">
    <h2 class="mb-4">商品を登録する</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <div class="mb-3">
            <label for="name" class="form-label">商品名</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required
            >
        </div>

        {{-- 価格 --}}
        <div class="mb-3">
            <label for="price" class="form-label">価格</label>
            <input
                type="number"
                id="price"
                name="price"
                class="form-control"
                value="{{ old('price') }}"
                min="1"
                required
            >
        </div>

        {{-- 在庫数 --}}
<div class="mb-3">
    <label for="stock" class="form-label">在庫数</label>
    <input
        type="number"
        id="stock"
        name="stock"
        class="form-control"
        value="{{ old('stock', 1) }}"
        min="1"
        required
    >
</div>

        {{-- 説明 --}}
        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea
                id="description"
                name="description"
                class="form-control"
                rows="4"
                required
            >{{ old('description') }}</textarea>
        </div>

        {{-- 状態 --}}
        <div class="mb-3">
            <label for="condition" class="form-label">商品の状態</label>
            <select
                id="condition"
                name="condition"
                class="form-select"
                required
            >
                <option value="" disabled {{ old('condition') ? '' : 'selected' }}>選択してください</option>
                <option value="new" {{ old('condition') === 'new' ? 'selected' : '' }}>新品</option>
                <option value="used" {{ old('condition') === 'used' ? 'selected' : '' }}>中古</option>
            </select>
        </div>

        {{-- 画像 --}}
        <div class="mb-3">
            <label for="image" class="form-label">商品画像</label>
            <input
                type="file"
                id="image"
                name="image"
                class="form-control"
                accept="image/*"
            >
        </div>

        <button type="submit" class="btn btn-primary">登録する</button>

        <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">
            一覧に戻る
        </a>
    </form>
</div>
@endsection
