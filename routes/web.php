<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\jobController;
use App\Http\Controllers\sessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

//Route::controller(jobController::class)->group(function () {
//    Route::get('/jobs', 'index');
//    Route::get('/jobs/{job}', 'show');
//    Route::get('/jobs/create', 'create');
//    Route::post('/jobs', 'store');
//    Route::get('/jobs/{job}/edit', 'edit');
//    Route::patch('/jobs/{job}', 'update');
//    Route::delete('/jobs/{job}', 'destroy');
//});
//ou plus classique :
//Route::get('/jobs/create', [jobController::class, 'create']);

Route::resource('jobs', jobController::class);

Route::get('/register', [authController::class, 'create']);
Route::post('/register', [authController::class, 'store']);

Route::get('/login', [sessionController::class, 'create']);
Route::post('/login', [sessionController::class, 'store']);




