<?php

use App\Support\TemplateCatalog;
use Illuminate\Support\Facades\View;

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
        $url = route('templates.screen', ['dashboard', $screen['slug']]);

        $this->get($url)->assertSuccessful()->assertSee($screen['name']);
        $this->get($url.'?frame=1')->assertSuccessful()->assertSee('wharf');
    }
});

it('wires the dashboard sidebar to its sibling screens', function () {
    $response = $this->get(route('templates.screen', ['dashboard', 'overview']).'?frame=1')->assertSuccessful();

    foreach (TemplateCatalog::screens('dashboard') as $screen) {
        $response->assertSee(route('templates.screen', ['dashboard', $screen['slug']]));
    }

    $response->assertSee('target="_top"', false);
});

it('frames each screen in a device switcher', function () {
    $response = $this->get(route('templates.screen', ['dashboard', 'overview']))->assertSuccessful();

    foreach (['mobile', 'tablet', 'desktop'] as $device) {
        $response->assertSee('id="device-'.$device.'"', false);
    }

    $response->assertSee('<iframe', false)
        ->assertSee(route('templates.screen', ['dashboard', 'overview']).'?frame=1');
});

it('returns 404 for templates and screens that do not exist', function (string $path) {
    $this->get($path)->assertNotFound();
})->with([
    'template without a page' => '/templates/inbox',
    'unknown template' => '/templates/nonsense',
    'unknown screen' => '/templates/dashboard/screens/nonsense',
]);

it('renders every template that ships a page, screen by screen', function () {
    foreach (TemplateCatalog::all() as $template) {
        if (! View::exists('templates.pages.'.$template['slug'])) {
            continue;
        }

        $page = $this->get(route('templates.show', $template['slug']))->assertSuccessful();

        foreach (TemplateCatalog::screens($template['slug']) as $screen) {
            $url = route('templates.screen', [$template['slug'], $screen['slug']]);

            $page->assertSee($screen['name'])->assertSee($url);

            $this->get($url.'?frame=1')->assertSuccessful();
        }
    }
});

it('renders the auth template page with every screen', function () {
    $response = $this->get(route('templates.show', 'auth'))->assertSuccessful();

    foreach (TemplateCatalog::screens('auth') as $screen) {
        $response->assertSee($screen['name'])
            ->assertSee(route('templates.screen', ['auth', $screen['slug']]));
    }
});

it('breaks the auth pages down into blocks with their own snippets', function (string $title) {
    $this->get(route('templates.show', 'auth'))
        ->assertSuccessful()
        ->assertSee('data-code-tab', false)
        ->assertSee($title);
})->with(['Provider row', 'Credential fields', 'Workspace context', 'Tenant subdomain', 'Password with meter', 'One-time code', 'Seat invite card', 'Session log']);

it('ships the auth installation section in all three languages', function () {
    $response = $this->get(route('templates.show', 'auth'))->assertSuccessful();

    foreach (['shell', 'providers', ...array_column(TemplateCatalog::screens('auth'), 'slug')] as $file) {
        $studly = Str::studly($file);

        $response->assertSee("resources/views/components/templates/auth/{$file}.blade.php")
            ->assertSee("resources/js/templates/auth/{$studly}.vue")
            ->assertSee("resources/js/templates/auth/{$studly}.jsx");
    }
});

it('renders every auth screen on its own', function () {
    foreach (TemplateCatalog::screens('auth') as $screen) {
        $url = route('templates.screen', ['auth', $screen['slug']]);

        $this->get($url)->assertSuccessful()->assertSee($screen['name']);
        $this->get($url.'?frame=1')->assertSuccessful()->assertSee('wharf');
    }
});

it('walks the auth flow from one screen to the next', function () {
    $this->get(route('templates.screen', ['auth', 'sign-in']).'?frame=1')
        ->assertSuccessful()
        ->assertSee(route('templates.screen', ['auth', 'sign-up']))
        ->assertSee(route('templates.screen', ['auth', 'reset']))
        ->assertSee(route('templates.screen', ['auth', 'two-factor']))
        ->assertSee('target="_top"', false);
});
