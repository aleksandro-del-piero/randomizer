<?php

use App\Http\Controllers\PageController;
use App\Http\Middleware\PageActiveMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return redirect('/');
})->name('login');

Route::get('/', function () {
    return view('main');
})->name('main');

Route::middleware(['auth', PageActiveMiddleware::class])
    ->get('pages/{hash}', PageController::class)
    ->name('page');
