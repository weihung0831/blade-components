<x-ui.flip-card class="h-20 w-32">
    <x-slot:front>
        <div class="grid h-full place-items-center rounded-lg border border-white/10 bg-ink-800">
            <span class="font-mono text-[10px] tracking-wider text-zinc-400 uppercase">Front</span>
        </div>
    </x-slot>

    <x-slot:back>
        <div class="grid h-full place-items-center rounded-lg border border-jade-500/40 bg-jade-500/10">
            <span class="font-mono text-[10px] tracking-wider text-jade-300 uppercase">Back</span>
        </div>
    </x-slot>
</x-ui.flip-card>
