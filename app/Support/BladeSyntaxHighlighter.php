<?php

namespace App\Support;

class BladeSyntaxHighlighter
{
    /**
     * Convert a Blade/HTML snippet into markup with Tailwind color spans.
     *
     * Handles the subset used in demo snippets: tag names, attributes,
     * quoted attribute values, and angle brackets. Output is HTML-escaped
     * before any spans are added, so it is safe to render with {!! !!}.
     */
    public static function highlight(string $code): string
    {
        $escaped = e($code);

        $escaped = preg_replace(
            '/([\w:-]+)=&quot;(.*?)&quot;/',
            '<span class="text-zinc-500">$1</span><span class="text-zinc-600">=</span><span class="text-zinc-200">&quot;$2&quot;</span>',
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
            '<span class="text-jade-400">$1</span>',
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
            '$1<span class="text-zinc-500">$2</span><span class="text-zinc-600">$3</span><span class="text-zinc-200">$4</span><span class="text-zinc-600">$5</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/^(@[\w-]+)/',
            '<span class="text-jade-400">$1</span>',
            $escaped
        );

        return preg_replace('/([{}])/', '<span class="text-zinc-600">$1</span>', $escaped);
    }
}
