<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    
     public function index()
     {
         return view('profile.edit'); // Mivel edit.blade.php létezik
     }
     


    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validálás
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'postal_code' => 'nullable|string|max:10',
            'street' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:10',
            'floor' => 'nullable|string|max:10',
            'door' => 'nullable|string|max:10',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Adatok frissítése
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'postal_code' => $request->input('postal_code'),
            'street' => $request->input('street'),
            'house_number' => $request->input('house_number'),
            'floor' => $request->input('floor'),
            'door' => $request->input('door'),
        ]);

        // Profilkép frissítése
        if ($request->hasFile('profile_image')) {
            // Ha van új kép, feltöltjük és elmentjük az elérési utat
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->update(['profile_image' => $path]);
        }

        return redirect()->route('profile.edit')->with('success', 'A profilod frissítve lett!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        // Validáljuk a jelszót a fiók törléséhez
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Kijelentkeztetés és fiók törlés
        Auth::logout();

        // Fiók törlése
        $user->delete();

        // Munkamenet törlése és új generálása
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
