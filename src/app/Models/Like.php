<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // 量産代入エラーを防ぐ（今回の用途ではこれでOK）
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
