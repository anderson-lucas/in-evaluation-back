<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'id_person' => 'required|exists:person,id',
        ]);

        $contacts = Contact::with(['person', 'contact_type'])->where('id_person', $request->id_person)->get();
        
        return response()->json(['data' => $contacts]);
    }

    /**
     * show
     *
     * @return void
     */
    public function show(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        
        return response()->json(['data' => $contact]);
    }
    
    /**
     * create
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'id_person' => 'required|exists:person,id',
            'id_contact_type' => 'required|exists:contact_type,id',
            'content' => 'required|string|max:255',
        ]);

        $contact = new Contact([
            'id_person' => $request->id_person,
            'id_contact_type' => $request->id_contact_type,
            'content' => $request->content,
        ]);
        $contact->save();

        return response()->json(['data' => $contact, 'message' => 'Successfully created!']);
    }
    
    /**
     * update
     *
     * @param Request request
     * @param int id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'id_contact_type' => 'required|exists:contact_type,id',
            'content' => 'required|string|max:255',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->id_contact_type = $request->id_contact_type;
        $contact->content = $request->content;
        $contact->save();

        return response()->json(['data' => $contact, 'message' => 'Successfully updated!']);
    }
    
    /**
     * destroy
     *
     * @param int id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Successfully deleted!']);
    }
}
