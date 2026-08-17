@props([
    'name' => 'vote',
    'helpful' => 91,
    'votes' => 212,
    'prompt' => 'Did this answer it?',
])

<div {{ $attributes->class('rounded-xl border border-white/8 bg-ink-900 px-4 py-3') }}>
    <div class="flex flex-wrap items-center gap-x-4 gap-y-3">
        <p class="text-[13px] text-zinc-300">{{ $prompt }}</p>

        <div class="flex items-center gap-1.5">
            <label class="cursor-pointer rounded-lg border border-white/10 px-3 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                <input type="radio" name="{{ $name }}" value="yes" class="sr-only">
                It did
            </label>

            <label class="peer/no cursor-pointer rounded-lg border border-white/10 px-3 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-amber-400/50 hover:text-cream has-[:checked]:border-amber-400/60 has-[:checked]:bg-amber-400/10 has-[:checked]:text-amber-300">
                <input type="radio" name="{{ $name }}" value="no" class="sr-only">
                Not really
            </label>

            <span class="ml-1 hidden items-center gap-2 sm:flex">
                <span class="block h-0.5 w-16 overflow-hidden rounded-full bg-white/10">
                    <span class="block h-full rounded-full bg-jade-500/70" style="width: {{ $helpful }}%"></span>
                </span>
                <span class="font-mono text-[10px] text-zinc-600">{{ $helpful }}% of {{ number_format($votes) }}</span>
            </span>
        </div>

        <p class="hidden w-full text-[12px]/5 text-amber-200/80 peer-has-[:checked]/no:block">
            Then it is our fault, not yours.
            <a href="{{ route('templates.screen', ['faq', 'ask']) }}" target="_top" class="text-amber-300 underline decoration-amber-400/40 underline-offset-3 transition-colors duration-150 hover:decoration-amber-300">Tell the desk what is missing</a>
            and whoever rewrites it will read exactly that sentence.
        </p>
    </div>
</div>
