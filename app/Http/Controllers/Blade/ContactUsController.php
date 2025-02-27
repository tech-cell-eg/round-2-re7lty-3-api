<?php

namespace App\Http\Controllers\Blade;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactReplyMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    // public function reply(Request $request, $id)
    // {
    //     $contact = Contact::findOrFail($id);

    //     $validated = $request->validate([
    //         'admin_reply' => 'required|string',
    //     ]);

    //     $contact->markAsReplied($validated['admin_reply']);
    //     $contact->is_replied = 1;
    //     $contact->save();

    //     return back()->with('success', 'تم الرد على الرسالة بنجاح.');
    // }

    public function reply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validated = $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $contact->markAsReplied($validated['admin_reply']);

        Mail::to($contact->email)->send(new ContactReplyMail($contact));

        return back()->with('success', 'تم الرد على الرسالة وإرسال البريد الإلكتروني بنجاح.');
    }

    public function unreplied()
    {
        $contacts = Contact::unreplied()->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return back()->with('success', 'تم حذف الرسالة بنجاح.');
    }
}
