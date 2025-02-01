<?php

use App\Http\Controllers\jobController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs/{job}/edit', [jobController::class, 'edit']);
Route::patch('/jobs/{job}', [jobController::class, 'update']);
Route::delete('/jobs/{job}', [jobController::class, 'destroy']);


