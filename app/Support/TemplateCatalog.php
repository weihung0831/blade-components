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
            ['slug' => 'kanban', 'name' => 'Kanban board', 'description' => 'A shop-floor board where the columns are machines, the limits bite, and every card drags.', 'pages' => 4],
            ['slug' => 'inbox', 'name' => 'Inbox', 'description' => 'A support desk where the clock is the point: what came in, what nobody has answered, and how late it already is.', 'pages' => 4],
            ['slug' => 'faq', 'name' => 'FAQ', 'description' => 'A help centre that keeps score — what it answers, what people vote useless, and what they searched for and never found.', 'pages' => 4],
            ['slug' => 'contact', 'name' => 'Contact', 'description' => 'The other side of the help centre: four ways in, the person behind each one, and a clock that admits when nobody is awake.', 'pages' => 4],
            ['slug' => 'terms', 'name' => 'Terms', 'description' => 'Fourteen clauses, the plain-English column beside them, every version since 2019, and the one you personally agreed to.', 'pages' => 4],
            ['slug' => 'privacy', 'name' => 'Privacy', 'description' => 'Twenty-one fields we hold, nine outsiders who see any of them, four switches that do something, and the log of who opened your record.', 'pages' => 4],
            ['slug' => 'refund', 'name' => 'Refund policy', 'description' => 'Eight ways a machine comes back, the one deduction we make and how it is worked out, a refund you can watch move, and the nine we turned down — one of them wrongly.', 'pages' => 4],
            ['slug' => 'onboarding', 'name' => 'Onboarding', 'description' => 'Five steps a new shop walks through, two of which it may skip, the import that eats a fifth of an afternoon, and the count of everybody who never finished.', 'pages' => 4],
            ['slug' => 'changelog', 'name' => 'Changelog', 'description' => 'Forty-one releases since 2023, the three we took back out, what each one broke and for whom, and the eleven weeks between announcing a thing and shipping it.', 'pages' => 4],
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
            'kanban' => [
                ['slug' => 'board', 'name' => 'Board', 'description' => 'Five stations and 21 jobs, dragged between them. Two columns are over their limit and say so before anything else does.'],
                ['slug' => 'ticket', 'name' => 'Ticket', 'description' => 'One job opened up: the complaint behind it, the eleven things it has to clear, and what it is waiting on.'],
                ['slug' => 'backlog', 'name' => 'Backlog', 'description' => 'What has not been scheduled — costed in bench hours, sorted three ways, and sent to a station in batches.'],
                ['slug' => 'workload', 'name' => 'Workload', 'description' => 'Four people, five days, and the machines they are booked on. Thursday is where it falls over.'],
            ],
            'inbox' => [
                ['slug' => 'threads', 'name' => 'Inbox', 'description' => 'Nine live conversations, a reply clock running on each, and whichever one you click open beside the list.'],
                ['slug' => 'conversation', 'name' => 'Thread', 'description' => 'One warranty complaint end to end: eleven messages, six of which the customer never sees, and the one that actually fixed it.'],
                ['slug' => 'compose', 'name' => 'Compose', 'description' => 'Five canned replies that fill their own blanks, and a send button that knows it is 04:12 where he is.'],
                ['slug' => 'search', 'name' => 'Search', 'description' => 'A small query language over fourteen months of mail, with the facet counts moving as you type.'],
            ],
            'faq' => [
                ['slug' => 'questions', 'name' => 'Help centre', 'description' => 'Sixteen answers under six headings, narrowed as you type, each one carrying the score that decides whether it survives the month.'],
                ['slug' => 'answer', 'name' => 'Answer', 'description' => 'The Batch 40 noise in full: how to tell it apart from burrs bedding in, the twenty minutes it takes to fix, and the two ways out if you would rather not open the machine.'],
                ['slug' => 'ask', 'name' => 'Ask', 'description' => 'A form that tries to talk you out of sending it. Three answers surface while you type, and only what they miss reaches the desk.'],
                ['slug' => 'editing', 'name' => 'Editing', 'description' => 'What the search box heard last month — 1,284 queries, the nine that found nothing, and the answer four people in a row voted useless.'],
            ],
            'contact' => [
                ['slug' => 'desk', 'name' => 'The desk', 'description' => 'Four ways in, each one a named person with the hours they keep and the time they actually take. It is 04:12 at the bench, and the page says so before you start typing.'],
                ['slug' => 'write', 'name' => 'Write in', 'description' => 'The form changes shape with the reason you pick — a serial for a warranty, an order number for a parcel, a monthly volume for a shop — and names the desk it lands on while you fill it.'],
                ['slug' => 'visit', 'name' => 'Visit', 'description' => 'Where the bench is, the two afternoons you can turn up, and the unmarked door everybody walks past twice.'],
                ['slug' => 'sent', 'name' => 'Sent', 'description' => 'A reference, a clock that only counts working hours, and the three answers that might save you the wait.'],
            ],
            'terms' => [
                ['slug' => 'document', 'name' => 'The terms', 'description' => 'Fourteen numbered clauses with a plain sentence under each one, three of them marked as the ones people get caught by, and a switch that hides everything untouched since the last version.'],
                ['slug' => 'plain', 'name' => 'Short version', 'description' => 'The same fourteen in a line each, sorted by who the clause is actually for. Four favour us, and the page says which four rather than leaving you to find out.'],
                ['slug' => 'changes', 'name' => 'What changed', 'description' => 'Seven versions since April 2019, and the diff for each — struck out, added, and the reason underneath. The one waiting to take effect gets 45 days rather than the 30 we promise.'],
                ['slug' => 'record', 'name' => 'Your copy', 'description' => 'Which version you agreed to, when, and from where. Every order stays under the terms in force the day it was placed, so the list is of frozen copies, not one that quietly moves.'],
            ],
            'privacy' => [
                ['slug' => 'held', 'name' => 'What we hold', 'description' => 'Twenty-one fields under five headings, each with the reason it exists, the clock it runs on, and whether you can have it deleted this afternoon or the tax office says no.'],
                ['slug' => 'shared', 'name' => 'Who sees it', 'description' => 'Nine companies outside the workshop, what each one is handed, and which country it lands in. Underneath, the three who asked and were told no, with dates.'],
                ['slug' => 'controls', 'name' => 'Your switches', 'description' => 'Four switches, three of them off until you say otherwise, each naming the cookies it sets and what stops working without it. Refusing everything is one click, same as accepting.'],
                ['slug' => 'request', 'name' => 'Ask for it', 'description' => 'A copy of the lot in six files, what stays behind and the act that pins it there, and the log of every time somebody at the workshop opened your record — including the one who opened it by mistake.'],
            ],
            'refund' => [
                ['slug' => 'policy', 'name' => 'The policy', 'description' => 'Eight reasons a machine comes back, sorted by how much of your money follows it. Four give you everything, two give you most of it, and two are a no printed in the same size as the rest.'],
                ['slug' => 'send', 'name' => 'Send it back', 'description' => 'Pick the reason and the page costs it out before you fill anything in — who books the courier, what lands back, how long it takes. One of the five reasons tells you not to send it.'],
                ['slug' => 'progress', 'name' => 'Where yours is', 'description' => 'One refund mid-flight: what the bench found when it opened the box, the arithmetic underneath the figure, and the last hop that belongs to your bank rather than to us.'],
                ['slug' => 'ledger', 'name' => 'The ledger', 'description' => '214 refunds since 2019, what they were for, the nine we refused with the reason written out, and the three faults that only got fixed because the returns kept pointing at them.'],
            ],
            'onboarding' => [
                ['slug' => 'setup', 'name' => 'Setting up', 'description' => 'Five steps, three of them required, each saying what breaks if you skip it and how long the last hundred shops spent on it. The region step is the one you cannot come back and change.'],
                ['slug' => 'import', 'name' => 'Bringing it over', 'description' => 'A 412-row export from the platform you are leaving: what maps cleanly, the nineteen rows that will not survive the trip, and what to do about the SKUs you already have here.'],
                ['slug' => 'checklist', 'name' => 'What is left', 'description' => 'Nine things, five done. Three of them hold the shop shut and six do not, and two moved out of the first group once we noticed nobody was doing them.'],
                ['slug' => 'dropout', 'name' => 'Where people stop', 'description' => '1,847 shops started this and 1,113 opened. Where the rest went, how long each step really takes against what we claimed, and the two steps this page argued us out of.'],
            ],
            'changelog' => [
                ['slug' => 'releases', 'name' => 'The log', 'description' => 'Thirteen releases across three months, every line saying who would notice it. Two of them are marked as things we broke, and one of those was out for four hours before it came back off.'],
                ['slug' => 'release', 'name' => 'One release', 'description' => '4.2.0 in full: the field that changed name, the sixteen lines of migration, the six days it took to reach every region, and the hotfix that followed it eleven hours later.'],
                ['slug' => 'subscribe', 'name' => 'Getting told', 'description' => 'Four ways to hear about this, and a filter that costs you 9 mails a year instead of 214. Set it and the page counts what last year would have looked like.'],
                ['slug' => 'record', 'name' => 'The record', 'description' => 'Fourteen things announced, nine shipped, three dropped, and the average eleven weeks between the two. Plus the three releases we pulled, with what went wrong written out.'],
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
