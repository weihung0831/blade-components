<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $screen }} — {{ $template['name'] }}</title>
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.dataset.theme = 'light';
        }
    </script>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-dvh bg-ink-950 font-sans text-zinc-300 antialiased selection:bg-jade-500/30 selection:text-cream">
    <x-dynamic-component :component="$component" />
</body>
</html>
