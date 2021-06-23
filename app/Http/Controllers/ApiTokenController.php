<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{

    //FUNCTION REGISTER
    public function register(Request $request)
    {

        //Validation 422 si erreur
        $request->validate([
            'email' => 'required|email',
            'family_name' => 'required',
            'given_name' => 'required',
            'password' => 'required'
        ]);

        //Check si l'user existe
        $exists = User::where('email', $request->email)->exists();

        //Si l'user existe 409
        if($exists){
            return response()->json(['errors' => "Utilisateur déjà inscrit"], 409);
        }


        //Sinon on le créé
        $user = User::create([
            'email' => $request->email,
            'family_name' => $request->family_name,
            'given_name' => $request->given_name,
            'password' => Hash::make($request->password)
        ]);

        //TOKEN CREATION
        $token = $user->createToken($request->email)->plainTextToken;

        //RETURN 201 OK
        return response()->json([
            'token' => $token
        ], 201);

    }

}
