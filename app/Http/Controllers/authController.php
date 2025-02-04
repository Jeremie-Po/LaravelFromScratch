<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class authController extends Controller
{
    public function create(){

        return view('auth.register');
    }

    public function store()
    {
        $attrs = request()->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::min(6), 'confirmed']
        ]);

        $user = User::create($attrs);

        Auth::login($user);

        return redirect('/jobs');
    }

}
