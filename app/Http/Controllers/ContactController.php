<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    public function index()
    {
        return Response::json(Contact::where("user_id", $this::$user->id));
    }

    public function store(ContactRequest $request)
    {
        $contact          = new Contact;
        $contact->name    = $request->name;
        $contact->contact = $request->contact;
        $contact->email   = $request->email;
        $contact->save();

        return Response::json($contact);
    }

    public function update(ContactRequest $request, int $id)
    {
        $contact = Contact::where("id", $id)->where("user_id", $this::$user->id)->first();
        if (!$contact) return Response::json(["message" => "Contact not found"], HttpResponse::HTTP_NOT_FOUND);

        $contact->name    = $request->name;
        $contact->contact = $request->contact;
        $contact->email   = $request->email;
        $contact->save();

        return Response::noContent();
    }
}
