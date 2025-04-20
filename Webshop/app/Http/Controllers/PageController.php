<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class PageController extends Controller
{
    /**
     * Rólunk oldal
     */
    public function about()
    {
        return view('layouts.pages.about');
    }

    /**
     * Kapcsolat oldal
     */
    public function contact()
    {
        return view('layouts.pages.contact');
    }
    public function service()
    {
        return view('layouts.pages.service');
    }

    /**
     * Kapcsolati űrlap feldolgozása
     */
    public function submitContact(Request $request)
    {
        // Validáljuk az űrlap mezőit
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'topic' => 'required|string',
            'message' => 'required|string',
            'privacy' => 'required'
        ]);

        // Email küldés az adminnak
        Mail::to('info@gamershop.hu')->send(new ContactFormMail($validatedData));

        // Visszairányítjuk a kapcsolat oldalra sikeres üzenettel
        return redirect()->route('contact')->with('success', 'Köszönjük megkeresésed! Munkatársaink hamarosan felveszik veled a kapcsolatot.');
    }

    /**
     * Szállítási információk oldal
     */
    public function shipping()
    {
        return view('layouts.pages.shipping');
    }

    /**
     * Fizetési módok oldal
     */
    public function payment()
    {
        return view('layouts.pages.payment');
    }

    /**
     * GYIK oldal
     */
    public function faq()
    {
        return view('layouts.pages.faq');
    }

    /**
     * Felhasználási feltételek oldal
     */
    public function terms()
    {
        return view('layouts.pages.terms');
    }

    /**
     * Adatvédelmi tájékoztató oldal
     */
    public function privacy()
    {
        return view('layouts.pages.privacy');
    }

    /**
     * Cookie tájékoztató oldal
     */
    public function cookies()
    {
        return view('layouts.pages.cookies');
    }

    /**
     * Sitemap oldal
     */
    public function sitemap()
    {
        return view('layouts.pages.sitemap');
    }

    /**
     * Hírlevél feliratkozás
     */
    public function subscribeNewsletter(Request $request)
    {
        // Validáljuk az űrlap mezőit
        $validatedData = $request->validate([
            'email' => 'required|email|max:100',
            'privacy' => 'required'
        ]);

        // Itt történne a hírlevél feliratkozás logikája
        // Például adatbázisba mentés vagy API hívás a hírlevélküldő rendszer felé

        // Visszairányítjuk a főoldalra sikeres üzenettel
        return redirect()->back()->with('success', 'Sikeres feliratkozás! Köszönjük, hogy feliratkoztál hírlevelünkre.');
    }
}