<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Példa aktivitások (később kicserélhető valós aktivitásokra)
        $recentActivities = [
            'Regisztráció: ' . $user->created_at->format('Y-m-d H:i:s'),
            'Utolsó bejelentkezés: ' . $user->last_login_at ?? 'Első bejelentkezés'
        ];

        return view('dashboard', [
            'user' => $user,
            'recentActivities' => $recentActivities
        ]);
    }
}