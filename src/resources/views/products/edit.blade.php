@extends('layouts.app')

@section('title', '商品編集')

@section('content')
<div class="w-50 mx-auto">
    <h2 class="mb-4">商品を編集する</h2>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 商品名 --}}
        <div class="mb-3">
            <label for="name" class="form-label">商品名</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name', $product->name) }}"
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
                value="{{ old('price', $product->price) }}"
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
            >{{ old('description', $product->description) }}</textarea>
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
                <option value="new"  {{ old('condition', $product->condition) === 'new'  ? 'selected' : '' }}>新品</option>
                <option value="used" {{ old('condition', $product->condition) === 'used' ? 'selected' : '' }}>中古</option>
            </select>
        </div>

        {{-- 現在の画像 --}}
        @if ($product->image_path)
            <div class="mb-3">
                <label class="form-label d-block">現在の画像</label>
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="" class="img-thumbnail" style="max-height: 200px;">
            </div>
        @endif

        {{-- 画像変更 --}}
        <div class="mb-3">
            <label for="image" class="form-label">画像を変更する（任意）</label>
            <input
                type="file"
                id="image"
                name="image"
                class="form-control"
                accept="image/*"
            >
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">更新する</button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary ms-2">詳細に戻る</a>
        </div>
    </form>
</div>
@endsection
