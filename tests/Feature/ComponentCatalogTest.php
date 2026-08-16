<?php

use App\Support\ComponentCatalog;
use App\Support\TemplateCatalog;

it('renders the components index with every catalog entry', function () {
    $response = $this->get('/components')->assertSuccessful();

    foreach (ComponentCatalog::categories() as $category => $items) {
        $response->assertSee($category);

        foreach ($items as $item) {
            $response->assertSee($item['name']);
        }
    }
});

it('renders the templates index with every template', function () {
    $response = $this->get('/templates')->assertSuccessful();

    foreach (TemplateCatalog::all() as $template) {
        $response->assertSee($template['name']);
    }
});

it('marks templates without a detail page as coming soon', function () {
    $response = $this->get('/templates')->assertSuccessful();

    $soonCount = collect(TemplateCatalog::all())
        ->reject(fn (array $template): bool => View::exists('templates.pages.'.$template['slug']))
        ->count();

    expect($soonCount)->toBeGreaterThan(0)
        ->and(substr_count($response->getContent(), '>Soon</span>'))->toBe($soonCount);
});

it('renders component detail pages', function (string $slug, string $name) {
    $this->get("/components/{$slug}")
        ->assertSuccessful()
        ->assertSee($name)
        ->assertSee('Variants')
        ->assertSee('x-ui.'.$slug);
})->with([
    'button' => ['button', 'Button'],
    'icon button' => ['icon-button', 'Icon button'],
    'button group' => ['button-group', 'Button group'],
    'split button' => ['split-button', 'Split button'],
    'speed dial' => ['speed-dial', 'Speed dial'],
    'link' => ['link', 'Link'],
]);

it('shows an installation section with the component source and theme tokens', function (string $slug) {
    $this->get("/components/{$slug}")
        ->assertSuccessful()
        ->assertSee('Installation')
        ->assertSee("resources/views/components/ui/{$slug}.blade.php")
        ->assertSee('resources/css/app.css')
        ->assertSee('--color-jade-500')
        ->assertSee('--ease-snap');
})->with(['button', 'icon-button', 'button-group', 'split-button', 'speed-dial', 'link']);

it('offers vue and react versions behind code tabs', function (string $slug, string $componentName) {
    $this->get("/components/{$slug}")
        ->assertSuccessful()
        ->assertSee('data-code-tab', false)
        ->assertSee("resources/js/components/ui/{$componentName}.vue")
        ->assertSee("resources/js/components/ui/{$componentName}.jsx")
        ->assertSee("export function Ui{$componentName}");
})->with([
    'button' => ['button', 'Button'],
    'icon button' => ['icon-button', 'IconButton'],
    'button group' => ['button-group', 'ButtonGroup'],
    'split button' => ['split-button', 'SplitButton'],
    'speed dial' => ['speed-dial', 'SpeedDial'],
    'link' => ['link', 'Link'],
]);

it('renders code snippets without leaking blade compilation artifacts', function () {
    $this->get('/components/button')->assertDontSee('endComponentClass');
});

it('links the button card to its detail page', function () {
    $this->get('/components')->assertSee(route('components.show', 'button'));
});

it('marks entries without a detail page as coming soon and does not link them', function () {
    $this->get('/components')
        ->assertSee('Soon')
        ->assertDontSee(route('components.show', 'panel'));
});

it('returns 404 for unknown components', function (string $slug) {
    $this->get("/components/{$slug}")->assertNotFound();
})->with([
    'not in catalog' => 'chart',
    'in catalog without detail page' => 'panel',
]);
