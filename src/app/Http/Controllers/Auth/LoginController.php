<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * ログイン画面の表示
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     */
    public function store(LoginRequest $request)
    {
        // バリデーション済みデータ取得
        $credentials = $request->validated();

        // 認証試行
        if (!Auth::attempt($credentials)) {
            // 認証失敗（テスト仕様に合わせたメッセージ）
            return back()
                ->withErrors([
                    'email' => 'ログイン情報が登録されていません',
                ])
                ->withInput();
        }

        // 認証成功 → セッション再生成
        $request->session()->regenerate();

        // 好きな遷移先へ
        return redirect()->route('products.index');
    }
}
