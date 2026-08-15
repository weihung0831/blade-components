<?php

namespace App\Support;

class BladeSyntaxHighlighter
{
    /**
     * Convert a Blade/HTML/JS snippet into markup with Tailwind color spans.
     *
     * Handles the subset used in demo and install snippets: tag names,
     * attributes, quoted attribute values, single-quoted strings, angle
     * brackets, arrows, keywords, variables, and Blade directives. Output
     * is HTML-escaped before any spans are added, so it is safe to render
     * with {!! !!}.
     *
     * Colors follow VS Code roles via the code-* theme tokens in app.css:
     * tags teal, attributes and variables light blue, strings salmon,
     * declaration keywords blue, control keywords and directives purple.
     */
    public static function highlight(string $code): string
    {
        $escaped = e($code);

        $escaped = preg_replace(
            '/([\w:-]+)=&quot;(.*?)&quot;/',
            '<span class="text-code-attr">$1</span><span class="text-zinc-600">=</span><span class="text-code-string">&quot;$2&quot;</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/(&#039;.*?&#039;)/',
            '<span class="text-code-string">$1</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/(&lt;\/?)([\w.:-]+)/',
            '<span class="text-zinc-600">$1</span><span class="text-code-tag">$2</span>',
            $escaped
        );

        $escaped = preg_replace('/((?:=|-)&gt;)/', '<span class="text-zinc-600">$1</span>', $escaped);

        $escaped = preg_replace('/(?<![=-])(\/?&gt;)/', '<span class="text-zinc-600">$1</span>', $escaped);

        $escaped = preg_replace(
            '/(?<![\w$@-])(return|export|import|from|if|else)(?![\w-])/',
            '<span class="text-code-control">$1</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/(?<![\w$@-])(const|let|function|null|true|false|new|default)(?![\w-])/',
            '<span class="text-code-keyword">$1</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/(\$[a-zA-Z_]\w*)/',
            '<span class="text-code-attr">$1</span>',
            $escaped
        );

        return preg_replace(
            '/(?<![\w@])(@[a-zA-Z]\w*)/',
            '<span class="text-code-control">$1</span>',
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
            '$1<span class="text-code-attr">$2</span><span class="text-zinc-600">$3</span><span class="text-code-string">$4</span><span class="text-zinc-600">$5</span>',
            $escaped
        );

        $escaped = preg_replace(
            '/^(@[\w-]+)/',
            '<span class="text-code-control">$1</span>',
            $escaped
        );

        return preg_replace('/([{}])/', '<span class="text-zinc-600">$1</span>', $escaped);
    }
}
