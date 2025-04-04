<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Newsletter;
use App\Mail\ContactForm;

class PageController extends Controller
{
    /**
     * Megjeleníti a Rólunk oldalt
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Megjeleníti a Kapcsolat oldalt
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Kapcsolati űrlap beküldésének kezelése
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Email küldése a cég címére
        Mail::to('info@gamershop.hu')->send(new ContactForm($validated));

        return back()->with('success', 'Köszönjük! Üzeneted sikeresen elküldtük. Hamarosan válaszolunk.');
    }

    /**
     * Hírlevél feliratkozás kezelése
     */
    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'Sikeresen feliratkoztál hírlevelünkre!');
    }

    /**
     * Megjeleníti az ÁSZF oldalt
     */
    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * Megjeleníti az Adatvédelmi oldalt
     */
    public function privacy()
    {
        return view('pages.privacy');
    }

    /**
     * Megjeleníti a Cookie szabályzat oldalt
     */
    public function cookies()
    {
        return view('pages.cookies');
    }

    /**
     * Megjeleníti az Oldaltérkép oldalt
     */
    public function sitemap()
    {
        return view('pages.sitemap');
    }
}