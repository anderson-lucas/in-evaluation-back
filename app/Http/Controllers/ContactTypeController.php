<?php

namespace App\Http\Controllers;

use App\Models\ContactType;
use Illuminate\Http\JsonResponse;

class ContactTypeController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(): JsonResponse
    {
        $contactType = ContactType::all();
        
        return response()->json(['data' => $contactType]);
    }
}
