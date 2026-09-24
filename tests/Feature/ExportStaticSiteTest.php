<?php

use Illuminate\Support\Facades\File;

it('exports every page as static html with the given host baked in', function () {
    $dist = 'storage/framework/testing/dist';

    $this->artisan('site:export', ['host' => 'https://example.test', '--dist' => $dist])
        ->assertSuccessful();

    expect(base_path($dist.'/index.html'))->toBeFile()
        ->and(base_path($dist.'/components/button/index.html'))->toBeFile()
        ->and(base_path($dist.'/templates/dashboard/screens/overview/frame/index.html'))->toBeFile()
        ->and(base_path($dist.'/404.html'))->toBeFile()
        ->and(base_path($dist.'/build/manifest.json'))->toBeFile()
        ->and(base_path($dist.'/img/media/placeholder-01.svg'))->toBeFile()
        ->and(File::get(base_path($dist.'/index.html')))->toContain('https://example.test/components');

    File::deleteDirectory(base_path($dist));
});
