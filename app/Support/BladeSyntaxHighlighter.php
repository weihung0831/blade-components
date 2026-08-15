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

        return preg_replace('/(\/?&gt;)/', '<span class="text-zinc-600">$1</span>', $escaped);
    }
}
