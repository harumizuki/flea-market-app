<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Rating;

class ChatController extends Controller
{
    public function show(Product $product)
    {
    $userId = auth()->id();

    // 🔽 追加：相手のメッセージを既読にする
    Message::where('product_id', $product->id)
        ->where('user_id', '!=', $userId)
        ->update(['is_read' => true]);

    $messages = Message::where('product_id', $product->id)
        ->latest()
        ->get();

    $products = Product::where(function ($query) use ($userId) {
    $query->where('buyer_id', $userId)
        ->orWhere(function ($q) use ($userId) {
            $q->where('user_id', $userId)
                ->whereNotNull('buyer_id');
        });
    })
        ->where('is_completed', false)
        ->get();

    $averageRating = Rating::where('product_id', $product->id)->avg('score');

    return view('chat.show', compact('product', 'messages', 'products', 'averageRating'));
    }

    public function store(StoreMessageRequest $request, Product $product)
    {

    $data = $request->validate([
        'message' => 'required|max:400',
        'image' => 'nullable|image'
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('messages', 'public');
    }

    Message::create([
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'message' => $data['message'],
        'image' => $imagePath,
    ]);

    session(['message_input' => $request->message]);

    return back();
    }

    public function update(Request $request, Message $message)
    {

    // 更新
    $message->update([
        'message' => $request->message,
    ]);

    // リダイレクト（元の商品チャットに戻る）
    return redirect()->route('chat.show', $message->product_id);
    }

    public function edit(Message $message)
    {
    return view('chat.edit', compact('message'));
    }

    public function destroy(Message $message)
    {
    $message->delete();

    return redirect()->route('chat.show', $message->product_id);
    }

    public function index()
    {
    $userId = auth()->id();

    $products = \App\Models\Product::where(function ($query) use ($userId) {
        $products = Product::where('user_id', $userId)->get();
    })
    ->withCount(['messages as unread_count' => function ($query) use ($userId) {
    $query->where('user_id', '!=', $userId);
    }])
    ->with(['messages' => function ($query) {
        $query->latest();
    }])
    ->get()
    ->sortByDesc(function ($product) {
        return optional($product->messages->first())->created_at;
    });

    return view('chat.index', compact('products'));
    }

    public function complete(\App\Models\Product $product)
    {
    // 購入者だけ許可
    if (auth()->id() !== $product->buyer_id) {
        abort(403);
    }

    return redirect()->route('chat.show', $product)
    ->with('success', '評価を行ってください');
    }
}