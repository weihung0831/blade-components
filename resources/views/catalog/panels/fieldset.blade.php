<x-layout title="Fieldset — BLADE-COMPONENTS">
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
                    A real fieldset and legend, styled. Groups related form controls under a floating label, and the toggleable version collapses on a hidden checkbox — no JavaScript in the Blade build.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.fieldset legend="Billing address" class="w-80">
                <div class="flex flex-col gap-3">
                    <input placeholder="Street" class="h-9 w-full rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                    <div class="flex gap-3">
                        <input placeholder="City" class="h-9 min-w-0 flex-1 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                        <input placeholder="Zip" class="h-9 w-20 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                    </div>
                </div>
            </x-ui.fieldset>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiFieldset legend="Billing address" class="w-80">
                <div class="flex flex-col gap-3">
                    <input placeholder="Street" class="h-9 w-full rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                    <div class="flex gap-3">
                        <input placeholder="City" class="h-9 min-w-0 flex-1 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                        <input placeholder="Zip" class="h-9 w-20 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                    </div>
                </div>
            </UiFieldset>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiFieldset legend="Billing address" className="w-80">
                <div className="flex flex-col gap-3">
                    <input placeholder="Street" className="h-9 w-full rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500" />
                    <div className="flex gap-3">
                        <input placeholder="City" className="h-9 min-w-0 flex-1 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500" />
                        <input placeholder="Zip" className="h-9 w-20 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500" />
                    </div>
                </div>
            </UiFieldset>
            REACT;

            $toggleableCode = <<<'BLADE'
            <x-ui.fieldset legend="Advanced options" :toggleable="true" :open="false" class="w-80">
                <p class="text-sm/6 text-zinc-500">Custom domains, SSO enforcement, and audit log retention live here. Defaults cover most workspaces.</p>
            </x-ui.fieldset>
            BLADE;

            $toggleableVueCode = <<<'VUE'
            <UiFieldset legend="Advanced options" toggleable :open="false" class="w-80">
                <p class="text-sm/6 text-zinc-500">Custom domains, SSO enforcement, and audit log retention live here. Defaults cover most workspaces.</p>
            </UiFieldset>
            VUE;

            $toggleableReactCode = <<<'REACT'
            <UiFieldset legend="Advanced options" toggleable open={false} className="w-80">
                <p className="text-sm/6 text-zinc-500">Custom domains, SSO enforcement, and audit log retention live here. Defaults cover most workspaces.</p>
            </UiFieldset>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="A legend prop and the body slot. The border and floating label come from the native elements, so screen readers group the controls for free."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.fieldset legend="Billing address" class="w-80">
                    <div class="flex flex-col gap-3">
                        <input placeholder="Street" class="h-9 w-full rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                        <div class="flex gap-3">
                            <input placeholder="City" class="h-9 min-w-0 flex-1 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                            <input placeholder="Zip" class="h-9 w-20 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 hover:border-white/20 focus:border-jade-500">
                        </div>
                    </div>
                </x-ui.fieldset>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Toggleable"
                description="The legend becomes the trigger and the body animates closed. Start collapsed by passing open as false."
                :code="$toggleableCode" :vue-code="$toggleableVueCode" :react-code="$toggleableReactCode">
                <x-ui.fieldset legend="Advanced options" :toggleable="true" :open="false" class="w-80">
                    <p class="text-sm/6 text-zinc-500">Custom domains, SSO enforcement, and audit log retention live here. Defaults cover most workspaces.</p>
                </x-ui.fieldset>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="fieldset" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
