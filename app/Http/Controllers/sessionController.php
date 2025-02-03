<?php

namespace App\Http\Controllers;

class sessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(){
        dd(request()->all());
    }
}
