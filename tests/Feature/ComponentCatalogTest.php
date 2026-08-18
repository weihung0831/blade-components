<?php

use App\Support\ComponentCatalog;
use App\Support\TemplateCatalog;
use Illuminate\Support\Str;

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

it('links every template to a detail page, with none left coming soon', function () {
    $response = $this->get('/templates')->assertSuccessful();

    foreach (TemplateCatalog::all() as $template) {
        $response->assertSee(route('templates.show', $template['slug']));
    }

    expect(substr_count($response->getContent(), '>Soon</span>'))->toBe(0);
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
    $directory = 'resources/js/components/ui/'.Str::slug(ComponentCatalog::find($slug)['category']);

    $this->get("/components/{$slug}")
        ->assertSuccessful()
        ->assertSee('data-code-tab', false)
        ->assertSee("{$directory}/{$componentName}.vue")
        ->assertSee("{$directory}/{$componentName}.jsx")
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

it('links every catalog entry to a detail page, with none left coming soon', function () {
    $response = $this->get('/components')->assertSuccessful();

    foreach (ComponentCatalog::categories() as $items) {
        foreach ($items as $item) {
            $response->assertSee(route('components.show', $item['slug']));
        }
    }

    expect(substr_count($response->getContent(), '>Soon</span>'))->toBe(0);
});

it('renders a detail page for every catalog entry', function () {
    foreach (ComponentCatalog::categories() as $category => $items) {
        foreach ($items as $item) {
            $this->get(route('components.show', $item['slug']))
                ->assertSuccessful()
                ->assertSee($category)
                ->assertSee($item['name'])
                ->assertSee('x-ui.'.$item['slug'])
                ->assertSee('Installation');
        }
    }
});

it('returns 404 for unknown components', function (string $slug) {
    $this->get("/components/{$slug}")->assertNotFound();
})->with([
    'not in catalog' => 'chart',
    'not a component' => 'dashboard',
]);
