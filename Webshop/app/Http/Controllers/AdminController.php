<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Felhasználók listázása
    public function index()
{
    $users = User::all(); // Az összes felhasználó lekérése
    return view('admin.users.index', compact('users'));
}

    // Felhasználó szerkesztése
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Felhasználó frissítése
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'is_admin' => 'required|boolean',
        ]);
        

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Felhasználó frissítve!');
    }

    // Felhasználó törlése
    public function destroy(User $user)
    {
        // A felhasználó törlése
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Felhasználó törölve!');
    }
}
