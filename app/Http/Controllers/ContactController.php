<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //*****CONTACT******
    //FUNCTION SEND CONTACT FORM
    public function sendContactForm(Request $request)
    {
        //Validations 422
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);

        //SEND DES INFORMATIONS

        //204 success
        return response()->json([
            'success' => 'Contact form sent'
        ], 204);

    }
}
