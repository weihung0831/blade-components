<?php

namespace App\Support;

class ComponentCatalog
{
    /**
     * The component catalog grouped by category, in display order.
     *
     * Each component's `slug` must match a preview view in
     * `resources/views/components/previews/{slug}.blade.php`.
     *
     * @return array<string, list<array{slug: string, name: string, variants: int}>>
     */
    public static function categories(): array
    {
        return [
            'Actions' => [
                ['slug' => 'button', 'name' => 'Button', 'variants' => 4],
            ],
            'Forms' => [
                ['slug' => 'input', 'name' => 'Input', 'variants' => 5],
                ['slug' => 'switch', 'name' => 'Switch', 'variants' => 2],
            ],
            'Data display' => [
                ['slug' => 'badge', 'name' => 'Badge', 'variants' => 3],
                ['slug' => 'avatar', 'name' => 'Avatar', 'variants' => 3],
            ],
            'Feedback' => [
                ['slug' => 'toast', 'name' => 'Toast', 'variants' => 4],
                ['slug' => 'progress', 'name' => 'Progress', 'variants' => 2],
            ],
            'Navigation' => [
                ['slug' => 'tabs', 'name' => 'Tabs', 'variants' => 2],
            ],
        ];
    }

    public static function count(): int
    {
        return array_sum(array_map('count', self::categories()));
    }
}
