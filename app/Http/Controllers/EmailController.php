<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        $request->user()->update([
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'تم تحديث الإميل بنجاح!');
    }
}

