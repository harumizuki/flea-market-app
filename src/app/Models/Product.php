<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rating;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'image_path',
    'user_id',
    'buyer_id',
    'is_completed',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function messages()
{
    return $this->hasMany(Message::class);
}
    public function ratings()
    {
    return $this->hasMany(Rating::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
