<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'regex:/^(\+36|06)?[0-9]{9}$/'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'address_zip' => ['nullable', 'string', 'max:10'],
            'address_city' => ['nullable', 'string', 'max:100'],
            'address_street' => ['nullable', 'string', 'max:255'],
            'address_additional' => ['nullable', 'string', 'max:255'],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ]
        ]);

        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null,
            'birth_date' => $validatedData['birth_date'] ? Carbon::parse($validatedData['birth_date']) : null,
            'address_zip' => $validatedData['address_zip'] ?? null,
            'address_city' => $validatedData['address_city'] ?? null,
            'address_street' => $validatedData['address_street'] ?? null,
            'address_additional' => $validatedData['address_additional'] ?? null,
            'password' => $validatedData['password']
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Sikeres regisztráció!');
    }
}

