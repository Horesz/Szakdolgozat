<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsolesController extends Controller
{
    public function consoles() {
        return view('categories.consoles');
    }
}
