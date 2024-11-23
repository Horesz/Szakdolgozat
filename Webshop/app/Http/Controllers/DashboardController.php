<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // Példa adatok (ezeket cserélheted dinamikus tartalomra)
    $user = auth()->user(); // Az aktuális bejelentkezett felhasználó
    $recentActivities = []; // Pl. aktivitások vagy statisztikák

    return view('dashboard', compact('user', 'recentActivities')); // Módosított nézet neve
}
}
