<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('address.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'postal_code' => ['nullable', 'string', 'max:20'],
            'address'     => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->update($validated);

        return redirect()->route('profile')->with('success', '住所を更新しました。');
    }
}
