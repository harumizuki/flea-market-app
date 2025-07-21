<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;

Route::get('/', [TopController::class, 'index']);
Route::get('/item/{id}', [TopController::class, 'show'])->name('item.show');
Route::get('/item/create', [TopController::class, 'create'])->name('item.create');
Route::post('/item/store', [TopController::class, 'store'])->name('item.store');
