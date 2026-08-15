<div class="w-48 overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_15%,black_85%,transparent)]">
    <div class="flex w-max gap-2 pr-2 [animation:marquee_9s_linear_infinite]">
        @foreach (['Laravel', 'Blade', 'Vite', 'Tailwind', 'Laravel', 'Blade', 'Vite', 'Tailwind'] as $name)
            <span class="rounded-full border border-white/10 px-2.5 py-1 font-mono text-[9px] whitespace-nowrap text-zinc-400">{{ $name }}</span>
        @endforeach
    </div>
</div>
