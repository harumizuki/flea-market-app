<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ItemSeeder extends Seeder
{
    public function run(): void
        {
    Product::create([
    'user_id' => 1,          // 出品者（メル）
    'buyer_id' => 2,         // 購入者（メル2）
    'is_completed' => false, // 取引中
    'name' => '腕時計',
    'description' => 'スタイリッシュなデザインのメンズ腕時計',
    'price' => 15000,
    'stock' => 0,
    'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => 'HDD',
        'description' => '高速で信頼性の高いハードディスク',
        'price' => 5000,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => '玉ねぎ3束',
        'description' => '新鮮な玉ねぎ3束のセット',
        'price' => 300,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => '革靴',
        'description' => 'クラシックなデザインの革靴',
        'price' => 4000,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => 'ノートPC',
        'description' => '高性能なノートパソコン',
        'price' => 45000,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => 'マイク',
        'description' => '高音質のレコーディング用マイク',
        'price' => 8000,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'name' => 'ショルダーバッグ',
        'description' => 'おしゃれなショルダーバッグ',
        'price' => 3500,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => 'タンブラー',
        'description' => '使いやすいタンブラー',
        'price' => 500,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => 'コーヒーミル',
        'description' => '手動のコーヒーミル',
        'price' => 4000,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
    ]);

    Product::create([
        'user_id' => 1,
        'buyer_id' => null,
        'is_completed' => false,
        'name' => 'メイクセット',
        'description' => '便利なメイクアップセット',
        'price' => 2500,
        'stock' => 1,
        'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
    ]);
            }
}