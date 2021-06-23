<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /*****POST*****/
    //FUNCTION SHOW ALL POSTS
    public function showAllPosts(Request $request)
    {
        $posts = DB::table('posts')->get();

        return response()->json([
            'posts' => $posts
        ], 200);
    }

    //FUNCTION SHOW POST
    public function showPost(Request $request, $id)
    {

        //dd(DB::table('posts')->where('id', $id)->first());


        //On recup le post
        $post = DB::table('posts')->where('id', $id)->first();


        //CHECK IF EXIST 404
        if(is_null($post)){
            return response()->json([
                'errors' => "L'article n'existe pas."
            ], 404);
        }

        //STATUS 200 COOL
        return response()->json([
            'id' => $post->id,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
            'title' => $post->title,
            'short_body' => $post->short_body,
            'body' => $post->body,
            //'user' => ['id' => $request->user()->id,'created_at' => $request->user()->created_at,'updated_at' => $request->user()->updated_at,'family_name' => $request->user()->family_name,'given_name' => $request->user()->given_name,'email' => $request->user()->email,]
        ], 200);
    }

}
