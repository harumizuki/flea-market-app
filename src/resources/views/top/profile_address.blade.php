@extends('layouts.app')

@section('title', '送付先住所変更')

@section('content')
    <h1 class="text-center mb-4">送付先住所変更</h1>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.address.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="address" class="form-label">住所</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', Auth::user()->address ?? '') }}">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">更新する</button>
        </div>
    </form>
@endsection
