<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
 // 商品一覧
public function index(Request $request)
{
    $query = Product::query()
        ->withCount('likes'); // ★いいね数

    // タブ（おすすめ / マイリスト）
    $tab = $request->get('tab', 'recommend');

    // キーワード検索
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where('name', 'like', "%{$keyword}%");
    }

    if ($tab === 'mylist') {
        // マイリスト：ログイン必須
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 自分がいいねした商品だけ
        $query->whereHas('likes', function ($q) {
            $q->where('user_id', Auth::id());
        });
    } else {
        // おすすめ：ログイン中なら自分の出品商品は除外
        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }
    }

    $products = $query->latest()->get();

    return view('products.index', compact('products', 'tab'));
}

public function create()
{
    return view('products.create');
}


    // 商品登録処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'integer', 'min:1'],
            'stock'       => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string', 'max:1000'],
            'condition'   => ['required', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'user_id'     => Auth::id(),
            'name'        => $validated['name'],
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'description' => $validated['description'],
            'condition'   => $validated['condition'],
            'image_path'  => $imagePath,
        ]);

        return redirect()
            ->route('products.show', $product)
            ->with('success', '商品を登録しました。');
    }

    // 商品詳細
    public function show(Product $product)
{
    $product->loadCount('likes');

    return view('products.show', compact('product'));
}


    // 商品編集画面
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // 商品更新処理
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'integer', 'min:1'],
            'stock'       => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string', 'max:1000'],
            'condition'   => ['required', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $imagePath = $product->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $validated['name'],
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'description' => $validated['description'],
            'condition'   => $validated['condition'],
            'image_path'  => $imagePath,
        ]);

        return redirect()
            ->route('products.show', $product)
            ->with('success', '商品情報を更新しました。');
    }

    // 商品削除
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', '商品を削除しました。');
    }
}

