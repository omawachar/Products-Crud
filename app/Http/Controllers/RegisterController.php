<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Mail\ContactMe;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(RegisterFormRequest $request)
    {
        
        //  $email=$request->email;
$attributes=$request->all();
        // return $attributes;
        DB::beginTransaction();
        try {
            $user = User::create($attributes);
            // Mail::to(request('email'))
            //     ->send(new ContactMe('Laravel 9'));
            //     // dd("Email is Sent");
            auth()->login($user);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
         
        return redirect('categories')->with('message', 'Your Account has been created Successfully');
    }
}
