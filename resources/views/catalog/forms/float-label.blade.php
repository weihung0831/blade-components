<x-layout title="Float label — BLADE-COMPONENTS">
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
                    The label rests inside the field and floats to the border on focus or when filled. Pure CSS via :placeholder-shown.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.float-label label="Email" type="email" />
            <x-ui.float-label label="Company" value="Acme Inc." />
            BLADE;

            $basicJsCode = <<<'JS'
            <UiFloatLabel label="Email" type="email" />
            <UiFloatLabel label="Company" value="Acme Inc." />
            JS;

            $invalidCode = <<<'BLADE'
            <x-ui.float-label label="Workspace URL" state="invalid" value="my site" />
            BLADE;

            $invalidJsCode = <<<'JS'
            <UiFloatLabel label="Workspace URL" state="invalid" value="my site" />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Click into the empty field to see the label lift. A filled field keeps it floated."
                :code="$basicCode" :vue-code="$basicJsCode" :react-code="$basicJsCode">
                <div class="w-64"><x-ui.float-label label="Email" type="email" /></div>
                <div class="w-64"><x-ui.float-label label="Company" value="Acme Inc." /></div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Invalid"
                description="state invalid turns the border and the focused label red."
                :code="$invalidCode" :vue-code="$invalidJsCode" :react-code="$invalidJsCode">
                <div class="w-64"><x-ui.float-label label="Workspace URL" state="invalid" value="my site" /></div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="float-label" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
