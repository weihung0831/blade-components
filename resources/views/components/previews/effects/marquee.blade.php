<x-ui.marquee :speed="9" gap="gap-2" class="w-48">
    @foreach (['Laravel', 'Blade', 'Vite', 'Tailwind'] as $name)
        <span class="rounded-full border border-white/10 px-2.5 py-1 font-mono text-[9px] whitespace-nowrap text-zinc-400">{{ $name }}</span>
    @endforeach
</x-ui.marquee>
