<?php

use App\Support\TemplateCatalog;

it('links the dashboard card to its detail page', function () {
    $this->get('/templates')->assertSee(route('templates.show', 'dashboard'));
});

it('renders the dashboard template page with every screen', function () {
    $response = $this->get(route('templates.show', 'dashboard'))->assertSuccessful();

    foreach (TemplateCatalog::screens('dashboard') as $screen) {
        $response->assertSee($screen['name'])
            ->assertSee(route('templates.screen', ['dashboard', $screen['slug']]));
    }
});

it('breaks the dashboard down into blocks with their own snippets', function (string $title) {
    $this->get(route('templates.show', 'dashboard'))
        ->assertSuccessful()
        ->assertSee('data-code-tab', false)
        ->assertSee($title);
})->with(['Sidebar', 'Topbar', 'Stat row', 'Chart card', 'Quota list', 'Filter bar', 'Tenant table', 'Uptime strip']);

it('keeps the template snippets folded away behind a toggle', function () {
    $this->get(route('templates.show', 'dashboard'))
        ->assertSuccessful()
        ->assertSee('Show code');
});

it('folds component snippets away too', function () {
    $this->get('/components/button')
        ->assertSuccessful()
        ->assertSee('Show code')
        ->assertSee('Hide code');
});

it('ships an installation section with every file in all three languages', function () {
    $response = $this->get(route('templates.show', 'dashboard'))
        ->assertSuccessful()
        ->assertSee('Installation');

    foreach (['shell', 'stat', ...array_column(TemplateCatalog::screens('dashboard'), 'slug')] as $file) {
        $studly = Str::studly($file);

        $response->assertSee("resources/views/components/templates/dashboard/{$file}.blade.php")
            ->assertSee("resources/js/templates/dashboard/{$studly}.vue")
            ->assertSee("resources/js/templates/dashboard/{$studly}.jsx");
    }
});

it('renders every dashboard screen on its own', function () {
    foreach (TemplateCatalog::screens('dashboard') as $screen) {
        $this->get(route('templates.screen', ['dashboard', $screen['slug']]))
            ->assertSuccessful()
            ->assertSee($screen['name'])
            ->assertSee('wharf');
    }
});

it('returns 404 for templates and screens that do not exist', function (string $path) {
    $this->get($path)->assertNotFound();
})->with([
    'template without a page' => '/templates/kanban',
    'unknown template' => '/templates/nonsense',
    'unknown screen' => '/templates/dashboard/screens/nonsense',
]);
