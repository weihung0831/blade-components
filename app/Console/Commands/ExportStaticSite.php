<?php

namespace App\Console\Commands;

use App\Support\ComponentCatalog;
use App\Support\TemplateCatalog;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ExportStaticSite extends Command
{
    protected $signature = 'site:export {host} {--dist=dist}';

    protected $description = 'Render every page to static HTML for deployment';

    public function handle(Kernel $kernel): int
    {
        $host = rtrim($this->argument('host'), '/');
        $dist = base_path($this->option('dist'));
        $hot = public_path('hot');
        $hotMoved = false;

        config([
            'app.url' => $host,
            'session.driver' => 'array',
            'cache.default' => 'array',
        ]);

        if (File::exists($hot)) {
            File::move($hot, $hot.'.export-bak');
            $hotMoved = true;
        }

        try {
            File::deleteDirectory($dist);
            File::makeDirectory($dist, 0755, true);

            $failures = [];

            foreach ($this->paths() as $path) {
                $response = $kernel->handle(Request::create($host.$path, 'GET'));

                if ($response->getStatusCode() !== 200) {
                    $failures[] = $path.' => '.$response->getStatusCode();

                    continue;
                }

                File::ensureDirectoryExists($dist.($path === '/' ? '' : $path));
                File::put($dist.($path === '/' ? '/index.html' : $path.'/index.html'), $response->getContent());
            }

            File::put($dist.'/404.html', $kernel->handle(Request::create($host.'/404', 'GET'))->getContent());

            $this->copyPublicAssets($dist);

            if ($failures !== []) {
                $this->error('Failed pages: '.implode(', ', $failures));

                return self::FAILURE;
            }

            $this->info(count($this->paths()).' pages exported to '.$dist);

            return self::SUCCESS;
        } finally {
            if ($hotMoved) {
                File::move($hot.'.export-bak', $hot);
            }
        }
    }

    /**
     * @return list<string>
     */
    private function paths(): array
    {
        $paths = ['/', '/components', '/templates'];

        foreach (ComponentCatalog::categories() as $category => $items) {
            foreach ($items as $item) {
                if (View::exists('catalog.'.Str::slug($category).'.'.$item['slug'])) {
                    $paths[] = '/components/'.$item['slug'];
                }
            }
        }

        foreach (TemplateCatalog::all() as $template) {
            if (! View::exists('templates.pages.'.$template['slug'])) {
                continue;
            }

            $paths[] = '/templates/'.$template['slug'];

            foreach (TemplateCatalog::screens($template['slug']) as $screen) {
                $paths[] = '/templates/'.$template['slug'].'/screens/'.$screen['slug'];
                $paths[] = '/templates/'.$template['slug'].'/screens/'.$screen['slug'].'/frame';
            }
        }

        return $paths;
    }

    private function copyPublicAssets(string $dist): void
    {
        File::copyDirectory(public_path('build'), $dist.'/build');

        foreach (['favicon.ico', 'favicon.svg', 'apple-touch-icon.png', 'robots.txt'] as $asset) {
            if (File::exists(public_path($asset))) {
                File::copy(public_path($asset), $dist.'/'.$asset);
            }
        }
    }
}
