<x-layout title="Modal — BLADE-COMPONENTS">
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
                    A focused dialog built on the native dialog element, so the top layer, focus trapping, and the Escape key come from the browser. Triggers point at it by id; the close button and a backdrop click also dismiss it.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.button data-ui-modal-target="modal-invite">Invite teammate</x-ui.button>

            <x-ui.modal id="modal-invite" title="Invite a teammate" description="They get an email with a link that joins them to your workspace.">
                <p>Invites count toward your seat limit. You have 3 seats left on the Growth plan.</p>
                <x-slot:footer>
                    <x-ui.button variant="ghost" size="sm" data-ui-modal-close>Cancel</x-ui.button>
                    <x-ui.button size="sm" data-ui-modal-close>Send invite</x-ui.button>
                </x-slot>
            </x-ui.modal>
            BLADE;

            $basicVueCode = <<<'VUE'
            <script setup>
            import { ref } from 'vue';

            const open = ref(false);
            </script>

            <template>
                <UiButton @click="open = true">Invite teammate</UiButton>
                <UiModal v-model:open="open" title="Invite a teammate" description="They get an email with a link that joins them to your workspace.">
                    <p>Invites count toward your seat limit. You have 3 seats left on the Growth plan.</p>
                    <template #footer>
                        <UiButton variant="ghost" size="sm" @click="open = false">Cancel</UiButton>
                        <UiButton size="sm" @click="open = false">Send invite</UiButton>
                    </template>
                </UiModal>
            </template>
            VUE;

            $basicReactCode = <<<'REACT'
            const [open, setOpen] = useState(false);

            <UiButton onClick={() => setOpen(true)}>Invite teammate</UiButton>
            <UiModal
                open={open}
                onClose={() => setOpen(false)}
                title="Invite a teammate"
                description="They get an email with a link that joins them to your workspace."
                footer={
                    <>
                        <UiButton variant="ghost" size="sm" onClick={() => setOpen(false)}>Cancel</UiButton>
                        <UiButton size="sm" onClick={() => setOpen(false)}>Send invite</UiButton>
                    </>
                }
            >
                <p>Invites count toward your seat limit. You have 3 seats left on the Growth plan.</p>
            </UiModal>
            REACT;

            $dangerCode = <<<'BLADE'
            <x-ui.button variant="danger" data-ui-modal-target="modal-delete">Delete project</x-ui.button>

            <x-ui.modal id="modal-delete" title="Delete this project?" description="All environments, deploys, and logs go with it. There is no undo.">
                <x-slot:footer>
                    <x-ui.button variant="ghost" size="sm" data-ui-modal-close>Keep project</x-ui.button>
                    <x-ui.button variant="danger" size="sm" data-ui-modal-close>Delete forever</x-ui.button>
                </x-slot>
            </x-ui.modal>
            BLADE;

            $dangerVueCode = <<<'VUE'
            <UiButton variant="danger" @click="open = true">Delete project</UiButton>
            <UiModal v-model:open="open" title="Delete this project?" description="All environments, deploys, and logs go with it. There is no undo.">
                <template #footer>
                    <UiButton variant="ghost" size="sm" @click="open = false">Keep project</UiButton>
                    <UiButton variant="danger" size="sm" @click="open = false">Delete forever</UiButton>
                </template>
            </UiModal>
            VUE;

            $dangerReactCode = <<<'REACT'
            <UiButton variant="danger" onClick={() => setOpen(true)}>Delete project</UiButton>
            <UiModal
                open={open}
                onClose={() => setOpen(false)}
                title="Delete this project?"
                description="All environments, deploys, and logs go with it. There is no undo."
                footer={
                    <>
                        <UiButton variant="ghost" size="sm" onClick={() => setOpen(false)}>Keep project</UiButton>
                        <UiButton variant="danger" size="sm" onClick={() => setOpen(false)}>Delete forever</UiButton>
                    </>
                }
            />
            REACT;

            $sizeCode = <<<'BLADE'
            <x-ui.modal id="modal-sm" size="sm" title="Small" description="For a single confirmation." />
            <x-ui.modal id="modal-md" size="md" title="Medium" description="The default. Fits most dialogs." />
            <x-ui.modal id="modal-lg" size="lg" title="Large" description="Room for a form or a table." />
            BLADE;

            $sizeVueCode = <<<'VUE'
            <UiModal v-model:open="sm" size="sm" title="Small" description="For a single confirmation." />
            <UiModal v-model:open="md" size="md" title="Medium" description="The default. Fits most dialogs." />
            <UiModal v-model:open="lg" size="lg" title="Large" description="Room for a form or a table." />
            VUE;

            $sizeReactCode = <<<'REACT'
            <UiModal open={sm} onClose={() => setSm(false)} size="sm" title="Small" description="For a single confirmation." />
            <UiModal open={md} onClose={() => setMd(false)} size="md" title="Medium" description="The default. Fits most dialogs." />
            <UiModal open={lg} onClose={() => setLg(false)} size="lg" title="Large" description="Room for a form or a table." />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Point a trigger at the modal's id. Escape, the close button, the backdrop, and any element with data-ui-modal-close all dismiss it."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.button data-ui-modal-target="modal-invite">Invite teammate</x-ui.button>
                <x-ui.modal id="modal-invite" title="Invite a teammate" description="They get an email with a link that joins them to your workspace.">
                    <p>Invites count toward your seat limit. You have 3 seats left on the Growth plan.</p>
                    <x-slot:footer>
                        <x-ui.button variant="ghost" size="sm" data-ui-modal-close>Cancel</x-ui.button>
                        <x-ui.button size="sm" data-ui-modal-close>Send invite</x-ui.button>
                    </x-slot>
                </x-ui.modal>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Destructive confirmation"
                description="Same shell, danger styling on the trigger and the committing button. The safe way out sits first."
                :code="$dangerCode" :vue-code="$dangerVueCode" :react-code="$dangerReactCode">
                <x-ui.button variant="danger" data-ui-modal-target="modal-delete">Delete project</x-ui.button>
                <x-ui.modal id="modal-delete" title="Delete this project?" description="All environments, deploys, and logs go with it. There is no undo.">
                    <x-slot:footer>
                        <x-ui.button variant="ghost" size="sm" data-ui-modal-close>Keep project</x-ui.button>
                        <x-ui.button variant="danger" size="sm" data-ui-modal-close>Delete forever</x-ui.button>
                    </x-slot>
                </x-ui.modal>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Sizes"
                description="Three widths: sm for confirmations, md as the default, lg when the dialog carries a form."
                :code="$sizeCode" :vue-code="$sizeVueCode" :react-code="$sizeReactCode">
                <x-ui.button variant="secondary" size="sm" data-ui-modal-target="modal-sm">Small</x-ui.button>
                <x-ui.button variant="secondary" size="sm" data-ui-modal-target="modal-md">Medium</x-ui.button>
                <x-ui.button variant="secondary" size="sm" data-ui-modal-target="modal-lg">Large</x-ui.button>
                <x-ui.modal id="modal-sm" size="sm" title="Small" description="For a single confirmation." />
                <x-ui.modal id="modal-md" size="md" title="Medium" description="The default. Fits most dialogs." />
                <x-ui.modal id="modal-lg" size="lg" title="Large" description="Room for a form or a table." />
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="modal" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
