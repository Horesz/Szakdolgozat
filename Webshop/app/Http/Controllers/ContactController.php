<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Megjeleníti a kapcsolati oldalt
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('layouts.pages.contact');
    }

    /**
     * Feldolgozza a kapcsolati űrlap beküldését
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validáljuk az űrlap mezőit
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'topic' => 'required|string|in:general,order,product,warranty,other',
            'message' => 'required|string|min:10',
            'privacy' => 'required|accepted'
        ]);

        try {
            // Mentsük el az adatbázisba (ha létezik ContactMessage model)
            if (class_exists('App\Models\ContactMessage')) {
                $contactMessage = new ContactMessage();
                $contactMessage->name = $validatedData['name'];
                $contactMessage->email = $validatedData['email'];
                $contactMessage->subject = $validatedData['subject'];
                $contactMessage->topic = $validatedData['topic'];
                $contactMessage->message = $validatedData['message'];
                $contactMessage->ip_address = $request->ip();
                $contactMessage->user_agent = $request->userAgent();
                $contactMessage->status = 'new';
                $contactMessage->save();
            }

            // Email küldés az adminnak
            Mail::to('info@gamershop.hu')->send(new ContactFormMail($validatedData));

            return redirect()->route('contact')->with('success', 'Köszönjük megkeresésed! Munkatársaink hamarosan felveszik veled a kapcsolatot.');
        } catch (\Exception $e) {
            // Naplózzuk a hibát
            \Log::error('Hiba a kapcsolati űrlap feldolgozásakor: ' . $e->getMessage());
            
            return redirect()->route('contact')
                ->withInput()
                ->with('error', 'Sajnos hiba történt az üzenet küldése közben. Kérjük, próbáld meg később, vagy vedd fel velünk a kapcsolatot telefonon.');
        }
    }

    /**
     * Megjeleníti a kapcsolatfelvételi sikeres oldalt
     * 
     * @return \Illuminate\View\View
     */
    public function success()
    {
        return view('pages.contact-success');
    }

    /**
     * Ajax kérés kezelése a kapcsolati űrlaphoz (opcionális)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSubmit(Request $request)
    {
        // Validáljuk az űrlap mezőit
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'topic' => 'required|string|in:general,order,product,warranty,other',
            'message' => 'required|string|min:10',
            'privacy' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $validatedData = $validator->validated();

            // Mentsük el az adatbázisba (ha létezik ContactMessage model)
            if (class_exists('App\Models\ContactMessage')) {
                $contactMessage = new ContactMessage();
                $contactMessage->name = $validatedData['name'];
                $contactMessage->email = $validatedData['email'];
                $contactMessage->subject = $validatedData['subject'];
                $contactMessage->topic = $validatedData['topic'];
                $contactMessage->message = $validatedData['message'];
                $contactMessage->ip_address = $request->ip();
                $contactMessage->user_agent = $request->userAgent();
                $contactMessage->status = 'new';
                $contactMessage->save();
            }

            // Email küldés az adminnak
            Mail::to('info@gamershop.hu')->send(new ContactFormMail($validatedData));

            return response()->json([
                'success' => true,
                'message' => 'Köszönjük megkeresésed! Munkatársaink hamarosan felveszik veled a kapcsolatot.'
            ]);
        } catch (\Exception $e) {
            // Naplózzuk a hibát
            \Log::error('Hiba a kapcsolati űrlap ajax feldolgozásakor: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sajnos hiba történt az üzenet küldése közben. Kérjük, próbáld meg később, vagy vedd fel velünk a kapcsolatot telefonon.'
            ], 500);
        }
    }
}