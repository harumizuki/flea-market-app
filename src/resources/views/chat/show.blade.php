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
        <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column;">

            <h2>チャット</h2>

            <p>商品名：{{ $product->name }}</p>
            <p>平均評価：{{ $averageRating ? number_format($averageRating, 1) : '未評価' }}</p>

            {{-- エラー表示 --}}
            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                                <div>
                                    <img src="{{ $product->img_url }}"
                                    alt="{{ $product->name }}"
                                    class="product-image"
                                    >
                                </div>
                            @endif

                            {{-- 自分の投稿 --}}
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

            {{-- メッセージ送信 --}}
            <form method="POST" action="{{ route('chat.store', $product) }}" enctype="multipart/form-data" style="display:flex; gap:10px;">
                @csrf

                <input type="text" name="message" value="{{ old('message') }}" placeholder="メッセージ入力" style="flex:1;">

                <input type="file" name="image" accept=".png,.jpeg">

                <button type="submit">送信</button>
            </form>

            {{-- 取引完了 --}}
            @if (!$product->is_completed && auth()->id() === $product->buyer_id)
                <form method="POST" action="{{ route('trade.complete', $product) }}" style="margin-top: 10px;">
                    @csrf
                    <button type="submit">取引完了</button>
                </form>
            @endif

            {{-- 評価 --}}
            @if ($product->is_completed)
                <hr>

                <form action="{{ route('ratings.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div>
                        <label>評価</label>
                        <select name="score">
                            <option value="">選択してください</option>
                            <option value="1">★1</option>
                            <option value="2">★2</option>
                            <option value="3">★3</option>
                            <option value="4">★4</option>
                            <option value="5">★5</option>
                        </select>
                    </div>

                    <div>
                        <label>コメント</label>
                        <textarea name="comment"></textarea>
                    </div>

                    <button type="submit">評価する</button>
                </form>
            @endif

        </div>

    </div>

</div>

@endsection