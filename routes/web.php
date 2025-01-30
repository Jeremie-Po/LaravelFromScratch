<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
//    $jobs = Job::with('employer')->get();
    $jobs = Job::with('employer')->simplePaginate(10);


    return view('jobs', [
        'jobs' => $jobs,
    ]);
});

Route::get('/jobs/{id}', function ($id) {

//    vieille solution avec un tableau en dur:
//    $job = Arr::first($jobs, function ($job) use ($id) {
//        return $job['id'] === $id;
//    });
//    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);
    $job = Job::find($id);

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
