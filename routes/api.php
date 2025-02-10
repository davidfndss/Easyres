<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/resume/all', [ResumeController::class, 'index']);

Route::get('/resume/{id}', [ResumeController::class, 'show']);

Route::post('/resume/create', [ResumeController::class, 'store']);

Route::patch('/resume/{id}/update', [ResumeController::class, 'update']);

Route::delete('/resume/{id}/delete', [ResumeController::class, 'destroy']);