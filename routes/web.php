<?php

use App\Support\ComponentCatalog;
use App\Support\TemplateCatalog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

Route::view('/', 'home')->name('home');

Route::get('/components', function () {
    return view('components', [
        'categories' => ComponentCatalog::categories(),
        'total' => ComponentCatalog::count(),
    ]);
})->name('components');

Route::get('/templates', function () {
    return view('templates', [
        'templates' => TemplateCatalog::all(),
        'total' => TemplateCatalog::count(),
    ]);
})->name('templates');

Route::get('/components/{slug}', function (string $slug) {
    $entry = ComponentCatalog::find($slug);
    $view = $entry === null ? null : 'catalog.'.Str::slug($entry['category']).'.'.$slug;

    abort_unless($view !== null && View::exists($view), 404);

    return view($view, $entry);
})->name('components.show');
