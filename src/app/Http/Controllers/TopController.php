<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Purchase;

class TopController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        // 購入履歴
        $purchases = Purchase::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // 取引中の商品
        $tradeProducts = Product::where(function ($query) use ($user) {
    $query->where('buyer_id', $user->id)
        ->orWhere(function ($q) use ($user) {
            $q->where('user_id', $user->id)
                ->whereNotNull('buyer_id');
        });
            })
        ->where('is_completed', false)
        ->with(['messages' => function ($query) {
    $query->latest();
        }])
        ->get()
        ->sortByDesc(function ($product) {
        return optional($product->messages->first())->created_at;
        });

        // 未読件数
        $unreadCounts = [];
        $averageRating = \App\Models\Rating::where('rated_id', $user->id)
            ->avg('score');

        if (!is_null($averageRating)) {
        $averageRating = round($averageRating);
        }

        foreach ($tradeProducts as $product) {
            $count = \App\Models\Message::where('product_id', $product->id)
            ->where('user_id', '!=', $user->id)
            ->where('is_read', false)
            ->count();

        $unreadCounts[$product->id] = $count;
    }

    $totalUnreadCount = array_sum($unreadCounts);

    return view('profile.index', compact(
        'user',
        'purchases',
        'tradeProducts',
        'unreadCounts',
        'averageRating',
        'totalUnreadCount'
    ));
}
    /**
     * プロフィール編集画面
     */
    public function editProfile()
    {
        return view('profile.edit');
    }

    /**
     * プロフィール更新
     */
    public function updateProfile(Request $request)
    {
        return redirect()->route('profile');
    }

    /**
     * 住所変更画面
     */
    public function editAddress()
    {
        return view('profile.address');
    }

    /**
     * 住所更新
     */
    public function updateAddress(Request $request)
    {
        return redirect()->route('profile');
    }
}