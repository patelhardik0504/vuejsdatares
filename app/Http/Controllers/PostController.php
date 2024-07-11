<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $posts = Post::paginate(2); // Adjust the number per page as needed
        return response()->json($posts);
    }
}
