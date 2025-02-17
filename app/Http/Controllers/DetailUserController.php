<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DetailUserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile.profile', compact('user'));
    }
}
