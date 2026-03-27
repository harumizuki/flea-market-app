<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        Message::create([
            'user_id' => 2,
            'product_id' => 1,
            'message' => '購入しました。よろしくお願いします。',
        ]);

        Message::create([
            'user_id' => 1,
            'product_id' => 1,
            'message' => 'ありがとうございます。こちらこそよろしくお願いします。',
        ]);
    }
}