<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RatingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップ（商品一覧）
Route::get('/', [ProductController::class, 'index']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// PG05 商品詳細： /item/{item_id} → /products/{product}
Route::get('/item/{product}', [ProductController::class, 'show'])
    ->name('items.show');

// PG08 出品： /sell → /products/create
Route::get('/sell', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('sell.create');

// PG09 マイページ： /mypage → /profile
Route::get('/mypage', [TopController::class, 'profile'])
    ->middleware('auth')
    ->name('mypage');

// PG10 プロフィール編集： /mypage/profile
// ※いったん「落ちない」こと最優先で /profile に寄せる（後で専用画面に差し替える）
Route::get('/mypage/profile', [TopController::class, 'profile'])
    ->middleware('auth')
    ->name('mypage.profile.edit');

// PG07 住所変更： /purchase/address/{item_id} → /address
// ※ {product} は現状使わないが、設計書URLで踏めるようにする
Route::get('/purchase/address/{product}', [AddressController::class, 'edit'])
    ->middleware('auth')
    ->name('purchase.address.edit');

Route::post('/purchase/address/{product}', [AddressController::class, 'update'])
    ->middleware('auth')
    ->name('purchase.address.update');


// 商品
Route::get('/products/create', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->middleware('auth')
    ->name('products.store');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware('auth')
    ->name('products.edit');

Route::put('/products/{product}', [ProductController::class, 'update'])
    ->middleware('auth')
    ->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->middleware('auth')
    ->name('products.destroy');

// 購入
Route::get('/purchase/{product}', [PurchaseController::class, 'show'])
    ->middleware('auth')
    ->name('purchase.show');

Route::post('/purchase/{product}', [PurchaseController::class, 'store'])
    ->middleware('auth')
    ->name('purchase.store');

// コメント
Route::post('/products/{product}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

// いいね
Route::post('/products/{product}/like', [LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('likes.toggle');

// プロフィール
Route::get('/profile', [TopController::class, 'profile'])
    ->middleware('auth')
    ->name('profile');

// ★★★ 配送先住所変更（今回追加）★★★
Route::get('/address', [AddressController::class, 'edit'])
    ->middleware('auth')
    ->name('address.edit');

Route::post('/address', [AddressController::class, 'update'])
    ->middleware('auth')
    ->name('address.update');

Route::get('/chat/{product}', [App\Http\Controllers\ChatController::class, 'show'])
    ->middleware('auth')
    ->name('chat.show');

Route::post('/chat/{product}', [App\Http\Controllers\ChatController::class, 'store'])
    ->middleware('auth')
    ->name('chat.store');

Route::get('/chat/{product}', [ChatController::class, 'show'])
    ->middleware('auth')
    ->name('chat.show');

Route::post('/chat/{product}', [ChatController::class, 'store'])
    ->middleware('auth')
    ->name('chat.store');

Route::put('/chat/{message}', [ChatController::class, 'update'])
    ->middleware('auth')
    ->name('chat.update');

Route::get('/chat/{message}/edit', [ChatController::class, 'edit'])
    ->middleware('auth')
    ->name('chat.edit');

Route::delete('/chat/{message}', [ChatController::class, 'destroy'])
    ->middleware('auth')
    ->name('chat.destroy');

Route::get('/trades', [ChatController::class, 'index'])
    ->middleware('auth')
    ->name('chat.index');

Route::post('/products/{product}/rate', [RatingController::class, 'store'])
    ->middleware('auth')
    ->name('rating.store');

Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

Route::post('/trade/{product}/complete', [App\Http\Controllers\ChatController::class, 'complete'])
    ->name('trade.complete');