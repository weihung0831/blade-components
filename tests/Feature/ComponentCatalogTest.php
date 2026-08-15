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

it('renders the button detail page', function () {
    $this->get('/components/button')
        ->assertSuccessful()
        ->assertSee('Button')
        ->assertSee('Variants')
        ->assertSee('x-ui.button');
});

it('renders code snippets without leaking blade compilation artifacts', function () {
    $this->get('/components/button')->assertDontSee('endComponentClass');
});

it('links the button card to its detail page', function () {
    $this->get('/components')->assertSee(route('components.show', 'button'));
});

it('returns 404 for unknown components', function (string $slug) {
    $this->get("/components/{$slug}")->assertNotFound();
})->with([
    'not in catalog' => 'chart',
    'in catalog without detail page' => 'badge',
]);
