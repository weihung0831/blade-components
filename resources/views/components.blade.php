<x-layout title="Components — BLADE-COMPONENTS">
    <div class="mx-auto grid max-w-6xl gap-10 px-6 py-16 pb-28 lg:grid-cols-[190px_1fr]">

        {{-- Sidebar --}}
        <nav class="hidden lg:block">
            <div class="sticky top-24">
                <p class="mb-3 font-mono text-xs tracking-wider text-zinc-600 uppercase">Categories</p>
                <ul class="flex flex-col gap-0.5 border-l border-white/8 text-sm">
                    @foreach ($categories as $category => $items)
                        <li>
                            <a href="#{{ Str::slug($category) }}" data-spy-link
                                class="-ml-px flex items-center justify-between border-l border-transparent py-1.5 pr-2 pl-4 text-zinc-400 transition-colors duration-150 hover:border-jade-500 hover:text-cream data-active:border-jade-500 data-active:text-cream">
                                {{ $category }}
                                <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', count($items)) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        {{-- Catalog --}}
        <div>
            <div class="rise mb-10 flex items-end justify-between">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-cream">Components</h1>
                    <p class="mt-1.5 text-sm text-zinc-500">Every piece rendered live. What you see is what you paste.</p>
                </div>
                <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $total) }} — more soon</span>
            </div>

            <div class="flex flex-col gap-12">
                @foreach ($categories as $category => $items)
                    <section id="{{ Str::slug($category) }}" data-spy-section class="scroll-mt-24">
                        <div class="mb-4 flex items-baseline gap-3">
                            <h2 class="text-lg font-semibold tracking-tight text-cream">{{ $category }}</h2>
                            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', count($items)) }}</span>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                            @foreach ($items as $item)
                                @php
                                    $isBuilt = View::exists('catalog.'.Str::slug($category).'.'.$item['slug']);
                                @endphp
                                <x-preview-card :name="$item['name']" :variants="$item['variants']" :soon="! $isBuilt"
                                    :href="$isBuilt ? route('components.show', $item['slug']) : null"
                                    style="animation-delay: {{ min(60 + $loop->index * 50, 360) }}ms">
                                    <x-dynamic-component :component="'previews.'.Str::slug($category).'.'.$item['slug']" />
                                </x-preview-card>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>
        </div>

    </div>
</x-layout>
