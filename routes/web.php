<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\jobController;
use App\Http\Controllers\sessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    TranslateJob::dispatch();
    return 'done';
});

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::controller(jobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/create', 'create');
    Route::get('/jobs/{job}', 'show');
    Route::post('/jobs', 'store')
        ->middleware('auth');

    Route::get('/jobs/{job}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'job');

    Route::patch('/jobs/{job}', 'update');
    Route::delete('/jobs/{job}', 'destroy');
});
//ou plus classique :
//Route::get('/jobs/create', [jobController::class, 'create']);

//Route::resource('jobs', jobController::class);

Route::get('/register', [authController::class, 'create']);
Route::post('/register', [authController::class, 'store']);

Route::get('/login', [sessionController::class, 'create'])->name('login');
Route::post('/login', [sessionController::class, 'store']);
Route::post('/logout', [sessionController::class, 'destroy']);




