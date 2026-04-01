<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Ver perfil
    public function profile() {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Editar perfil
    public function edit() {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    // Atualizar perfil
    public function update(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('user.profile')->with('success', 'Perfil atualizado!');
    }
}