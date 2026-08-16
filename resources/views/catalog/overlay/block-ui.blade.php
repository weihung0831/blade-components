<x-layout title="Block UI — BLADE-COMPONENTS">
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
                    Dims and locks a region while work is in flight. Wrap the content once; toggle the data-blocked attribute — or the blocked prop — and the overlay fades in over just that region, spinner included.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.button variant="secondary" size="sm" data-ui-block-toggle="block-invoices">Toggle blocking</x-ui.button>

            <x-ui.block-ui id="block-invoices" class="rounded-xl border border-white/10 bg-ink-900 p-5">
                <p class="text-sm font-medium text-zinc-200">Open invoices</p>
                <p class="mt-1 text-xs text-zinc-500">12 unpaid · $8,420 outstanding</p>
            </x-ui.block-ui>
            BLADE;

            $basicVueCode = <<<'VUE'
            <script setup>
            import { ref } from 'vue';

            const blocked = ref(false);
            </script>

            <template>
                <UiButton variant="secondary" size="sm" @click="blocked = !blocked">Toggle blocking</UiButton>
                <UiBlockUi :blocked="blocked" class="rounded-xl border border-white/10 bg-ink-900 p-5">
                    <p class="text-sm font-medium text-zinc-200">Open invoices</p>
                    <p class="mt-1 text-xs text-zinc-500">12 unpaid · $8,420 outstanding</p>
                </UiBlockUi>
            </template>
            VUE;

            $basicReactCode = <<<'REACT'
            const [blocked, setBlocked] = useState(false);

            <UiButton variant="secondary" size="sm" onClick={() => setBlocked(!blocked)}>Toggle blocking</UiButton>
            <UiBlockUi blocked={blocked} className="rounded-xl border border-white/10 bg-ink-900 p-5">
                <p className="text-sm font-medium text-zinc-200">Open invoices</p>
                <p className="mt-1 text-xs text-zinc-500">12 unpaid · $8,420 outstanding</p>
            </UiBlockUi>
            REACT;

            $labelCode = <<<'BLADE'
            <x-ui.block-ui id="block-sync" label="Syncing invoices…" blocked class="rounded-xl border border-white/10 bg-ink-900 p-5">
                <p class="text-sm font-medium text-zinc-200">Stripe import</p>
                <p class="mt-1 text-xs text-zinc-500">Last synced 2 hours ago</p>
            </x-ui.block-ui>
            BLADE;

            $labelVueCode = <<<'VUE'
            <UiBlockUi :blocked="true" label="Syncing invoices…" class="rounded-xl border border-white/10 bg-ink-900 p-5">
                <p class="text-sm font-medium text-zinc-200">Stripe import</p>
                <p class="mt-1 text-xs text-zinc-500">Last synced 2 hours ago</p>
            </UiBlockUi>
            VUE;

            $labelReactCode = <<<'REACT'
            <UiBlockUi blocked label="Syncing invoices…" className="rounded-xl border border-white/10 bg-ink-900 p-5">
                <p className="text-sm font-medium text-zinc-200">Stripe import</p>
                <p className="mt-1 text-xs text-zinc-500">Last synced 2 hours ago</p>
            </UiBlockUi>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="In Blade, any element with data-ui-block-toggle flips the data-blocked attribute on the matching wrapper. The overlay inherits the wrapper's border radius."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex w-full max-w-sm flex-col gap-3">
                    <x-ui.button variant="secondary" size="sm" class="self-start" data-ui-block-toggle="block-invoices">Toggle blocking</x-ui.button>
                    <x-ui.block-ui id="block-invoices" class="rounded-xl border border-white/10 bg-ink-900 p-5">
                        <p class="text-sm font-medium text-zinc-200">Open invoices</p>
                        <p class="mt-1 text-xs text-zinc-500">12 unpaid · $8,420 outstanding</p>
                    </x-ui.block-ui>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="With label"
                description="A label under the spinner says what the wait is for. Start it blocked and release it when the job reports back."
                :code="$labelCode" :vue-code="$labelVueCode" :react-code="$labelReactCode">
                <div class="w-full max-w-sm">
                    <x-ui.block-ui id="block-sync" label="Syncing invoices…" blocked class="rounded-xl border border-white/10 bg-ink-900 p-5">
                        <p class="text-sm font-medium text-zinc-200">Stripe import</p>
                        <p class="mt-1 text-xs text-zinc-500">Last synced 2 hours ago</p>
                    </x-ui.block-ui>
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="block-ui" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
