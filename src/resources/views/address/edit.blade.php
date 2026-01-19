@extends('layouts.app')

@section('title', '住所変更')

@section('content')
<div class="container">
    <h2>送付先住所変更</h2>

    <form action="{{ route('address.update') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">郵便番号</label>
            <input type="text" name="postal_code" class="form-control"
                   value="{{ old('postal_code', $user->postal_code) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">住所</label>
            <input type="text" name="address" class="form-control"
                   value="{{ old('address', $user->address) }}">
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('profile') }}" class="btn btn-secondary ms-2">戻る</a>
    </form>
</div>
@endsection
