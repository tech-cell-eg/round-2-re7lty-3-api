<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;


class ProfileController extends Controller
{

    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->validated());
        if ($request->hasFile('image')) {
        if ($user->image) {
        Storage::disk('public')->delete($user->image);
        }
        $imageName = time() . '_' . $user->id . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->storeAs('profile', $imageName, 'public');
        $user->image = $imagePath;
        }
        if ($user->isDirty('email')) {
        $user->email_verified_at = null;
        }
        $user->save();
        return redirect()->route('profile.show')->with('success', 'تم تحديث الملف الشخصي بنجاح!');
    }
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('dashboard');
    }
}
