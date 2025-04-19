<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    /**
     * Kapcsolatfelvételi üzenetek listázása
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Jogosultság ellenőrzése (alapvető ellenőrzés admin vagy munkatárs szerepkör nélkül)
        if (!(auth()->check())) {
            return redirect('/')->with('error', 'Nincs jogosultságod ehhez a művelethez!');
        }
        
        $query = ContactMessage::query();
        
        // Szűrés státusz szerint
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Szűrés téma szerint
        if ($request->filled('topic')) {
            $query->where('topic', $request->topic);
        }
        
        // Keresés név vagy e-mail szerint
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        
        // Dátum szerinti szűrés
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Rendezés
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        $allowedColumns = ['created_at', 'name', 'email', 'subject', 'status'];
        
        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection);
        } else {
            $query->latest();
        }
        
        $contactMessages = $query->paginate(20);
        $topics = ContactMessage::getTopics();
        
        return view('layouts.contact-messages.index', compact('contactMessages', 'topics'));
    }
    
    /**
     * Egy kapcsolatfelvételi üzenet megtekintése
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\View\View
     */
    public function show(ContactMessage $contactMessage)
    {
        // Jogosultság ellenőrzése
        if (!(auth()->check())) {
            return redirect('/')->with('error', 'Nincs jogosultságod ehhez a művelethez!');
        }
        
        return view('layouts.contact-messages.show', compact('contactMessage'));
    }
    
    /**
     * Kapcsolatfelvételi üzenet megválaszolása
     *
     * @param Request $request
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, ContactMessage $contactMessage)
    {
        // Jogosultság ellenőrzése
        if (!(auth()->check())) {
            return redirect('/')->with('error', 'Nincs jogosultságod ehhez a művelethez!');
        }
        
        $request->validate([
            'reply_message' => 'required|string|min:10',
        ]);
        
        try {
            // E-mail küldése a válasszal
            Mail::to($contactMessage->email)->send(new ContactReplyMail($contactMessage, $request->reply_message));
            
            // Üzenet státuszának frissítése
            $contactMessage->status = 'replied';
            $contactMessage->reply_sent = true;
            $contactMessage->replied_by = Auth::id();
            $contactMessage->replied_at = now();
            $contactMessage->admin_notes = $request->filled('admin_notes') 
                ? ($contactMessage->admin_notes . "\n" . now()->format('Y-m-d H:i') . " - " . $request->admin_notes)
                : $contactMessage->admin_notes;
            $contactMessage->save();
            
            return redirect()->route('contact-messages.show', $contactMessage)
                ->with('success', 'Válasz sikeresen elküldve!');
                
        } catch (\Exception $e) {
            // Hiba naplózása
            \Log::error('Hiba a kapcsolati üzenet megválaszolásakor: ' . $e->getMessage());
            
            return redirect()->route('contact-messages.show', $contactMessage)
                ->with('error', 'Hiba történt a válasz küldése közben: ' . $e->getMessage());
        }
    }
    
    /**
     * Kapcsolatfelvételi üzenet státuszának frissítése
     *
     * @param Request $request
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        // Jogosultság ellenőrzése
        if (!(auth()->check())) {
            return redirect('/')->with('error', 'Nincs jogosultságod ehhez a művelethez!');
        }
        
        $request->validate([
            'status' => 'required|in:new,in_progress,replied,closed,spam',
        ]);
        
        try {
            $contactMessage->status = $request->status;
            
            if ($request->filled('admin_notes')) {
                $contactMessage->admin_notes = $contactMessage->admin_notes
                    ? $contactMessage->admin_notes . "\n" . now()->format('Y-m-d H:i') . " - " . $request->admin_notes
                    : now()->format('Y-m-d H:i') . " - " . $request->admin_notes;
            }
            
            $contactMessage->save();
            
            return redirect()->route('contact-messages.show', $contactMessage)
                ->with('success', 'Státusz sikeresen frissítve!');
                
        } catch (\Exception $e) {
            return redirect()->route('contact-messages.show', $contactMessage)
                ->with('error', 'Hiba történt a státusz frissítése közben: ' . $e->getMessage());
        }
    }
    
    /**
     * Kapcsolatfelvételi üzenet törlése
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ContactMessage $contactMessage)
    {
        // Jogosultság ellenőrzése
        if (!(auth()->check())) {
            return redirect('/')->with('error', 'Nincs jogosultságod ehhez a művelethez!');
        }
        
        try {
            $contactMessage->delete();
            
            return redirect()->route('contact-messages.index')
                ->with('success', 'Üzenet sikeresen törölve!');
                
        } catch (\Exception $e) {
            return redirect()->route('contact-messages.index')
                ->with('error', 'Hiba történt az üzenet törlése közben: ' . $e->getMessage());
        }
    }
}