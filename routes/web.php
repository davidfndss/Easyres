<?php

use App\Http\Controllers\ResumeViewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('home');
});
Route::get('/resume/all', [ResumeViewController::class, 'index']);
Route::get('/resume/create', [ResumeViewController::class, 'create']);
Route::get('/resume/{id}/edit', [ResumeViewController::class, 'edit']);
Route::get('/resume/{id}/delete', [ResumeViewController::class, 'destroy']);
