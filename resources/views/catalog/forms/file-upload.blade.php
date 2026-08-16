<x-layout title="File upload — BLADE-COMPONENTS">
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
                    A styled label over a hidden file input, so browse, drop, and keyboard focus all just work. Dropzone and compact layouts.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $dropzoneCode = <<<'BLADE'
            <x-ui.file-upload name="attachments" :multiple="true" />
            BLADE;

            $compactCode = <<<'BLADE'
            <x-ui.file-upload name="avatar" :compact="true" />
            BLADE;

            $dropzoneVueCode = <<<'VUE'
            <UiFileUpload multiple @change="onFiles" />
            VUE;

            $compactVueCode = <<<'VUE'
            <UiFileUpload compact @change="onFiles" />
            VUE;

            $dropzoneReactCode = <<<'REACT'
            <UiFileUpload multiple onChange={setFiles} />
            REACT;

            $compactReactCode = <<<'REACT'
            <UiFileUpload compact onChange={setFiles} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Dropzone"
                description="Drag files onto the dashed area or click to browse. Each pick lands in a list below with its size and a remove button; drops stack onto what's already there."
                :code="$dropzoneCode" :vue-code="$dropzoneVueCode" :react-code="$dropzoneReactCode">
                <x-ui.file-upload name="attachments" :multiple="true" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Compact"
                description="The compact prop swaps the dropzone for a one-line row that still accepts drops."
                :code="$compactCode" :vue-code="$compactVueCode" :react-code="$compactReactCode">
                <x-ui.file-upload name="avatar" :compact="true" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="file-upload" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
