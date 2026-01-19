<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:200'],
        ]);

        Comment::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
            'body'       => $validated['body'],
        ]);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'コメントを投稿しました！');
    }
}
