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

Route::get('/templates/{slug}', function (string $slug) {
    $template = TemplateCatalog::find($slug);

    abort_unless($template !== null && View::exists('templates.pages.'.$slug), 404);

    return view('templates.pages.'.$slug, ['template' => $template]);
})->name('templates.show');

Route::get('/templates/{slug}/screens/{screen}', function (string $slug, string $screen) {
    $template = TemplateCatalog::find($slug);
    $component = 'templates.'.$slug.'.'.$screen;

    abort_unless($template !== null && View::exists('components.'.$component), 404);

    return view(request()->boolean('frame') ? 'templates.frame' : 'templates.screen', [
        'template' => $template,
        'component' => $component,
        'screen' => $screen,
    ]);
})->name('templates.screen');

Route::get('/components/{slug}', function (string $slug) {
    $entry = ComponentCatalog::find($slug);
    $view = $entry === null ? null : 'catalog.'.Str::slug($entry['category']).'.'.$slug;

    abort_unless($view !== null && View::exists($view), 404);

    return view($view, $entry);
})->name('components.show');
