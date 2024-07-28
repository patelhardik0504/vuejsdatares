<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $posts = Post::paginate(2); // Adjust the number per page as needed
        return response()->json($posts);
    }

    public function state()
    {
        $state = DB::table('states')->take(30)->get();
        return response()->json($state);
       
    }

    public function SaveData(Request $request)
    {
    //    dd($request->all());
        $user = User::where('id',1)->first(); // Get the authenticated user
       
        $selections = $request->input('selections', []);
        
        // Store the selections as a JSON attribute on the user
        $user->selections = $selections;
        $user->save();

        
        return response()->json($user);

        return response()->json(['message' => 'Selections saved successfully']);
    }

    public function getProfile()
    {
        // Fetch user profile
        $user = User::where('id',1)->first(); // Get the authenticated user
      
        return response()->json($user);
    }
}
