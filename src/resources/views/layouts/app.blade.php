<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'アプリ名')</title>

    <style>
        body { margin: 0; }

        /* ===== Header（Figma寄せ） ===== */
        .ct-header { background:#000; }
        .ct-header__inner{
            max-width: 1100px;
            margin: 0 auto;
            height: 64px;
            display:flex;
            align-items:center;
            gap: 24px;
            padding: 0 16px;
        }
        .ct-header__logo img{ height: 32px; display:block; }
        .ct-header__search{ flex:1; display:flex; justify-content:center; }
        .ct-header__search input{
            width: 520px;
            max-width: 100%;
            height: 34px;
            border-radius: 2px;
            border: none;
            padding: 0 12px;
            outline: none;
        }

        .ct-header__nav{
            display:flex;
            align-items:center;
            gap:16px;
            flex-wrap: nowrap;
            white-space: nowrap;
        }
        .ct-header__nav form{ margin: 0; }

        .ct-header__link{
            color:#fff;
            text-decoration:none;
            font-size:14px;
        }
        .ct-header__link--button{
            background: transparent;
            border:none;
            padding:0;
            cursor:pointer;
        }
        .ct-header__btn{
            background:#fff;
            color:#000;
            padding: 6px 14px;
            border-radius: 2px;
            text-decoration:none;
            font-size:14px;
            display:inline-block;
        }

        .ct-main{ max-width:1100px; margin:0 auto; padding: 24px 16px; }

        .ct-alert{ margin: 16px 0; padding: 12px 16px; border-radius: 4px; }
        .ct-alert--success{ background:#d1e7dd; }
        .ct-alert--danger{ background:#f8d7da; }
        .ct-alert ul{ margin: 0; padding-left: 18px; }

        .product-show{
            display: flex;
            gap: 40px;
            margin-top: 40px;
        }

        /* 左：画像 */
        .product-image-wrap{
            position: relative;
            width: 400px;
        }

        .product-image-placeholder{
            width: 100%;
            height: 400px;
            background: #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 14px;
        }

        .sold-badge{
            position: absolute;
            top: 16px;
            left: 16px;
            background: #ff3b3b;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 2px;
            letter-spacing: .02em;
        }

        /* 右：商品情報 */
        .product-info{ flex: 1; }

        .product-name{
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .product-price{
            font-size: 18px;
            margin: 0 0 16px;
            color: #111;
        }

        /* 購入ボタン */
        .purchase-btn{
            display: inline-block;
            background: #ff3b3b;
            color: #fff;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .product-actions{
            display: flex;
            gap: 14px;
            align-items: center;
            margin: 10px 0 18px;
        }

        .like-btn{
            background: transparent;
            border: none;
            color: #111;
            padding: 0;
            font-size: 14px;
            cursor: pointer;
        }

        .comment-count{
            font-size: 14px;
            color: #111;
        }


        /* 商品説明 */
        .product-description h3{
            font-size: 16px;
            margin: 0 0 8px;
            font-weight: 700;
        }

        .product-description p{
            margin: 0;
            line-height: 1.7;
            color: #333;
        }

　　　　　.product-name{
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px;
            color: #111;
            line-height: 1.25;
        }

        .product-price{
            font-size: 18px;
            margin: 0 0 18px;
            color: #111;
            line-height: 1.4;
        }

        .product-description h3{
            font-size: 16px;
            margin: 18px 0 8px;
            font-weight: 700;
            color: #111;
        }

        .product-description p{
            margin: 0;
            line-height: 1.8;
            color: #444;
            font-size: 14px;
        }


        /* 狭い画面は縦並び */
        @media (max-width: 900px){
            .product-show{
                flex-direction: column;
                gap: 24px;
            }
            .product-image-wrap{ width: 100%; }
            .product-image-placeholder{ height: 320px; }
        }

        /* ===== index（一覧）用 ===== */
.tab-menu{
    display:flex;
    gap:24px;
    border-bottom:1px solid #eee;
    margin-top: 18px;
}
.tab-item{
    display:inline-block;
    padding: 10px 0;
    color:#333;
    text-decoration:none;
    font-weight:700;
}
.tab-item.active{
    color:#ff3b3b;
    border-bottom:2px solid #ff3b3b;
}

.search-area{
    margin: 18px 0 20px;
}
.search-form{
    display:flex;
    gap:10px;
    align-items:center;
}
.search-input{
    width: 360px;
    max-width: 100%;
    height: 36px;
    border:1px solid #ddd;
    border-radius: 4px;
    padding: 0 10px;
}
.search-btn{
    height: 36px;
    padding: 0 14px;
    border:1px solid #ddd;
    background:#fff;
    border-radius:4px;
    cursor:pointer;
}
.search-clear{
    color:#666;
    text-decoration:none;
    font-size: 14px;
}

.product-grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-top: 16px;
}
.product-card{
    display:block;
    color:inherit;
    text-decoration:none;
}
.product-image{
    width:100%;
    height: 220px;
    object-fit: cover;
    display:block;
    background:#e5e5e5;
}
.product-body{
    margin-top: 10px;
}
.product-like{
    margin-top: 6px;
    font-size: 14px;
    color:#111;
}

@media (max-width: 900px){
    .product-grid{ grid-template-columns: repeat(2, 1fr); }
}

    </style>
</head>

<body>
    {{-- Figma Header --}}
    <header class="ct-header">
        <div class="ct-header__inner">
            <a class="ct-header__logo" href="{{ route('products.index') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH">
            </a>

            <form class="ct-header__search" method="GET" action="{{ route('products.index') }}">
                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="なにをお探しですか？"
                >
            </form>

            <nav class="ct-header__nav">
                @guest
                    <a class="ct-header__link" href="{{ route('login') }}">ログイン</a>
                    {{-- 未ログイン時もマイページ押したらログインへ、などにするなら後でBで整える --}}
                    <a class="ct-header__link" href="{{ route('login') }}">マイページ</a>
                    <a class="ct-header__btn" href="{{ route('products.create') }}">出品</a>
                @endguest

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="ct-header__link ct-header__link--button">
                            ログアウト
                        </button>
                    </form>

                    <a class="ct-header__link" href="{{ route('profile') }}">マイページ</a>

                    <a class="ct-header__btn" href="{{ route('products.create') }}">出品</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="ct-main">
        {{-- フラッシュ＆エラー --}}
        @if (session('success'))
            <div class="ct-alert ct-alert--success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="ct-alert ct-alert--danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
