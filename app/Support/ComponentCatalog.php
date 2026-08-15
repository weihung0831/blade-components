<?php

namespace App\Support;

class ComponentCatalog
{
    /**
     * The component catalog grouped by category, in display order.
     *
     * Each component's `slug` must match a preview view in
     * `resources/views/components/previews/{category-slug}/{slug}.blade.php`,
     * where `{category-slug}` is the kebab-cased category name.
     *
     * @return array<string, list<array{slug: string, name: string, variants: int}>>
     */
    public static function categories(): array
    {
        return [
            'Actions' => [
                ['slug' => 'button', 'name' => 'Button', 'variants' => 4],
                ['slug' => 'icon-button', 'name' => 'Icon button', 'variants' => 3],
                ['slug' => 'button-group', 'name' => 'Button group', 'variants' => 2],
                ['slug' => 'split-button', 'name' => 'Split button', 'variants' => 2],
                ['slug' => 'speed-dial', 'name' => 'Speed dial', 'variants' => 2],
                ['slug' => 'link', 'name' => 'Link', 'variants' => 3],
            ],
            'Forms' => [
                ['slug' => 'input', 'name' => 'Input', 'variants' => 5],
                ['slug' => 'textarea', 'name' => 'Textarea', 'variants' => 2],
                ['slug' => 'select', 'name' => 'Select', 'variants' => 3],
                ['slug' => 'autocomplete', 'name' => 'Autocomplete', 'variants' => 2],
                ['slug' => 'cascade-select', 'name' => 'Cascade select', 'variants' => 2],
                ['slug' => 'tree-select', 'name' => 'Tree select', 'variants' => 2],
                ['slug' => 'listbox', 'name' => 'Listbox', 'variants' => 2],
                ['slug' => 'checkbox', 'name' => 'Checkbox', 'variants' => 3],
                ['slug' => 'radio', 'name' => 'Radio', 'variants' => 2],
                ['slug' => 'switch', 'name' => 'Switch', 'variants' => 2],
                ['slug' => 'toggle-button', 'name' => 'Toggle button', 'variants' => 2],
                ['slug' => 'slider', 'name' => 'Slider', 'variants' => 2],
                ['slug' => 'knob', 'name' => 'Knob', 'variants' => 2],
                ['slug' => 'rating', 'name' => 'Rating', 'variants' => 2],
                ['slug' => 'input-number', 'name' => 'Input number', 'variants' => 2],
                ['slug' => 'input-otp', 'name' => 'Input OTP', 'variants' => 2],
                ['slug' => 'input-mask', 'name' => 'Input mask', 'variants' => 2],
                ['slug' => 'input-group', 'name' => 'Input group', 'variants' => 3],
                ['slug' => 'icon-field', 'name' => 'Icon field', 'variants' => 2],
                ['slug' => 'search', 'name' => 'Search', 'variants' => 2],
                ['slug' => 'float-label', 'name' => 'Float label', 'variants' => 2],
                ['slug' => 'password', 'name' => 'Password', 'variants' => 2],
                ['slug' => 'tags-input', 'name' => 'Tags input', 'variants' => 2],
                ['slug' => 'color-picker', 'name' => 'Color picker', 'variants' => 2],
                ['slug' => 'date-picker', 'name' => 'Date picker', 'variants' => 2],
                ['slug' => 'file-upload', 'name' => 'File upload', 'variants' => 2],
                ['slug' => 'inplace', 'name' => 'Inplace', 'variants' => 2],
            ],
            'Data display' => [
                ['slug' => 'card', 'name' => 'Card', 'variants' => 3],
                ['slug' => 'table', 'name' => 'Table', 'variants' => 2],
                ['slug' => 'bulk-select', 'name' => 'Bulk select', 'variants' => 2],
                ['slug' => 'data-view', 'name' => 'Data view', 'variants' => 2],
                ['slug' => 'tree', 'name' => 'Tree', 'variants' => 2],
                ['slug' => 'tree-table', 'name' => 'Tree table', 'variants' => 2],
                ['slug' => 'order-list', 'name' => 'Order list', 'variants' => 2],
                ['slug' => 'pick-list', 'name' => 'Pick list', 'variants' => 2],
                ['slug' => 'org-chart', 'name' => 'Org chart', 'variants' => 2],
                ['slug' => 'timeline', 'name' => 'Timeline', 'variants' => 2],
                ['slug' => 'badge', 'name' => 'Badge', 'variants' => 3],
                ['slug' => 'chip', 'name' => 'Chip', 'variants' => 2],
                ['slug' => 'avatar', 'name' => 'Avatar', 'variants' => 3],
                ['slug' => 'accordion', 'name' => 'Accordion', 'variants' => 2],
                ['slug' => 'separator', 'name' => 'Separator', 'variants' => 2],
                ['slug' => 'kbd', 'name' => 'Kbd', 'variants' => 2],
                ['slug' => 'meter-group', 'name' => 'Meter group', 'variants' => 2],
                ['slug' => 'terminal', 'name' => 'Terminal', 'variants' => 2],
            ],
            'Panels' => [
                ['slug' => 'panel', 'name' => 'Panel', 'variants' => 2],
                ['slug' => 'fieldset', 'name' => 'Fieldset', 'variants' => 2],
                ['slug' => 'toolbar', 'name' => 'Toolbar', 'variants' => 2],
                ['slug' => 'stepper', 'name' => 'Stepper', 'variants' => 2],
                ['slug' => 'splitter', 'name' => 'Splitter', 'variants' => 2],
                ['slug' => 'scroll-area', 'name' => 'Scroll area', 'variants' => 2],
            ],
            'Feedback' => [
                ['slug' => 'alert', 'name' => 'Alert', 'variants' => 4],
                ['slug' => 'toast', 'name' => 'Toast', 'variants' => 4],
                ['slug' => 'progress', 'name' => 'Progress', 'variants' => 2],
                ['slug' => 'skeleton', 'name' => 'Skeleton', 'variants' => 3],
                ['slug' => 'spinner', 'name' => 'Spinner', 'variants' => 3],
            ],
            'Overlay' => [
                ['slug' => 'modal', 'name' => 'Modal', 'variants' => 2],
                ['slug' => 'drawer', 'name' => 'Drawer', 'variants' => 2],
                ['slug' => 'dropdown', 'name' => 'Dropdown', 'variants' => 2],
                ['slug' => 'popover', 'name' => 'Popover', 'variants' => 2],
                ['slug' => 'confirm-popup', 'name' => 'Confirm popup', 'variants' => 2],
                ['slug' => 'tooltip', 'name' => 'Tooltip', 'variants' => 2],
                ['slug' => 'block-ui', 'name' => 'Block UI', 'variants' => 2],
            ],
            'Navigation' => [
                ['slug' => 'tabs', 'name' => 'Tabs', 'variants' => 2],
                ['slug' => 'breadcrumb', 'name' => 'Breadcrumb', 'variants' => 2],
                ['slug' => 'pagination', 'name' => 'Pagination', 'variants' => 2],
                ['slug' => 'menubar', 'name' => 'Menubar', 'variants' => 2],
                ['slug' => 'mega-menu', 'name' => 'Mega menu', 'variants' => 2],
                ['slug' => 'tiered-menu', 'name' => 'Tiered menu', 'variants' => 2],
                ['slug' => 'context-menu', 'name' => 'Context menu', 'variants' => 2],
                ['slug' => 'command-menu', 'name' => 'Command menu', 'variants' => 2],
                ['slug' => 'sidebar', 'name' => 'Sidebar', 'variants' => 2],
                ['slug' => 'dock', 'name' => 'Dock', 'variants' => 2],
                ['slug' => 'scroll-top', 'name' => 'Scroll top', 'variants' => 2],
            ],
            'Media' => [
                ['slug' => 'carousel', 'name' => 'Carousel', 'variants' => 2],
                ['slug' => 'gallery', 'name' => 'Gallery', 'variants' => 2],
                ['slug' => 'image-compare', 'name' => 'Image compare', 'variants' => 2],
            ],
            'Effects' => [
                ['slug' => 'animated-background', 'name' => 'Animated background', 'variants' => 2],
                ['slug' => 'page-loader', 'name' => 'Page loader', 'variants' => 2],
                ['slug' => 'typewriter', 'name' => 'Typewriter', 'variants' => 2],
                ['slug' => 'text-shimmer', 'name' => 'Text shimmer', 'variants' => 2],
                ['slug' => 'number-ticker', 'name' => 'Number ticker', 'variants' => 2],
                ['slug' => 'marquee', 'name' => 'Marquee', 'variants' => 2],
                ['slug' => 'animated-border', 'name' => 'Animated border', 'variants' => 2],
                ['slug' => 'orbit', 'name' => 'Orbit', 'variants' => 2],
                ['slug' => 'animated-column-chart', 'name' => 'Animated column chart', 'variants' => 2],
                ['slug' => 'animated-bar-chart', 'name' => 'Animated bar chart', 'variants' => 2],
                ['slug' => 'word-rotate', 'name' => 'Word rotate', 'variants' => 2],
                ['slug' => 'flip-card', 'name' => 'Flip card', 'variants' => 2],
                ['slug' => 'meteors', 'name' => 'Meteors', 'variants' => 2],
                ['slug' => 'spotlight', 'name' => 'Spotlight', 'variants' => 2],
            ],
        ];
    }

    public static function count(): int
    {
        return array_sum(array_map('count', self::categories()));
    }

    /**
     * Find a catalog entry and its category by slug.
     *
     * @return array{category: string, item: array{slug: string, name: string, variants: int}}|null
     */
    public static function find(string $slug): ?array
    {
        foreach (self::categories() as $category => $items) {
            foreach ($items as $item) {
                if ($item['slug'] === $slug) {
                    return ['category' => $category, 'item' => $item];
                }
            }
        }

        return null;
    }
}
