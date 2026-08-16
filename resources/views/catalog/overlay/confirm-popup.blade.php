<x-layout title="Confirm popup — BLADE-COMPONENTS">
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
                    A confirmation bubble anchored to the control that asks for it — lighter than a modal for quick decisions. In Blade, confirming dispatches a bubbling ui-confirm event on the details element; in Vue and React it's a plain event or callback.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.confirm-popup title="Revoke this key?" description="Requests signed with it start failing immediately." confirm="Revoke key">
                <x-slot:trigger>
                    <span class="inline-flex h-10 items-center rounded-lg border border-red-500/20 bg-red-500/10 px-4 text-sm font-medium text-red-400 transition-colors duration-150 hover:bg-red-500/20">Revoke API key</span>
                </x-slot>
            </x-ui.confirm-popup>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiConfirmPopup title="Revoke this key?" description="Requests signed with it start failing immediately." confirm="Revoke key" @confirm="revoke">
                <template #trigger>
                    <span class="inline-flex h-10 items-center rounded-lg border border-red-500/20 bg-red-500/10 px-4 text-sm font-medium text-red-400 transition-colors duration-150 hover:bg-red-500/20">Revoke API key</span>
                </template>
            </UiConfirmPopup>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiConfirmPopup
                title="Revoke this key?"
                description="Requests signed with it start failing immediately."
                confirm="Revoke key"
                onConfirm={revoke}
                trigger={
                    <span className="inline-flex h-10 items-center rounded-lg border border-red-500/20 bg-red-500/10 px-4 text-sm font-medium text-red-400 transition-colors duration-150 hover:bg-red-500/20">Revoke API key</span>
                }
            />
            REACT;

            $primaryCode = <<<'BLADE'
            <x-ui.confirm-popup variant="primary" title="Publish to production?" description="The change goes live for every tenant on this plan." confirm="Publish" cancel="Not yet">
                <x-slot:trigger>
                    <span class="inline-flex h-10 items-center rounded-lg bg-jade-500 px-4 text-sm font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Publish changes</span>
                </x-slot>
            </x-ui.confirm-popup>
            BLADE;

            $primaryVueCode = <<<'VUE'
            <UiConfirmPopup variant="primary" title="Publish to production?" description="The change goes live for every tenant on this plan." confirm="Publish" cancel="Not yet" @confirm="publish">
                <template #trigger>
                    <span class="inline-flex h-10 items-center rounded-lg bg-jade-500 px-4 text-sm font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Publish changes</span>
                </template>
            </UiConfirmPopup>
            VUE;

            $primaryReactCode = <<<'REACT'
            <UiConfirmPopup
                variant="primary"
                title="Publish to production?"
                description="The change goes live for every tenant on this plan."
                confirm="Publish"
                cancel="Not yet"
                onConfirm={publish}
                trigger={
                    <span className="inline-flex h-10 items-center rounded-lg bg-jade-500 px-4 text-sm font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Publish changes</span>
                }
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic" padding="px-10 pt-10 pb-44"
                description="Danger by default — the bubble sits next to the control it protects, and an outside click backs out safely."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.confirm-popup title="Revoke this key?" description="Requests signed with it start failing immediately." confirm="Revoke key">
                    <x-slot:trigger>
                        <span class="inline-flex h-10 items-center rounded-lg border border-red-500/20 bg-red-500/10 px-4 text-sm font-medium text-red-400 transition-colors duration-150 hover:bg-red-500/20">Revoke API key</span>
                    </x-slot>
                </x-ui.confirm-popup>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Primary variant" padding="px-10 pt-10 pb-44"
                description="Not every confirmation is destructive. The primary variant fits deliberate-but-safe actions like publishing."
                :code="$primaryCode" :vue-code="$primaryVueCode" :react-code="$primaryReactCode">
                <x-ui.confirm-popup variant="primary" title="Publish to production?" description="The change goes live for every tenant on this plan." confirm="Publish" cancel="Not yet">
                    <x-slot:trigger>
                        <span class="inline-flex h-10 items-center rounded-lg bg-jade-500 px-4 text-sm font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Publish changes</span>
                    </x-slot>
                </x-ui.confirm-popup>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="confirm-popup" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
