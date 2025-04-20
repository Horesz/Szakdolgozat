<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Profil szerkesztési oldal megjelenítése
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Profil adatok frissítése
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validáció
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => 'nullable|string|max:20',
            'address_zip' => 'nullable|string|max:10',
            'address_city' => 'nullable|string|max:100',
            'address_street' => 'nullable|string|max:255',
            'address_additional' => 'nullable|string|max:100',
            'profile_image' => 'nullable|image|max:2048' // Maximum 2MB kép
        ]);

        // Felhasználó adatok frissítése
        $user->update([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null,
            'address_zip' => $validatedData['address_zip'] ?? null,
            'address_city' => $validatedData['address_city'] ?? null,
            'address_street' => $validatedData['address_street'] ?? null,
            'address_additional' => $validatedData['address_additional'] ?? null,
        ]);

        // Profilkép feltöltése
        if ($request->hasFile('profile_image')) {
            // Régi kép törlése (ha van)
            if ($user->profile_image && Storage::exists($user->profile_image)) {
                Storage::delete($user->profile_image);
            }

            // Új kép mentése
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
            $user->save();
        }

        // Sikeres frissítés után átirányítás
        return redirect()->route('profile.edit')
            ->with('success', 'Profil adatok sikeresen frissítve!');
    }

    /**
     * Profil törlése
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Felhasználó kijelentkeztetése
        Auth::logout();

        // Felhasználó törlése
        $user->delete();

        // Munkamenet érvénytelenítése
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Átirányítás a főoldalra
        return redirect('/')->with('success', 'Felhasználói fiók sikeresen törölve.');
    }
}