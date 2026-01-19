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
    Schema::create('purchases', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');   // 購入者
        $table->foreignId('product_id')->constrained()->onDelete('cascade'); // 商品
        $table->unsignedInteger('quantity')->default(1); // 購入数
        $table->unsignedInteger('price');                // 購入時の価格
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
