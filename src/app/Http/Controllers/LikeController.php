<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle(Product $product)
    {
        $userId = Auth::id();

        $existing = Like::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            // いいね解除
            $existing->delete();
            $msg = 'いいねを解除しました。';
        } else {
            // いいねする
            Like::create([
                'user_id'    => $userId,
                'product_id' => $product->id,
            ]);
            $msg = 'いいねしました！';
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', $msg);
    }
}
