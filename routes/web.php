<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => [
            [
                'name' => 'Software Engineer',
                'salary' => '$10k',
            ],
            [
                'name' => 'Web Developer',
                'salary' => '$20k',
            ],
            [
                'name' => 'Graphic Designer',
                'salary' => '$30k',
            ],
        ]
    ]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
