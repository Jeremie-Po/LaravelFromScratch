<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => [
            [
                'id' => 1,
                'name' => 'Software Engineer',
                'salary' => '$10k',
            ],
            [
                'id' => 2,
                'name' => 'Web Developer',
                'salary' => '$20k',
            ],
            [
                'id' => 3,
                'name' => 'Graphic Designer',
                'salary' => '$30k',
            ],
        ]
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1,
            'name' => 'Software Engineer',
            'salary' => '$10k',
        ],
        [
            'id' => 2,
            'name' => 'Web Developer',
            'salary' => '$20k',
        ],
        [
            'id' => 3,
            'name' => 'Graphic Designer',
            'salary' => '$30k',
        ],
    ];

//    vieille solution :
//    $job = Arr::first($jobs, function ($job) use ($id) {
//        return $job['id'] === $id;
//    });
    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);
    
    return view('job', [
        'job' => $job,
    ]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
