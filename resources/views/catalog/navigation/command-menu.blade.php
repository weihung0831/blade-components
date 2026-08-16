<x-layout title="Command menu — BLADE-COMPONENTS">
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
                    The ⌘K palette power users reach for before they touch the sidebar. Type to filter, arrow through the results, Enter to run. It's a native dialog, so focus trapping and Escape come free.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <button type="button" data-ui-command-target="workspace-palette"
                class="inline-flex h-10 items-center gap-3 rounded-lg border border-white/10 px-4 text-sm text-zinc-400 transition-colors duration-150 hover:border-white/25 hover:text-cream">
                Search commands
                <span class="rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">⌘K</span>
            </button>

            <x-ui.command-menu id="workspace-palette" :groups="[
                ['label' => 'Navigation', 'items' => [
                    ['label' => 'Go to dashboard', 'shortcut' => 'G D'],
                    ['label' => 'Go to deploys', 'shortcut' => 'G P'],
                    ['label' => 'Go to billing', 'shortcut' => 'G B'],
                ]],
                ['label' => 'Actions', 'items' => [
                    ['label' => 'Invite teammate'],
                    ['label' => 'Rotate API key'],
                    ['label' => 'Deploy to production', 'shortcut' => '⇧D'],
                ]],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <button type="button" @click="palette = true">Search commands</button>

            <UiCommandMenu v-model:open="palette" :groups="groups" @select="run" />
            VUE;

            $basicReactCode = <<<'REACT'
            const [palette, setPalette] = useState(false);

            useCommandShortcut('k', () => setPalette(true));

            <button type="button" onClick={() => setPalette(true)}>Search commands</button>

            <UiCommandMenu open={palette} onClose={() => setPalette(false)} onSelect={run} groups={groups} />
            REACT;

            $scopedCode = <<<'BLADE'
            <x-ui.command-menu id="log-palette" shortcut="j" placeholder="Filter log streams…" :groups="[
                ['label' => 'Recent', 'items' => [
                    ['label' => 'api-gateway', 'shortcut' => '2m ago'],
                    ['label' => 'worker-queue', 'shortcut' => '11m ago'],
                ]],
                ['label' => 'All services', 'items' => [
                    ['label' => 'billing-sync'],
                    ['label' => 'edge-cache'],
                    ['label' => 'webhooks-dispatcher'],
                ]],
            ]" />
            BLADE;

            $scopedVueCode = <<<'VUE'
            <UiCommandMenu
                v-model:open="logs"
                shortcut="j"
                placeholder="Filter log streams…"
                :groups="groups"
                @select="openStream"
            />
            VUE;

            $scopedReactCode = <<<'REACT'
            useCommandShortcut('j', () => setLogs(true));

            <UiCommandMenu
                open={logs}
                onClose={() => setLogs(false)}
                placeholder="Filter log streams…"
                groups={groups}
                onSelect={openStream}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Press ⌘K, or click the trigger — any element carrying data-ui-command-target opens the palette with that id. Groups keep the list readable while it's unfiltered."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <button type="button" data-ui-command-target="workspace-palette"
                    class="inline-flex h-10 cursor-pointer items-center gap-3 rounded-lg border border-white/10 px-4 text-sm text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    Search commands
                    <span class="rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">⌘K</span>
                </button>

                <x-ui.command-menu id="workspace-palette" :groups="[
                    ['label' => 'Navigation', 'items' => [
                        ['label' => 'Go to dashboard', 'shortcut' => 'G D'],
                        ['label' => 'Go to deploys', 'shortcut' => 'G P'],
                        ['label' => 'Go to billing', 'shortcut' => 'G B'],
                    ]],
                    ['label' => 'Actions', 'items' => [
                        ['label' => 'Invite teammate'],
                        ['label' => 'Rotate API key'],
                        ['label' => 'Deploy to production', 'shortcut' => '⇧D'],
                    ]],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Its own shortcut and placeholder"
                description="Two palettes can live on one page as long as their shortcuts differ. This one answers to ⌘J and searches log streams instead of commands."
                :code="$scopedCode" :vue-code="$scopedVueCode" :react-code="$scopedReactCode">
                <button type="button" data-ui-command-target="log-palette"
                    class="inline-flex h-10 cursor-pointer items-center gap-3 rounded-lg bg-jade-500 px-4 text-sm font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    Open log search
                    <span class="rounded bg-ink-950/15 px-1.5 py-0.5 font-mono text-[10px]">⌘J</span>
                </button>

                <x-ui.command-menu id="log-palette" shortcut="j" placeholder="Filter log streams…" :groups="[
                    ['label' => 'Recent', 'items' => [
                        ['label' => 'api-gateway', 'shortcut' => '2m ago'],
                        ['label' => 'worker-queue', 'shortcut' => '11m ago'],
                    ]],
                    ['label' => 'All services', 'items' => [
                        ['label' => 'billing-sync'],
                        ['label' => 'edge-cache'],
                        ['label' => 'webhooks-dispatcher'],
                    ]],
                ]" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="command-menu" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
