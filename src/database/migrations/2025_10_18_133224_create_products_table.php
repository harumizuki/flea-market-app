<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('name');                 // 商品名
        $table->text('description')->nullable();// 説明
        $table->unsignedInteger('price');       // 価格（円）
        $table->unsignedInteger('stock')->default(0); // 在庫数
        $table->string('image_path')->nullable();     // 画像パス（後で使う）
        $table->unsignedBigInteger('user_id')->nullable(); // 出品者（後でリレーション）
        $table->timestamps();

        // 必要ならインデックス
        $table->index('user_id');
        $table->index('price');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
