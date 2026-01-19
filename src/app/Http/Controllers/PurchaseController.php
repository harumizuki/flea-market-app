<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    /**
     * 購入確認画面（GET）
     */
    public function show(Product $product)
    {
        return view('purchase.show', compact('product'));
    }

    /**
     * 購入確定処理（POST）
     */
    public function store(Product $product, Request $request)
    {
        $user = Auth::user();

        // ★ 自分が出品した商品は購入できない
        if ($product->user_id === $user->id) {
            return back()
                ->withErrors('自分が出品した商品は購入できません')
                ->withInput();
        }

        try {
            DB::transaction(function () use ($product, $user) {
                // 悲観ロックで在庫を正しく更新
                $p = Product::whereKey($product->id)->lockForUpdate()->first();

                if ($p->stock < 1) {
                    abort(422, '在庫がありません。');
                }

                // 在庫を1減らす
                $p->decrement('stock', 1);

                // 購入履歴を作成（数量は1で固定）
                Purchase::create([
    'user_id'     => $user->id,
    'product_id'  => $p->id,
    'quantity'    => 1,
    'price'       => $p->price,
    'postal_code' => $user->postal_code,
    'address'     => $user->address,
]);

            });
        } catch (\Throwable $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', '購入が完了しました。');
    }
}
