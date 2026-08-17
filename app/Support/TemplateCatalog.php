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
            ['slug' => 'pricing', 'name' => 'Pricing', 'description' => 'Plan tiers, a feature matrix, a usage estimator, and a quote request.', 'pages' => 4],
            ['slug' => 'analytics', 'name' => 'Analytics', 'description' => 'Event explorer, funnel, retention grid, and a live stream.', 'pages' => 4],
            ['slug' => 'product', 'name' => 'Product page', 'description' => 'A storefront listing: gallery, spec sheet, reviews, and a build-your-own configurator.', 'pages' => 4],
            ['slug' => 'checkout', 'name' => 'Checkout', 'description' => 'A cart, an address, a card, and the receipt — with the total answering to all three.', 'pages' => 4],
            ['slug' => 'blog', 'name' => 'Blog', 'description' => 'A filtered index, a long read that keeps its place, a searchable archive, and the bench it all comes from.', 'pages' => 4],
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
            'settings' => [
                ['slug' => 'profile', 'name' => 'Profile', 'description' => 'The account itself — identity, password, second factor, and every session it has open.'],
                ['slug' => 'team', 'name' => 'Team', 'description' => 'Seats against the plan limit, the member list, pending invites, and what each role can reach.'],
                ['slug' => 'billing', 'name' => 'Billing', 'description' => 'Plan, metered usage with overage rates, payment method, and the invoice history.'],
                ['slug' => 'api-keys', 'name' => 'API keys', 'description' => 'Server keys shown once, webhook endpoints with delivery health, and the limits they run under.'],
            ],
            'pricing' => [
                ['slug' => 'plans', 'name' => 'Plans', 'description' => 'Three tiers priced the way a platform actually bills — a fee, a seat rate, and metered limits with the overage spelled out.'],
                ['slug' => 'compare', 'name' => 'Compare', 'description' => 'The whole matrix: quotas, seats, regions, and terms, grouped so a buyer can find the one row they came for.'],
                ['slug' => 'calculator', 'name' => 'Calculator', 'description' => 'Four sliders, three plans costed side by side, and the invoice that comes out the other end.'],
                ['slug' => 'enterprise', 'name' => 'Enterprise', 'description' => 'The quote request, plus what procurement and security ask for before the contract moves.'],
            ],
            'analytics' => [
                ['slug' => 'explore', 'name' => 'Explore', 'description' => 'One query — an event, two filters, a breakdown — answered by a chart, a table, and the SQL it compiles to.'],
                ['slug' => 'funnels', 'name' => 'Funnels', 'description' => 'Five steps from storefront to paid order, with how long each hop takes and where the orders go instead.'],
                ['slug' => 'retention', 'name' => 'Retention', 'description' => 'A cohort grid that regroups with the range: daily over a week, weekly over a month, monthly over a quarter.'],
                ['slug' => 'live', 'name' => 'Live', 'description' => 'The last sixty seconds — a tailing event log, per-minute volume, and whether now is unusual for this hour.'],
            ],
            'product' => [
                ['slug' => 'overview', 'name' => 'Overview', 'description' => 'One grinder, three finishes, and four image slots waiting for photography — with the price, the stock line, and the buy button all answering to the same switch.'],
                ['slug' => 'specs', 'name' => 'Specs', 'description' => 'Five grouped tables, a dimension drawing, where to start on the dial for seven brews, and what the machine asks of you.'],
                ['slug' => 'reviews', 'name' => 'Reviews', 'description' => '312 reviews with a distribution you can filter by, trait scores, and a three-star one the shop answered in public.'],
                ['slug' => 'configure', 'name' => 'Configure', 'description' => 'Ten add-ons, a running total, and a build code that spells itself out as you tick boxes.'],
            ],
            'checkout' => [
                ['slug' => 'cart', 'name' => 'Cart', 'description' => 'Three items whose quantities move the total, a code already applied, and the two things people add at the last minute.'],
                ['slug' => 'delivery', 'name' => 'Delivery', 'description' => 'Four ways to get it there. Each one changes the freight, the date, and what the payment screen is allowed to offer.'],
                ['slug' => 'payment', 'name' => 'Payment', 'description' => 'Card, six months at 0%, ATM transfer, or pay on collection — plus the e-invoice choice a Taiwanese checkout cannot skip.'],
                ['slug' => 'confirmation', 'name' => 'Confirmation', 'description' => 'The order number, what happens on the bench tomorrow, and the window where it can still be changed for free.'],
            ],
            'blog' => [
                ['slug' => 'latest', 'name' => 'Latest', 'description' => 'Nine notes off the workshop bench, narrowed by topic and re-ordered by length without leaving the page.'],
                ['slug' => 'article', 'name' => 'Article', 'description' => 'A fourteen-minute read: a progress bar, a contents rail that follows the scroll, and three sizes to read it at.'],
                ['slug' => 'archive', 'name' => 'Archive', 'description' => 'Every note since 2023, filtered as you type, with the year counts moving as the list narrows.'],
                ['slug' => 'author', 'name' => 'Author', 'description' => 'Who writes these, what they have taken apart, and the two ways to get the next one.'],
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
