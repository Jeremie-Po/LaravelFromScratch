<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//create
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

//show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', [
        'job' => $job,
    ]);
});

//store
Route::post('/jobs', function () {
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

//edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', [
        'job' => $job,
    ]);
});

//Patch
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'integer'],
    ]);

    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/'.$job->id);
});

//Destroy
Route::delete('/jobs/{id}', function ($id) {
    Job::findOrFail($id)->delete();

    return redirect('/jobs');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
