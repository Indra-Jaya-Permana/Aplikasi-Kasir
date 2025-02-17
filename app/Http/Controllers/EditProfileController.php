<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class EditProfileController extends Controller
{
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('profile.edit-profile', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id); // Ambil user berdasarkan ID
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    
    $user->name = $request->name;
    $user->email = $request->email;
    
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload'), $filename);
        $user->profile_photo = $filename;
    }
    
    $user->save();
    
    return redirect()->route('user.detail', $user->id)->with('success', 'Profil berhasil diperbarui!');
}

}
