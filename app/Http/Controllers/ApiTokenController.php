<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{

    /*-----AUTH-----*/
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

    //FUNCTION LOGIN
    public function login(Request $request)
    {
        //Validation champs 422
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        //Si l'user n'existe pas 401
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['errors' => "Identifiants inconnus ou erronés"], 401);
        }

        //Suppresion de l'ancien token
        $user->tokens()->where('tokenable_id', $user->id)->delete();

        //Création du nouveau token
        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'token' => $token
        ], 200);
    }

    //FUNCTION LOGOUT
    public function logout(Request $request){
        //401 UNAUTHENTICATED GÉRÉ PAR SANCTUM

        //Suppresion du token
        $request->user()->currentAccessToken()->delete();

        //status déconnecté 204
        return response()->json([
            'success' => 'Déconnecté'
        ], 204);
    }

    //FUNCTION ME
    public function me(Request $request)
    {
        //401 UNAUTHENTICATED GÉRÉ PAR SANCTUM

        //200 COOL
        return response()->json([
            'id' => $request->user()->id,
            'created_at' => $request->user()->created_at,
            'updated_at' => $request->user()->updated_at,
            'family_name' => $request->user()->family_name,
            'given_name' => $request->user()->family_name,
            'email' => $request->user()->email
        ], 200);
    }

}
