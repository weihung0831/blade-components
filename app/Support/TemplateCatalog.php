<?php

namespace App\Support;

class TemplateCatalog
{
    /**
     * Page templates assembled from catalog components, in display order.
     *
     * Each template's `slug` must match a thumbnail view in
     * `resources/views/components/templates/{slug}.blade.php`.
     *
     * @return list<array{slug: string, name: string, description: string, pages: int, status: 'free'|'soon'}>
     */
    public static function all(): array
    {
        return [
            ['slug' => 'dashboard', 'name' => 'Dashboard', 'description' => 'Admin shell with sidebar, stat tiles, and a data table.', 'pages' => 5, 'status' => 'free'],
            ['slug' => 'auth', 'name' => 'Auth pages', 'description' => 'Login, register, and password reset with float labels.', 'pages' => 3, 'status' => 'free'],
            ['slug' => 'settings', 'name' => 'Settings', 'description' => 'Account, billing, and team panels with section nav.', 'pages' => 4, 'status' => 'free'],
            ['slug' => 'pricing', 'name' => 'Pricing', 'description' => 'Three-tier pricing with a highlighted plan.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'analytics', 'name' => 'Analytics', 'description' => 'KPI row, trend chart, and breakdown panels.', 'pages' => 2, 'status' => 'free'],
            ['slug' => 'product', 'name' => 'Product page', 'description' => 'Gallery, price block, and add-to-cart actions.', 'pages' => 2, 'status' => 'free'],
            ['slug' => 'checkout', 'name' => 'Checkout', 'description' => 'Address and payment form beside an order summary.', 'pages' => 2, 'status' => 'free'],
            ['slug' => 'blog', 'name' => 'Blog', 'description' => 'Article index and a readable post layout.', 'pages' => 2, 'status' => 'free'],
            ['slug' => 'kanban', 'name' => 'Kanban board', 'description' => 'Three-column board with draggable-looking cards.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'inbox', 'name' => 'Inbox', 'description' => 'Message list beside a conversation thread.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'faq', 'name' => 'FAQ', 'description' => 'Accordion Q&A powered by details and summary.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'contact', 'name' => 'Contact', 'description' => 'Contact form beside support details.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'terms', 'name' => 'Terms', 'description' => 'Terms of service with numbered prose sections.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'privacy', 'name' => 'Privacy', 'description' => 'Privacy policy with a cookie consent bar.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'refund', 'name' => 'Refund policy', 'description' => 'Refund terms with a request status card.', 'pages' => 1, 'status' => 'free'],
            ['slug' => 'onboarding', 'name' => 'Onboarding', 'description' => 'Multi-step wizard with a progress stepper.', 'pages' => 3, 'status' => 'soon'],
            ['slug' => 'changelog', 'name' => 'Changelog', 'description' => 'Versioned release notes on a timeline.', 'pages' => 1, 'status' => 'soon'],
            ['slug' => 'error-pages', 'name' => 'Error pages', 'description' => '404, 500, and maintenance screens.', 'pages' => 3, 'status' => 'soon'],
            ['slug' => 'landing', 'name' => 'Landing', 'description' => 'Marketing hero, feature grid, and call to action.', 'pages' => 1, 'status' => 'soon'],
            ['slug' => 'invoice', 'name' => 'Invoice', 'description' => 'Printable invoice with line items and totals.', 'pages' => 1, 'status' => 'soon'],
        ];
    }

    public static function count(): int
    {
        return count(self::all());
    }
}
