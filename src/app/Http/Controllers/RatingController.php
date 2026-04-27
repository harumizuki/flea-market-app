<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionCompletedMail;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth()->user();

        // 商品取得
        $product = Product::find($request->product_id);

        $alreadyRated = Rating::where('rater_id', $user->id)
            ->where('product_id', $product->id)
            ->exists();

            if ($alreadyRated) {
            return redirect()->back()->with('error', 'すでに評価済みです');
        }

        // 評価保存
        $ratedId = auth()->id() === $product->buyer_id
            ? $product->user_id   // 購入者 → 出品者
            : $product->buyer_id; // 出品者 → 購入者

        Rating::create([
            'rater_id' => $user->id,
            'rated_id' => $ratedId,
            'product_id' => $product->id,
            'score' => $request->score,
        ]);

        // 評価後に件数チェック
        $ratingCount = \App\Models\Rating::where('product_id', $product->id)->count();

            if ($ratingCount >= 2) {
            $product->is_completed = true;
            $product->save();
}
        $targetUser = \App\Models\User::find($product->user_id);

        if ($targetUser) {
        Mail::to($targetUser->email)->send(new TransactionCompletedMail($product));
        }

        return redirect()->route('products.index')->with('success', '評価しました');
    }

}