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
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function show(): View
    {
        return view('profile.show', [
            'user' => Auth::user(),
        ]);
    }

    public function edit(): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }
    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $imageName = time() . '_' . $user->id . '.' . $request->file('image')->getClientOriginalExtension();
            $validatedData['image'] = $request->file('image')->storeAs('profile', $imageName, 'public');
        }
        if (isset($validatedData['email']) && $validatedData['email'] !== $user->email) {
            $validatedData['email_verified_at'] = null;
        }
        $user->update($validatedData);
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
    public function accountSettings()
    {
        return view('profile.settings', [
            'user' => Auth::user(),
        ]);
    }
}
