<?php

use App\Support\ComponentCatalog;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/components', function () {
    return view('components', [
        'categories' => ComponentCatalog::categories(),
        'total' => ComponentCatalog::count(),
    ]);
})->name('components');
