@extends('layouts.app')

@section('content')

<div style="display: flex; flex-wrap: wrap; min-height: 100vh;">

    {{-- 左：他の取引 --}}
    <div style="
        width: 250px;
        border-right: 1px solid #ccc;
        padding: 20px 10px;
        background-color: #f5f5f5;
        display: flex;
        flex-direction: column;
        align-items: center;
    ">
        <h3>他の取引</h3>

        @foreach($products->where('id', '!=', $product->id) as $p)
            <div style="margin-bottom: 10px;">
                <a href="{{ route('chat.show', $p) }}">
                    {{ $p->name }}
                </a>
            </div>
        @endforeach
    </div>

    {{-- 右：チャット --}}
    <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; padding: 20px;">

        <h2>チャット</h2>

        <p>商品名：{{ $product->name }}</p>
        <p>平均評価：{{ $averageRating ? number_format($averageRating, 1) : '未評価' }}</p>

        {{-- 成功メッセージ --}}
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- メッセージ一覧 --}}
        <div style="margin: 20px 0; height: 400px; overflow-y: scroll;">
            @foreach($messages as $message)
                <div style="
                    margin-bottom: 10px;
                    display: flex;
                    justify-content: {{ $message->user_id === auth()->id() ? 'flex-end' : 'flex-start' }};
                ">
                    <div style="
                        display: inline-block;
                        padding: 10px;
                        border-radius: 10px;
                        max-width: 60%;
                        word-break: break-word;
                        background-color: {{ $message->user_id === auth()->id() ? '#d1f0d1' : '#eee' }};
                    ">
                        <strong>{{ $message->user->name ?? '名無し' }}</strong><br>

                        {{ $message->message }}

                        @if($message->image)
                            <div style="margin-top: 8px;">
                                <img
                                    src="{{ asset('storage/' . $message->image) }}"
                                    alt="送信画像"
                                    style="max-width: 100%; border-radius: 6px;"
                                >
                            </div>
                        @endif

                        @if($message->user_id === auth()->id())
                            <div>
                                <a href="{{ route('chat.edit', $message) }}">編集</a>

                                <form method="POST" action="{{ route('chat.destroy', $message) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- バリデーションエラー（入力欄の上） --}}
        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- メッセージ送信 --}}
        <form method="POST" action="{{ route('chat.store', $product) }}" enctype="multipart/form-data" style="display:flex; gap:10px;">
            @csrf

            <input
                type="text"
                name="message"
                id="message-input"
                value="{{ old('message') }}"
                placeholder="メッセージ入力"
                style="flex:1;"
            >

            <input type="file" name="image">

            <button type="submit">送信</button>
        </form>

        {{-- 取引完了 --}}
        @if (
            !$product->is_completed &&
            auth()->id() === $product->buyer_id &&
            !$product->ratings->where('rater_id', auth()->id())->count()
        )
            <div style="margin-top: 10px;">
                <button type="button" onclick="openRatingModal()">
                    取引完了
                </button>
            </div>
        @endif
    </div>
</div>

{{-- 評価モーダル --}}
@if (
    (
        auth()->id() === $product->buyer_id &&
        !$product->ratings->where('rater_id', auth()->id())->count()
    )
    ||
    (
        auth()->id() === $product->user_id &&
        $product->ratings->where('rater_id', $product->buyer_id)->count() &&
        !$product->ratings->where('rater_id', auth()->id())->count()
    )
)
    <div id="ratingModal" style="
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    ">
        <div style="
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            width: 400px;
            max-width: 90%;
        ">
            <h3 style="margin-top: 0;">取引完了</h3>
            <p>評価を行ってください</p>

            <form action="{{ route('ratings.store') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div style="margin-bottom: 12px;">
                    <label>評価</label><br>
                    <select name="score">
                        <option value="">選択してください</option>
                        <option value="1">★1</option>
                        <option value="2">★2</option>
                        <option value="3">★3</option>
                        <option value="4">★4</option>
                        <option value="5">★5</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeRatingModal()">閉じる</button>
                    <button type="submit">送信する</button>
                </div>
            </form>
        </div>
    </div>
@endif

<script>
    function openRatingModal() {
        const modal = document.getElementById('ratingModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeRatingModal() {
        const modal = document.getElementById('ratingModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    window.onload = function () {
        @if (
            auth()->id() === $product->user_id &&
            $product->ratings->where('rater_id', $product->buyer_id)->count() &&
            !$product->ratings->where('rater_id', auth()->id())->count()
        )
            openRatingModal();
        @endif

        const messageInput = document.getElementById('message-input');
        const storageKey = 'chat_message_{{ $product->id }}';

        if (messageInput) {
            messageInput.value = localStorage.getItem(storageKey) || messageInput.value;

            messageInput.addEventListener('input', function () {
                localStorage.setItem(storageKey, messageInput.value);
            });
        }
    }
</script>

@endsection