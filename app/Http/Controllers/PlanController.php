<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /*****PLANS*****/
    //FUNCTION SHOW ALL PLANS
    public function showAllPlans()
    {
        $plans = DB::table('plans')->get();

        return response()->json([
            'plans' => $plans
        ], 200);
    }

    //FUNCTION SUBSCRIPTION PLAN
    public function subscribePlan(Request $request)
    {
        //401 GÉRÉ PAR SANCTUM

        //422 VALIDATIONS DES CHAMPS
        $request->validate([
            'family_name' => 'required',
            'token' => 'required',
            'plan' => 'required',
            'coupon' => 'nullable'
        ]);


        //RETURN 204
        return response()->json([
            'success' => 'Subscription success'
        ], 204);
    }
}
