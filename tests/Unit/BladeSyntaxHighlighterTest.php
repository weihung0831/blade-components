<?php

use App\Support\BladeSyntaxHighlighter;

it('colors component tag names', function () {
    expect(BladeSyntaxHighlighter::highlight('<x-ui.button>'))
        ->toContain('<span class="text-code-tag">x-ui.button</span>')
        ->toContain('<span class="text-zinc-600">&lt;</span>');
});

it('colors closing and self-closing tags', function () {
    expect(BladeSyntaxHighlighter::highlight('</x-ui.card>'))
        ->toContain('<span class="text-zinc-600">&lt;/</span><span class="text-code-tag">x-ui.card</span>');

    expect(BladeSyntaxHighlighter::highlight('<x-ui.progress />'))
        ->toContain('<span class="text-zinc-600">/&gt;</span>');
});

it('colors attributes and quoted values', function () {
    expect(BladeSyntaxHighlighter::highlight('<x-ui.button variant="danger">'))
        ->toContain('<span class="text-code-attr">variant</span>')
        ->toContain('<span class="text-code-string">&quot;danger&quot;</span>');
});

it('escapes html so raw markup never leaks through', function () {
    expect(BladeSyntaxHighlighter::highlight('<script>alert(1)</script>'))
        ->not->toContain('<script>');
});

it('leaves plain text untouched', function () {
    expect(BladeSyntaxHighlighter::highlight('Upgrade plan'))->toBe('Upgrade plan');
});
