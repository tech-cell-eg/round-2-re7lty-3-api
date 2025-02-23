<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'يجب تسجيل الدخول أولاً']);
        }
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        Auth::user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return back()->with('success', 'تم تحديث كلمة المرور بنجاح!');
    }
}
