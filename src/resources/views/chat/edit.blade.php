@extends('layouts.app')

@section('content')
    <h1>メッセージ編集</h1>

    <form method="POST" action="{{ route('chat.update', $message) }}">
        @csrf
        @method('PUT')

        <input type="text" name="message" value="{{ old('message', $message->message) }}">
        <button type="submit">更新</button>
    </form>
@endsection