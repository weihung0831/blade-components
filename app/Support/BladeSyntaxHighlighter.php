<?php

namespace App\Support;

class BladeSyntaxHighlighter
{
    /**
     * Convert a Blade/HTML snippet into markup with Tailwind color spans.
     *
     * Handles the subset used in demo and install snippets: tag names,
     * attributes, quoted attribute values, single-quoted strings, angle
     * brackets, and Blade directives. Output is HTML-escaped before any
     * spans are added, so it is safe to render with {!! !!}.
     *
     * Palette: tags jade, attribute names sky, strings amber, directives
     * violet, punctuation zinc — the light theme remaps sky/amber/violet
     * in app.css alongside the other tokens.
     */
    public static function highlight(string $code): string
    {
        $escaped = e($code);

        $escaped = preg_replace(
            '/([\w:-]+)=&quot;(.*?)&quot;/',
            '<span class="text-sky-300">$1</span><span class="text-zinc-600">=</span><span class="text-amber-200">&quot;$2&quot;</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/(&#039;.*?&#039;)/',
            '<span class="text-amber-200">$1</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/(&lt;\/?)([\w.:-]+)/',
            '<span class="text-zinc-600">$1</span><span class="text-jade-400">$2</span>',
            $escaped
        );

        $escaped = preg_replace('/(\/?&gt;)/', '<span class="text-zinc-600">$1</span>', $escaped);

        return preg_replace(
            '/(?<![\w@])(@[a-zA-Z]\w*)/',
            '<span class="text-violet-300">$1</span>',
            $escaped
        );
    }

    /**
     * Convert a CSS snippet into markup with Tailwind color spans.
     *
     * Handles the subset used in install snippets: at-rules, custom
     * properties, declaration values, and braces. Output is HTML-escaped
     * before any spans are added, so it is safe to render with {!! !!}.
     */
    public static function highlightCss(string $code): string
    {
        $escaped = e($code);

        $escaped = preg_replace(
            '/^(\s*)(--[\w-]+)(\s*:\s*)(.*?)(;)$/',
            '$1<span class="text-sky-300">$2</span><span class="text-zinc-600">$3</span><span class="text-amber-200">$4</span><span class="text-zinc-600">$5</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/^(@[\w-]+)/',
            '<span class="text-violet-300">$1</span>',
            $escaped
        );

        return preg_replace('/([{}])/', '<span class="text-zinc-600">$1</span>', $escaped);
    }
}
