<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class UserController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        if(auth("sanctum")->check()){
           
            $form = Form::where('user_id', auth()->id())->first();
         
           
            $user = auth("sanctum")->user();
            $succuss['user'] = $user;
            $succuss['form'] = $form;
           
            return response()->json($succuss);
        }
    }
}
