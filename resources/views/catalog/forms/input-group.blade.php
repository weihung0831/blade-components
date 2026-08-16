<x-layout title="Input group — BLADE-COMPONENTS">
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
                    Glues text addons and buttons onto a plain input so they read as one control. Pure flexbox, zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $addonsCode = <<<'BLADE'
            <x-ui.input-group>
                <x-slot:prefix>https://</x-slot:prefix>
                <input value="mysite" placeholder="workspace">
                <x-slot:suffix>.saas.dev</x-slot:suffix>
            </x-ui.input-group>
            BLADE;

            $addonsVueCode = <<<'VUE'
            <UiInputGroup>
                <template #prefix>https://</template>
                <input value="mysite" placeholder="workspace" />
                <template #suffix>.saas.dev</template>
            </UiInputGroup>
            VUE;

            $addonsReactCode = <<<'REACT'
            <UiInputGroup prefix="https://" suffix=".saas.dev">
                <input defaultValue="mysite" placeholder="workspace" />
            </UiInputGroup>
            REACT;

            $buttonCode = <<<'BLADE'
            <x-ui.input-group>
                <input value="npm install blade-ui" readonly>
                <button type="button">Copy</button>
            </x-ui.input-group>
            BLADE;

            $buttonVueCode = <<<'VUE'
            <UiInputGroup>
                <input value="npm install blade-ui" readonly />
                <button type="button">Copy</button>
            </UiInputGroup>
            VUE;

            $buttonReactCode = <<<'REACT'
            <UiInputGroup>
                <input defaultValue="npm install blade-ui" readOnly />
                <button type="button">Copy</button>
            </UiInputGroup>
            REACT;

            $smallCode = <<<'BLADE'
            <x-ui.input-group size="sm">
                <x-slot:prefix>$</x-slot:prefix>
                <input value="php artisan migrate" readonly>
            </x-ui.input-group>
            BLADE;

            $smallVueCode = <<<'VUE'
            <UiInputGroup size="sm">
                <template #prefix>$</template>
                <input value="php artisan migrate" readonly />
            </UiInputGroup>
            VUE;

            $smallReactCode = <<<'REACT'
            <UiInputGroup size="sm" prefix="$">
                <input defaultValue="php artisan migrate" readOnly />
            </UiInputGroup>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Text addons"
                description="Prefix and suffix slots render as attached mono-spaced addons. The whole group lights up on focus."
                :code="$addonsCode" :vue-code="$addonsVueCode" :react-code="$addonsReactCode">
                <x-ui.input-group class="w-80">
                    <x-slot:prefix>https://</x-slot:prefix>
                    <input value="mysite" placeholder="workspace">
                    <x-slot:suffix>.saas.dev</x-slot:suffix>
                </x-ui.input-group>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="With a button"
                description="Drop a plain button next to the input — it gets styled as part of the group."
                :code="$buttonCode" :vue-code="$buttonVueCode" :react-code="$buttonReactCode">
                <x-ui.input-group class="w-80 [&>input]:font-mono">
                    <input value="npm install blade-ui" readonly>
                    <button type="button">Copy</button>
                </x-ui.input-group>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Small"
                description="size sm shrinks the whole group for dense layouts."
                :code="$smallCode" :vue-code="$smallVueCode" :react-code="$smallReactCode">
                <x-ui.input-group size="sm" class="w-72 [&>input]:font-mono">
                    <x-slot:prefix>$</x-slot:prefix>
                    <input value="php artisan migrate" readonly>
                </x-ui.input-group>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="input-group" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
