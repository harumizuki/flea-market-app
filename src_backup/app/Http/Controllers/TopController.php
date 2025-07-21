<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        dd($request->all());
    }
}
