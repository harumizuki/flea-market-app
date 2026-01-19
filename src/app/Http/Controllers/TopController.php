<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;

class TopController extends Controller
{
    private $items = [
        [
            'name' => '腕時計',
            'price' => 15000,
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'image' => 'Armani_Mens_Clock.jpg',
            'condition' => '良好',
        ],
        [
            'name' => 'HDD',
            'price' => 5000,
            'description' => '高速で信頼性の高いハードディスク',
            'image' => 'HDD_Hard_Disk.jpg',
            'condition' => '目立った傷や汚れなし',
        ],
        [
            'name' => '玉ねぎ3束',
            'price' => 300,
            'description' => '新鮮な玉ねぎ3束のセット',
            'image' => 'iLoveIMG_d.jpg',
            'condition' => 'やや傷や汚れあり',
        ],
        [
            'name' => '革靴',
            'price' => 4000,
            'description' => 'クラシックなデザインの革靴',
            'image' => 'Leather_Shoes_Product_Photo.jpg',
            'condition' => '状態が悪い',
        ],
        [
            'name' => 'ノートPC',
            'price' => 45000,
            'description' => '高性能なノートパソコン',
            'image' => 'Living_Room_Laptop.jpg',
            'condition' => '良好',
        ],
        [
            'name' => 'マイク',
            'price' => 8000,
            'description' => '高音質のレコーディング用マイク',
            'image' => 'Music_Mic_4632231.jpg',
            'condition' => '目立った傷や汚れなし',
        ],
        [
            'name' => 'ショルダーバッグ',
            'price' => 3500,
            'description' => 'おしゃれなショルダーバッグ',
            'image' => 'Purse_fashion_pocket.jpg',
            'condition' => 'やや傷や汚れあり',
        ],
        [
            'name' => 'タンブラー',
            'price' => 500,
            'description' => '使いやすいタンブラー',
            'image' => 'Tumbler_souvenir.jpg',
            'condition' => '状態が悪い',
        ],
        [
            'name' => 'コーヒーミル',
            'price' => 4000,
            'description' => '手動のコーヒーミル',
            'image' => 'Waitress_with_Coffee_Grinder.jpg',
            'condition' => '良好',
        ],
        [
            'name' => 'メイクセット',
            'price' => 2500,
            'description' => '便利なメイクアップセット',
            'image' => 'MakeUp_Set.jpg',
            'condition' => '目立った傷や汚れなし',
        ],
    ];

    public function index()
    {
        return view('top.index', ['items' => $this->items]);
    }

    public function show($id)
    {
        if (!isset($this->items[$id])) {
            abort(404);
        }

        $item = $this->items[$id];
        return view('top.show', compact('item'));
    }

    public function create()
    {
        return view('top.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'description' => 'required|string',
            'condition' => 'required|string',
        ]);

        session()->flash('success', '商品を出品しました！');
        return redirect('/');
    }

    public function buy($id)
    {
        if (!isset($this->items[$id])) {
            abort(404);
        }

        $item = $this->items[$id];
        return view('buy', compact('item'));
    }

    public function confirmBuy($id, Request $request)
    {
        if (!isset($this->items[$id])) {
            abort(404);
        }

        $validated = $request->validate([
            'payment_method' => 'required|string',
        ]);

        session()->flash('success', '購入が完了しました！');

        return view('thanks', [
            'item' => $this->items[$id],
            'payment_method' => $validated['payment_method'],
        ]);
    }

    /**
 * プロフィール画面（購入した商品一覧つき）
 */
public function profile()
{
    $user = Auth::user();

    $purchases = collect();

    try {
        $purchases = Purchase::query()
            ->latest()
            ->where('user_id', $user->id)
            ->get();

        if (method_exists(Purchase::class, 'product')) {
            $purchases->load('product');
        }
    } catch (\Throwable $e) {
        \Log::error('Failed to load purchases in profile()', [
            'error' => $e->getMessage(),
        ]);
    }

    if (view()->exists('profile.index')) {
        return view('profile.index', compact('user', 'purchases'));
    }

    return response()->view('errors.simple', [
        'title' => 'Profile',
        'message' => 'profile.index が未作成です（表示だけ仮）',
        'user' => $user,
    ], 200);
}



    /**
     * プロフィール編集画面（とりあえず表示だけ）
     */
    public function editProfile()
    {
        return view('profile.edit');
    }

    /**
     * プロフィール更新（仮）
     */
    public function updateProfile(Request $request)
    {
        return redirect()->route('profile');
    }

    /**
     * 住所変更画面（とりあえず表示だけ）
     */
    public function editAddress()
    {
        return view('profile.address');
    }

    /**
     * 住所更新（仮）
     */
    public function updateAddress(Request $request)
    {
        return redirect()->route('profile');
    }
}
