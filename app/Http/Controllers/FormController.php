<?php

namespace App\Http\Controllers;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FormController extends Controller
{
    //
    public function store(Request $request)
    {
        $user  = Auth::user();
       
        $form = Form::create([
            'user_id' => $user->id,
            'data' => json_encode($request->data),
        ]);

        return response()->json(['message' => 'Form submitted successfully'], 200);
    }
    public function approve($id)
    {
        $form = Form::find($id);
        $form->is_approved = true;
        $form->save();

        return response()->json(['message' => 'Form approved successfully'], 200);
    }

    public function show($id)
    {
        $form = Form::find($id);
        return response()->json($form, 200);
    }

    public function index()
    {

    }

    public function userForm()
    {
        $form = Form::where('user_id', auth()->id())->first();
        dd($form);
        return response()->json($form, 200);
    }
}
