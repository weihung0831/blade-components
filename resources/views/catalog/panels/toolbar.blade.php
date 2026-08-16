<x-layout title="Toolbar — BLADE-COMPONENTS">
    <div class="mx-auto max-w-4xl px-6 py-16 pb-28">

        <a href="{{ route('components') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Components
        </a>

        <div class="rise mt-5 flex items-end justify-between" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">{{ $category }}</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $item['name'] }}</h1>
                <p class="mt-2 max-w-lg text-sm/6 text-zinc-500">
                    A slim action bar with start, center, and end regions. Drop in whatever controls you like — the bar only handles alignment and the frame.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.toolbar class="w-96">
                <x-slot:start>
                    <button type="button" class="grid size-7 place-items-center rounded-lg bg-white/8 font-mono text-xs font-bold text-cream">B</button>
                    <button type="button" class="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 italic transition-colors duration-150 hover:bg-white/5 hover:text-cream">I</button>
                    <button type="button" class="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 underline transition-colors duration-150 hover:bg-white/5 hover:text-cream">U</button>
                    <span class="mx-1 h-5 w-px bg-white/10"></span>
                    <button type="button" class="grid size-7 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M6.5 9.5 3 13m5-9.5L12.5 8M5.5 3.5l7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                    </button>
                </x-slot>
                <x-slot:end>
                    <button type="button" class="rounded-lg bg-jade-500 px-3 py-1.5 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Save</button>
                </x-slot>
            </x-ui.toolbar>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiToolbar class="w-96">
                <template #start>
                    <button type="button" class="grid size-7 place-items-center rounded-lg bg-white/8 font-mono text-xs font-bold text-cream">B</button>
                    <button type="button" class="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 italic transition-colors duration-150 hover:bg-white/5 hover:text-cream">I</button>
                    <button type="button" class="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 underline transition-colors duration-150 hover:bg-white/5 hover:text-cream">U</button>
                    <span class="mx-1 h-5 w-px bg-white/10"></span>
                    <button type="button" class="grid size-7 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M6.5 9.5 3 13m5-9.5L12.5 8M5.5 3.5l7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                    </button>
                </template>
                <template #end>
                    <button type="button" class="rounded-lg bg-jade-500 px-3 py-1.5 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Save</button>
                </template>
            </UiToolbar>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiToolbar
                className="w-96"
                start={
                    <>
                        <button type="button" className="grid size-7 place-items-center rounded-lg bg-white/8 font-mono text-xs font-bold text-cream">B</button>
                        <button type="button" className="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 italic transition-colors duration-150 hover:bg-white/5 hover:text-cream">I</button>
                        <button type="button" className="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 underline transition-colors duration-150 hover:bg-white/5 hover:text-cream">U</button>
                        <span className="mx-1 h-5 w-px bg-white/10" />
                        <button type="button" className="grid size-7 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                            <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M6.5 9.5 3 13m5-9.5L12.5 8M5.5 3.5l7 7" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round"/></svg>
                        </button>
                    </>
                }
                end={<button type="button" className="rounded-lg bg-jade-500 px-3 py-1.5 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Save</button>}
            />
            REACT;

            $regionsCode = <<<'BLADE'
            <x-ui.toolbar class="w-[28rem]">
                <x-slot:start>
                    <button type="button" class="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">New</button>
                    <button type="button" class="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">Upload</button>
                </x-slot>
                <x-slot:center>
                    <div class="flex rounded-lg bg-ink-950 p-0.5">
                        <button type="button" class="rounded-md bg-white/8 px-2.5 py-1 text-xs text-cream">Grid</button>
                        <button type="button" class="rounded-md px-2.5 py-1 text-xs text-zinc-500 transition-colors duration-150 hover:text-zinc-300">List</button>
                    </div>
                </x-slot>
                <x-slot:end>
                    <span class="grid size-7 place-items-center rounded-full bg-jade-500/15 font-mono text-[11px] text-jade-400">WH</span>
                </x-slot>
            </x-ui.toolbar>
            BLADE;

            $regionsVueCode = <<<'VUE'
            <UiToolbar class="w-[28rem]">
                <template #start>
                    <button type="button" class="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">New</button>
                    <button type="button" class="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">Upload</button>
                </template>
                <template #center>
                    <div class="flex rounded-lg bg-ink-950 p-0.5">
                        <button type="button" class="rounded-md bg-white/8 px-2.5 py-1 text-xs text-cream">Grid</button>
                        <button type="button" class="rounded-md px-2.5 py-1 text-xs text-zinc-500 transition-colors duration-150 hover:text-zinc-300">List</button>
                    </div>
                </template>
                <template #end>
                    <span class="grid size-7 place-items-center rounded-full bg-jade-500/15 font-mono text-[11px] text-jade-400">WH</span>
                </template>
            </UiToolbar>
            VUE;

            $regionsReactCode = <<<'REACT'
            <UiToolbar
                className="w-[28rem]"
                start={
                    <>
                        <button type="button" className="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">New</button>
                        <button type="button" className="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">Upload</button>
                    </>
                }
                center={
                    <div className="flex rounded-lg bg-ink-950 p-0.5">
                        <button type="button" className="rounded-md bg-white/8 px-2.5 py-1 text-xs text-cream">Grid</button>
                        <button type="button" className="rounded-md px-2.5 py-1 text-xs text-zinc-500 transition-colors duration-150 hover:text-zinc-300">List</button>
                    </div>
                }
                end={<span className="grid size-7 place-items-center rounded-full bg-jade-500/15 font-mono text-[11px] text-jade-400">WH</span>}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Start and end slots at the two edges. Dividers are a one-line span between buttons."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.toolbar class="w-96">
                    <x-slot:start>
                        <button type="button" class="grid size-7 place-items-center rounded-lg bg-white/8 font-mono text-xs font-bold text-cream">B</button>
                        <button type="button" class="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 italic transition-colors duration-150 hover:bg-white/5 hover:text-cream">I</button>
                        <button type="button" class="grid size-7 place-items-center rounded-lg font-mono text-xs text-zinc-400 underline transition-colors duration-150 hover:bg-white/5 hover:text-cream">U</button>
                        <span class="mx-1 h-5 w-px bg-white/10"></span>
                        <button type="button" class="grid size-7 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M6.5 9.5 3 13m5-9.5L12.5 8M5.5 3.5l7 7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                        </button>
                    </x-slot>
                    <x-slot:end>
                        <button type="button" class="rounded-lg bg-jade-500 px-3 py-1.5 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Save</button>
                    </x-slot>
                </x-ui.toolbar>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Three regions"
                description="Add the center slot and the bar spaces all three regions apart — actions left, view switch in the middle, identity on the right."
                :code="$regionsCode" :vue-code="$regionsVueCode" :react-code="$regionsReactCode">
                <x-ui.toolbar class="w-[28rem]">
                    <x-slot:start>
                        <button type="button" class="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">New</button>
                        <button type="button" class="rounded-lg px-2.5 py-1.5 text-xs text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream">Upload</button>
                    </x-slot>
                    <x-slot:center>
                        <div class="flex rounded-lg bg-ink-950 p-0.5">
                            <button type="button" class="rounded-md bg-white/8 px-2.5 py-1 text-xs text-cream">Grid</button>
                            <button type="button" class="rounded-md px-2.5 py-1 text-xs text-zinc-500 transition-colors duration-150 hover:text-zinc-300">List</button>
                        </div>
                    </x-slot>
                    <x-slot:end>
                        <span class="grid size-7 place-items-center rounded-full bg-jade-500/15 font-mono text-[11px] text-jade-400">WH</span>
                    </x-slot>
                </x-ui.toolbar>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="toolbar" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
