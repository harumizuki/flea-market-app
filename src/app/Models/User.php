<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'postal_code', // ★追加
        'address',     // ★追加
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * 購入履歴
     */
    public function purchases()
    {
        return $this->hasMany(\App\Models\Purchase::class);
    }

    /**
     * 購入した商品一覧（products を直接取得）
     */
    public function purchasedProducts()
    {
        return $this->belongsToMany(
            \App\Models\Product::class,
            'purchases',
            'user_id',
            'product_id'
        )->withPivot(['quantity', 'price']);
        // purchasesテーブルにtimestampsが無い可能性もあるので一旦付けない
    }
}
