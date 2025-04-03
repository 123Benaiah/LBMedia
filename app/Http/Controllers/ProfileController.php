<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.userProfile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:9568'], // 9MB max
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            // Store new photo in storage/app/public/profile-photos
            $path                       = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
            // Clear the cache when photo changes
            $user->clearProfilePhotoCache();
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    public function deletePhoto(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::delete('public/' . $user->profile_photo);
            $user->update(['profile_photo' => null]);
            $user->clearProfilePhotoCache();

            return back()->with('success', 'Profile photo removed successfully!');
        }

        return back()->with('error', 'No profile photo to remove.');
    }
}
