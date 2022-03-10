<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|max:25|min:2',
            'email' => 'required |email|unique:users,email',
            'password' => 'required | min:4'
        ]);
        //  $email=$request->email;

         $user = User::create($attributes);
        // Mail::to(request('email'))
        //     ->send(new ContactMe('Laravel 9'));
        //     // dd("Email is Sent");
         auth()->login($user);
        return redirect('categories')->with('message', 'Your Account has been created Successfully');
    }
}
