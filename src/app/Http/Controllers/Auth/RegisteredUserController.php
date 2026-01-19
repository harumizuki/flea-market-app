<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * 会員登録画面の表示
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * 会員登録処理
     */
    public function store(RegisterRequest $request)
    {
        // バリデーション済みデータ取得
        $validated = $request->validated();

         // ユーザー作成
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    // 自動ログイン
    Auth::login($user);

    // 登録完了後の遷移
    return redirect()->route('login');
}
    }

