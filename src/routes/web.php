<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;

Route::get('/', [TopController::class, 'index']);
Route::get('/item/{id}', [TopController::class, 'show'])->name('item.show');
Route::get('/item/create', [TopController::class, 'create'])->name('item.create');
Route::post('/item/store', [TopController::class, 'store'])->name('item.store');

Route::get('/profile', [TopController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [TopController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/update', [TopController::class, 'updateProfile'])->name('profile.update');

Route::get('/profile/address', [TopController::class, 'editAddress'])->name('profile.address');
Route::post('/profile/address/update', [TopController::class, 'updateAddress'])->name('profile.address.update');

Route::get('/item/{id}/buy', [TopController::class, 'buy'])->name('item.buy');
Route::post('/item/{id}/buy/confirm', [TopController::class, 'confirmBuy'])->name('item.buy.confirm');
