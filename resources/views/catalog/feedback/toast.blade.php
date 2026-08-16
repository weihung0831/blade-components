<x-layout title="Toast — BLADE-COMPONENTS">
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
                    A transient notification pinned to a viewport corner. In Blade, any element with a data-ui-toast-target attribute opens the matching toast; it slides in, waits out its duration, and slides away.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.button data-ui-toast-target="toast-saved">Save changes</x-ui.button>

            <x-ui.toast id="toast-saved" title="Changes saved" description="Your billing settings are live." />
            BLADE;

            $basicVueCode = <<<'VUE'
            <script setup>
            import { ref } from 'vue';

            const open = ref(false);
            </script>

            <template>
                <UiButton @click="open = true">Save changes</UiButton>
                <UiToast v-model:open="open" title="Changes saved" description="Your billing settings are live." />
            </template>
            VUE;

            $basicReactCode = <<<'REACT'
            const [open, setOpen] = useState(false);

            <UiButton onClick={() => setOpen(true)}>Save changes</UiButton>
            <UiToast open={open} onClose={() => setOpen(false)} title="Changes saved" description="Your billing settings are live." />
            REACT;

            $severityCode = <<<'BLADE'
            <x-ui.toast id="toast-success" variant="success" title="Deploy finished" description="v2.14.0 is live on production." />
            <x-ui.toast id="toast-danger" variant="danger" title="Deploy failed" description="Build step exited with code 1." />
            <x-ui.toast id="toast-warning" variant="warning" title="Approaching quota" description="80% of included seats are in use." />
            <x-ui.toast id="toast-neutral" variant="neutral" title="Export queued" description="We will email you when the CSV is ready." />
            BLADE;

            $severityVueCode = <<<'VUE'
            <UiToast v-model:open="success" variant="success" title="Deploy finished" description="v2.14.0 is live on production." />
            <UiToast v-model:open="danger" variant="danger" title="Deploy failed" description="Build step exited with code 1." />
            <UiToast v-model:open="warning" variant="warning" title="Approaching quota" description="80% of included seats are in use." />
            <UiToast v-model:open="queued" variant="neutral" title="Export queued" description="We will email you when the CSV is ready." />
            VUE;

            $severityReactCode = <<<'REACT'
            <UiToast open={success} onClose={() => setSuccess(false)} variant="success" title="Deploy finished" description="v2.14.0 is live on production." />
            <UiToast open={danger} onClose={() => setDanger(false)} variant="danger" title="Deploy failed" description="Build step exited with code 1." />
            <UiToast open={warning} onClose={() => setWarning(false)} variant="warning" title="Approaching quota" description="80% of included seats are in use." />
            <UiToast open={queued} onClose={() => setQueued(false)} variant="neutral" title="Export queued" description="We will email you when the CSV is ready." />
            REACT;

            $actionCode = <<<'BLADE'
            <x-ui.toast id="toast-undo" variant="neutral" title="Member removed" description="kim@acme.io no longer has access." :duration="8000">
                <x-slot:action>
                    <button type="button" class="text-xs font-medium text-jade-400 transition-colors duration-150 hover:text-jade-300">Undo</button>
                </x-slot>
            </x-ui.toast>
            BLADE;

            $actionVueCode = <<<'VUE'
            <UiToast v-model:open="open" variant="neutral" title="Member removed" description="kim@acme.io no longer has access." :duration="8000">
                <template #action>
                    <button type="button" class="text-xs font-medium text-jade-400 transition-colors duration-150 hover:text-jade-300">Undo</button>
                </template>
            </UiToast>
            VUE;

            $actionReactCode = <<<'REACT'
            <UiToast
                open={open}
                onClose={() => setOpen(false)}
                variant="neutral"
                title="Member removed"
                description="kim@acme.io no longer has access."
                duration={8000}
                action={<button type="button" className="text-xs font-medium text-jade-400 transition-colors duration-150 hover:text-jade-300">Undo</button>}
            />
            REACT;

            $positionCode = <<<'BLADE'
            <x-ui.toast id="toast-br" position="bottom-right" title="Pinned bottom right" />
            <x-ui.toast id="toast-bl" position="bottom-left" title="Pinned bottom left" />
            <x-ui.toast id="toast-tr" position="top-right" title="Pinned top right" />
            <x-ui.toast id="toast-tc" position="top-center" title="Pinned top center" />
            BLADE;

            $positionVueCode = <<<'VUE'
            <UiToast v-model:open="br" position="bottom-right" title="Pinned bottom right" />
            <UiToast v-model:open="bl" position="bottom-left" title="Pinned bottom left" />
            <UiToast v-model:open="tr" position="top-right" title="Pinned top right" />
            <UiToast v-model:open="tc" position="top-center" title="Pinned top center" />
            VUE;

            $positionReactCode = <<<'REACT'
            <UiToast open={br} onClose={() => setBr(false)} position="bottom-right" title="Pinned bottom right" />
            <UiToast open={bl} onClose={() => setBl(false)} position="bottom-left" title="Pinned bottom left" />
            <UiToast open={tr} onClose={() => setTr(false)} position="top-right" title="Pinned top right" />
            <UiToast open={tc} onClose={() => setTc(false)} position="top-center" title="Pinned top center" />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Point a trigger at the toast's id. It auto-dismisses after four seconds, or sooner via the close button."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.button data-ui-toast-target="toast-saved">Save changes</x-ui.button>
                <x-ui.toast id="toast-saved" title="Changes saved" description="Your billing settings are live." />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Severities"
                description="Success, danger, warning, and neutral — same shell, different icon chip."
                :code="$severityCode" :vue-code="$severityVueCode" :react-code="$severityReactCode">
                <x-ui.button variant="secondary" size="sm" data-ui-toast-target="toast-success">Success</x-ui.button>
                <x-ui.button variant="secondary" size="sm" data-ui-toast-target="toast-danger">Danger</x-ui.button>
                <x-ui.button variant="secondary" size="sm" data-ui-toast-target="toast-warning">Warning</x-ui.button>
                <x-ui.button variant="secondary" size="sm" data-ui-toast-target="toast-neutral">Neutral</x-ui.button>
                <x-ui.toast id="toast-success" variant="success" title="Deploy finished" description="v2.14.0 is live on production." />
                <x-ui.toast id="toast-danger" variant="danger" title="Deploy failed" description="Build step exited with code 1." />
                <x-ui.toast id="toast-warning" variant="warning" title="Approaching quota" description="80% of included seats are in use." />
                <x-ui.toast id="toast-neutral" variant="neutral" title="Export queued" description="We will email you when the CSV is ready." />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="With action"
                description="An action slot puts an escape hatch inside the toast. Pair it with a longer duration so the user has time to take it."
                :code="$actionCode" :vue-code="$actionVueCode" :react-code="$actionReactCode">
                <x-ui.button variant="danger" data-ui-toast-target="toast-undo">Remove member</x-ui.button>
                <x-ui.toast id="toast-undo" variant="neutral" title="Member removed" description="kim@acme.io no longer has access." :duration="8000">
                    <x-slot:action>
                        <button type="button" class="text-xs font-medium text-jade-400 transition-colors duration-150 hover:text-jade-300">Undo</button>
                    </x-slot>
                </x-ui.toast>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Positions"
                description="Four viewport anchors. Top positions slide down into place, bottom positions slide up."
                :code="$positionCode" :vue-code="$positionVueCode" :react-code="$positionReactCode">
                <x-ui.button variant="ghost" size="sm" data-ui-toast-target="toast-br">Bottom right</x-ui.button>
                <x-ui.button variant="ghost" size="sm" data-ui-toast-target="toast-bl">Bottom left</x-ui.button>
                <x-ui.button variant="ghost" size="sm" data-ui-toast-target="toast-tr">Top right</x-ui.button>
                <x-ui.button variant="ghost" size="sm" data-ui-toast-target="toast-tc">Top center</x-ui.button>
                <x-ui.toast id="toast-br" position="bottom-right" title="Pinned bottom right" />
                <x-ui.toast id="toast-bl" position="bottom-left" title="Pinned bottom left" />
                <x-ui.toast id="toast-tr" position="top-right" title="Pinned top right" />
                <x-ui.toast id="toast-tc" position="top-center" title="Pinned top center" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="toast" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
