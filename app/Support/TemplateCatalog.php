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
     * @return list<array{slug: string, name: string, description: string, pages: int}>
     */
    public static function all(): array
    {
        return [
            ['slug' => 'dashboard', 'name' => 'Dashboard', 'description' => 'Admin shell with sidebar, stat tiles, and a data table.', 'pages' => 5],
            ['slug' => 'auth', 'name' => 'Auth pages', 'description' => 'Sign in, sign up, reset, two-factor, and seat invites.', 'pages' => 5],
            ['slug' => 'settings', 'name' => 'Settings', 'description' => 'Account, billing, and team panels with section nav.', 'pages' => 4],
            ['slug' => 'pricing', 'name' => 'Pricing', 'description' => 'Three-tier pricing with a highlighted plan.', 'pages' => 1],
            ['slug' => 'analytics', 'name' => 'Analytics', 'description' => 'KPI row, trend chart, and breakdown panels.', 'pages' => 2],
            ['slug' => 'product', 'name' => 'Product page', 'description' => 'Gallery, price block, and add-to-cart actions.', 'pages' => 2],
            ['slug' => 'checkout', 'name' => 'Checkout', 'description' => 'Address and payment form beside an order summary.', 'pages' => 2],
            ['slug' => 'blog', 'name' => 'Blog', 'description' => 'Article index and a readable post layout.', 'pages' => 2],
            ['slug' => 'kanban', 'name' => 'Kanban board', 'description' => 'Three-column board with draggable-looking cards.', 'pages' => 1],
            ['slug' => 'inbox', 'name' => 'Inbox', 'description' => 'Message list beside a conversation thread.', 'pages' => 1],
            ['slug' => 'faq', 'name' => 'FAQ', 'description' => 'Accordion Q&A powered by details and summary.', 'pages' => 1],
            ['slug' => 'contact', 'name' => 'Contact', 'description' => 'Contact form beside support details.', 'pages' => 1],
            ['slug' => 'terms', 'name' => 'Terms', 'description' => 'Terms of service with numbered prose sections.', 'pages' => 1],
            ['slug' => 'privacy', 'name' => 'Privacy', 'description' => 'Privacy policy with a cookie consent bar.', 'pages' => 1],
            ['slug' => 'refund', 'name' => 'Refund policy', 'description' => 'Refund terms with a request status card.', 'pages' => 1],
            ['slug' => 'onboarding', 'name' => 'Onboarding', 'description' => 'Multi-step wizard with a progress stepper.', 'pages' => 3],
            ['slug' => 'changelog', 'name' => 'Changelog', 'description' => 'Versioned release notes on a timeline.', 'pages' => 1],
            ['slug' => 'error-pages', 'name' => 'Error pages', 'description' => '404, 500, and maintenance screens.', 'pages' => 3],
            ['slug' => 'landing', 'name' => 'Landing', 'description' => 'Marketing hero, feature grid, and call to action.', 'pages' => 1],
            ['slug' => 'invoice', 'name' => 'Invoice', 'description' => 'Printable invoice with line items and totals.', 'pages' => 1],
        ];
    }

    public static function count(): int
    {
        return count(self::all());
    }

    /**
     * The screens a template ships, in display order.
     *
     * Each screen's `slug` must match a view in
     * `resources/views/components/templates/{template}/{slug}.blade.php`.
     *
     * @return list<array{slug: string, name: string, description: string}>
     */
    public static function screens(string $template): array
    {
        return match ($template) {
            'dashboard' => [
                ['slug' => 'overview', 'name' => 'Overview', 'description' => 'Subscription health at a glance: MRR, churn, plan mix, and the quota bar every SaaS console needs.'],
                ['slug' => 'analytics', 'name' => 'Analytics', 'description' => 'Traffic and conversion for the storefronts merchants run on the platform.'],
                ['slug' => 'merchants', 'name' => 'Merchants', 'description' => 'The tenant list — filters, a sortable table, bulk actions, and pagination.'],
                ['slug' => 'deploys', 'name' => 'Deploys', 'description' => 'Infrastructure console: service health, p95 latency, and the deploy log.'],
                ['slug' => 'orders', 'name' => 'Orders', 'description' => 'Commerce operations: gross volume, order queue, refunds, and payouts.'],
            ],
            'auth' => [
                ['slug' => 'sign-in', 'name' => 'Sign in', 'description' => 'Workspace context, SSO buttons, float-label credentials, and the way out to every other screen.'],
                ['slug' => 'sign-up', 'name' => 'Sign up', 'description' => 'Trial signup with a tenant subdomain, a strength meter, and the data region spelled out.'],
                ['slug' => 'reset', 'name' => 'Reset', 'description' => 'One-time link request, resend timer, and what happens when the workspace is on SSO.'],
                ['slug' => 'two-factor', 'name' => 'Two-factor', 'description' => 'Six-digit challenge on a new device, with device trust and recovery codes.'],
                ['slug' => 'invite', 'name' => 'Invite', 'description' => 'Seat invite: role scope, what the seat costs, accept or decline.'],
            ],
            default => [],
        };
    }

    /**
     * Find a template entry by slug.
     *
     * @return array{slug: string, name: string, description: string, pages: int}|null
     */
    public static function find(string $slug): ?array
    {
        foreach (self::all() as $template) {
            if ($template['slug'] === $slug) {
                return $template;
            }
        }

        return null;
    }
}
