<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Auth as Auth ;


class ContactController extends Controller
{
    use ApiResponseTrait;

    // Show all contact messages
    public function index() {
        $contacts = Contact::orderBy('id', 'desc')->paginate(10);
        if ($contacts->isEmpty()) {
            return $this->errorResponse('No contact messages found.', 404);
        }
        return $this->successResponse($contacts, 'All contact messages retrieved successfully.');
    }

    // Show a specific contact message by ID
    public function show($id) {
        $contact = Contact::find($id);
        if (!$contact) {
            return $this->errorResponse('Contact message not found.', 404);
        }
        return $this->successResponse($contact, 'Contact message retrieved successfully.');
    }

    //create new contact by user
    public function store(ContactRequest $request) {
        $user = Auth::user();
        if (!$user) {
            return $this->errorResponse('Unauthorized action.', 401);
        }

        $data = $request->validated();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $contact = Contact::create($data);

        if (!$contact) {
            return $this->errorResponse('Failed to send contact message.', 500);
        }

        return $this->successResponse($contact, 'Contact message sent successfully.');
    }

    // Delete a contact message
    public function destroy($id) {
        $contact = Contact::find($id);
        if (!$contact) {
            return $this->errorResponse('Contact message not found.', 404);
        }
        if ($contact->delete()) {
            return $this->successResponse(null, 'Contact message deleted successfully.');
        }
        return $this->errorResponse('Failed to delete contact message.', 500);
    }
}
