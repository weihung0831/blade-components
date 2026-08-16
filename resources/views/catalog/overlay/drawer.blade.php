<x-layout title="Drawer — BLADE-COMPONENTS">
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
                    A full-height panel that slides in from the side of the viewport. Same native-dialog foundation as the modal, so Escape and backdrop clicks work without any wiring.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.button data-ui-drawer-target="drawer-usage">View usage</x-ui.button>

            <x-ui.drawer id="drawer-usage" title="Usage this cycle">
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between"><span>API requests</span><span class="font-mono text-xs text-zinc-300">1.2M / 2M</span></div>
                    <div class="flex items-center justify-between"><span>Build minutes</span><span class="font-mono text-xs text-zinc-300">340 / 500</span></div>
                    <div class="flex items-center justify-between"><span>Seats</span><span class="font-mono text-xs text-zinc-300">7 / 10</span></div>
                </div>
                <x-slot:footer>
                    <x-ui.button variant="secondary" size="sm" data-ui-drawer-close>Close</x-ui.button>
                    <x-ui.button size="sm">Upgrade plan</x-ui.button>
                </x-slot>
            </x-ui.drawer>
            BLADE;

            $basicVueCode = <<<'VUE'
            <script setup>
            import { ref } from 'vue';

            const open = ref(false);
            </script>

            <template>
                <UiButton @click="open = true">View usage</UiButton>
                <UiDrawer v-model:open="open" title="Usage this cycle">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between"><span>API requests</span><span class="font-mono text-xs text-zinc-300">1.2M / 2M</span></div>
                        <div class="flex items-center justify-between"><span>Build minutes</span><span class="font-mono text-xs text-zinc-300">340 / 500</span></div>
                        <div class="flex items-center justify-between"><span>Seats</span><span class="font-mono text-xs text-zinc-300">7 / 10</span></div>
                    </div>
                    <template #footer>
                        <UiButton variant="secondary" size="sm" @click="open = false">Close</UiButton>
                        <UiButton size="sm">Upgrade plan</UiButton>
                    </template>
                </UiDrawer>
            </template>
            VUE;

            $basicReactCode = <<<'REACT'
            const [open, setOpen] = useState(false);

            <UiButton onClick={() => setOpen(true)}>View usage</UiButton>
            <UiDrawer
                open={open}
                onClose={() => setOpen(false)}
                title="Usage this cycle"
                footer={
                    <>
                        <UiButton variant="secondary" size="sm" onClick={() => setOpen(false)}>Close</UiButton>
                        <UiButton size="sm">Upgrade plan</UiButton>
                    </>
                }
            >
                <div className="flex flex-col gap-3">
                    <div className="flex items-center justify-between"><span>API requests</span><span className="font-mono text-xs text-zinc-300">1.2M / 2M</span></div>
                    <div className="flex items-center justify-between"><span>Build minutes</span><span className="font-mono text-xs text-zinc-300">340 / 500</span></div>
                    <div className="flex items-center justify-between"><span>Seats</span><span className="font-mono text-xs text-zinc-300">7 / 10</span></div>
                </div>
            </UiDrawer>
            REACT;

            $sideCode = <<<'BLADE'
            <x-ui.drawer id="drawer-left" side="left" title="Workspace">
                <p>Slides in from the left — the usual spot for navigation on smaller screens.</p>
            </x-ui.drawer>
            BLADE;

            $sideVueCode = <<<'VUE'
            <UiDrawer v-model:open="open" side="left" title="Workspace">
                <p>Slides in from the left — the usual spot for navigation on smaller screens.</p>
            </UiDrawer>
            VUE;

            $sideReactCode = <<<'REACT'
            <UiDrawer open={open} onClose={() => setOpen(false)} side="left" title="Workspace">
                <p>Slides in from the left — the usual spot for navigation on smaller screens.</p>
            </UiDrawer>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Opens from the right by default. Header, scrollable body, and an optional pinned footer."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.button data-ui-drawer-target="drawer-usage">View usage</x-ui.button>
                <x-ui.drawer id="drawer-usage" title="Usage this cycle">
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between"><span>API requests</span><span class="font-mono text-xs text-zinc-300">1.2M / 2M</span></div>
                        <div class="flex items-center justify-between"><span>Build minutes</span><span class="font-mono text-xs text-zinc-300">340 / 500</span></div>
                        <div class="flex items-center justify-between"><span>Seats</span><span class="font-mono text-xs text-zinc-300">7 / 10</span></div>
                    </div>
                    <x-slot:footer>
                        <x-ui.button variant="secondary" size="sm" data-ui-drawer-close>Close</x-ui.button>
                        <x-ui.button size="sm">Upgrade plan</x-ui.button>
                    </x-slot>
                </x-ui.drawer>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="From the left"
                description="Set side to left and the panel anchors to the other edge, border and slide direction included."
                :code="$sideCode" :vue-code="$sideVueCode" :react-code="$sideReactCode">
                <x-ui.button variant="secondary" data-ui-drawer-target="drawer-left">Open left drawer</x-ui.button>
                <x-ui.drawer id="drawer-left" side="left" title="Workspace">
                    <p>Slides in from the left — the usual spot for navigation on smaller screens.</p>
                </x-ui.drawer>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="drawer" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
