<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs/create', function () {
    return view('jobs.create', []);
});

Route::get('/jobs', function () {
//    $jobs = Job::with('employer')->get();
    $jobs = Job::with('employer')->simplePaginate(10);

    return view('jobs.index', [
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

    return view('jobs.show', [
        'job' => $job,
    ]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
