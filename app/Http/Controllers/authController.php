<?php

namespace App\Http\Controllers;

class authController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store()
    {
        dd('hello');
    }
}
