@props([
    'shot' => 'front',
])

@php
    $shots = [
        ['key' => 'front', 'label' => 'Front', 'meta' => '01', 'caption' => 'front view'],
        ['key' => 'burrs', 'label' => 'Burr set', 'meta' => '02', 'caption' => '83 mm burr set'],
        ['key' => 'dial', 'label' => 'Dial', 'meta' => '03', 'caption' => 'grind dial at 042'],
        ['key' => 'box', 'label' => 'In the box', 'meta' => '04', 'caption' => 'what ships in the box'],
    ];

    $stage = [
        'front' => 'group-data-[shot=front]/gallery:opacity-100',
        'burrs' => 'group-data-[shot=burrs]/gallery:opacity-100',
        'dial' => 'group-data-[shot=dial]/gallery:opacity-100',
        'box' => 'group-data-[shot=box]/gallery:opacity-100',
    ];

    $thumb = [
        'front' => 'group-data-[shot=front]/gallery:border-jade-500/60 group-data-[shot=front]/gallery:text-cream',
        'burrs' => 'group-data-[shot=burrs]/gallery:border-jade-500/60 group-data-[shot=burrs]/gallery:text-cream',
        'dial' => 'group-data-[shot=dial]/gallery:border-jade-500/60 group-data-[shot=dial]/gallery:text-cream',
        'box' => 'group-data-[shot=box]/gallery:border-jade-500/60 group-data-[shot=box]/gallery:text-cream',
    ];
@endphp

<div {{ $attributes->class('group/gallery flex flex-col gap-3') }} data-shot="{{ $shot }}">
    <div class="dot-grid relative aspect-square overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
        <span aria-hidden="true" class="pointer-events-none absolute -top-16 left-1/2 size-72 -translate-x-1/2 rounded-full bg-jade-500/8 blur-3xl"></span>

        <span class="absolute top-4 left-4 z-10 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">
            EG-83
            <span class="hidden group-data-[finish=graphite]/shell:inline">· graphite</span>
            <span class="hidden group-data-[finish=cream]/shell:inline">· cream</span>
            <span class="hidden group-data-[finish=jade]/shell:inline">· jade</span>
        </span>

        <span class="absolute top-4 right-4 z-10 rounded-full border border-white/10 bg-ink-950/70 px-2 py-0.5 font-mono text-[10px] text-zinc-500">1:2 scale</span>

        @foreach ($shots as $item)
            <div class="pointer-events-none absolute inset-0 px-6 pt-12 pb-6 opacity-0 transition-opacity duration-300 {{ $stage[$item['key']] }}">
                <div class="flex size-full flex-col items-center justify-center gap-3 rounded-2xl border border-dashed border-white/12">
                    <svg class="size-8 text-zinc-700" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.3"/>
                        <circle cx="8.5" cy="10" r="1.5" stroke="currentColor" stroke-width="1.3"/>
                        <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p class="font-mono text-[11px] text-zinc-500">{{ $item['caption'] }}</p>
                    <p class="font-mono text-[10px] text-zinc-700">1200 × 1200 · webp</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-4 gap-2">
        @foreach ($shots as $item)
            <button type="button" data-shot-set="{{ $item['key'] }}"
                class="flex flex-col gap-1 rounded-xl border border-white/8 bg-ink-900 px-3 py-2 text-left text-zinc-500 transition-colors duration-150 outline-none hover:border-white/20 focus-visible:ring-2 focus-visible:ring-jade-500/70 {{ $thumb[$item['key']] }}">
                <span class="font-mono text-[10px] text-zinc-600">{{ $item['meta'] }}</span>
                <span class="truncate text-[12px]">{{ $item['label'] }}</span>
            </button>
        @endforeach
    </div>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-shot-set]');

            if (button) {
                button.closest('[data-shot]').dataset.shot = button.dataset.shotSet;
            }
        });
    </script>
@endonce
