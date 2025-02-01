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
    $jobs = Job::with('employer')->latest()->simplePaginate(10);

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

Route::post('/jobs', function () {
//validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'integer'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
