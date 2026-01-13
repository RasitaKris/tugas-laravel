<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; 

class ProfileController extends Controller
{
    public function edit()
    {
        return view('auth.profile', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
{
    $request->validate([
        'name'  => ['required', 'string', 'max:255'],
        'email' => [
            'required', 'email', 'max:255', 
            Rule::unique('users')->ignore(auth()->user()->id)
        ],
        'phone'   => ['nullable', 'string', 'max:20'],
        'address' => ['nullable', 'string', 'max:500'], 
        'photo'   => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
    ]);

    $user = auth()->user();
    
    $data = [
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'address' => $request->address, 
    ];

    if ($request->hasFile('photo')) {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $path = $request->file('photo')->store('profile-photos', 'public');
        $data['photo'] = $path;
    }

    $user->update($data);

    return back()->with('profile_status', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('password_status', 'Kata sandi berhasil diganti.');
    }
}