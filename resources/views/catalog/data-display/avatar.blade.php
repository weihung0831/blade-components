<x-layout title="Avatar — BLADE-COMPONENTS">
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
                    Initials or an image in a circle. Three tones, three sizes, status dots, and stacks that overlap cleanly.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.avatar initials="WH" color="jade" />
            <x-ui.avatar initials="AL" />
            <x-ui.avatar src="https://github.com/laravel.png" alt="Laravel" />
            BLADE;

            $variantsVueCode = <<<'VUE'
            <UiAvatar initials="WH" color="jade" />
            <UiAvatar initials="AL" />
            <UiAvatar src="https://github.com/laravel.png" alt="Laravel" />
            VUE;

            $variantsReactCode = <<<'REACT'
            <UiAvatar initials="WH" color="jade" />
            <UiAvatar initials="AL" />
            <UiAvatar src="https://github.com/laravel.png" alt="Laravel" />
            REACT;

            $sizesCode = <<<'BLADE'
            <x-ui.avatar initials="WH" color="jade" size="sm" />
            <x-ui.avatar initials="WH" color="jade" />
            <x-ui.avatar initials="WH" color="jade" size="lg" />
            BLADE;

            $sizesVueCode = <<<'VUE'
            <UiAvatar initials="WH" color="jade" size="sm" />
            <UiAvatar initials="WH" color="jade" />
            <UiAvatar initials="WH" color="jade" size="lg" />
            VUE;

            $sizesReactCode = <<<'REACT'
            <UiAvatar initials="WH" color="jade" size="sm" />
            <UiAvatar initials="WH" color="jade" />
            <UiAvatar initials="WH" color="jade" size="lg" />
            REACT;

            $statusCode = <<<'BLADE'
            <x-ui.avatar initials="WH" color="jade" status="online" />
            <x-ui.avatar initials="AL" status="away" />
            <x-ui.avatar initials="KO" status="busy" />
            <x-ui.avatar initials="MB" status="offline" />
            BLADE;

            $statusVueCode = <<<'VUE'
            <UiAvatar initials="WH" color="jade" status="online" />
            <UiAvatar initials="AL" status="away" />
            <UiAvatar initials="KO" status="busy" />
            <UiAvatar initials="MB" status="offline" />
            VUE;

            $statusReactCode = <<<'REACT'
            <UiAvatar initials="WH" color="jade" status="online" />
            <UiAvatar initials="AL" status="away" />
            <UiAvatar initials="KO" status="busy" />
            <UiAvatar initials="MB" status="offline" />
            REACT;

            $stackCode = <<<'BLADE'
            <div class="flex -space-x-2.5">
                <x-ui.avatar initials="WH" color="jade" class="ring-2 ring-ink-900" />
                <x-ui.avatar initials="AL" class="ring-2 ring-ink-900" />
                <x-ui.avatar initials="KO" class="ring-2 ring-ink-900" />
                <x-ui.avatar initials="+3" color="ghost" class="ring-2 ring-ink-900" />
            </div>
            BLADE;

            $stackVueCode = <<<'VUE'
            <div class="flex -space-x-2.5">
                <UiAvatar initials="WH" color="jade" class="ring-2 ring-ink-900" />
                <UiAvatar initials="AL" class="ring-2 ring-ink-900" />
                <UiAvatar initials="KO" class="ring-2 ring-ink-900" />
                <UiAvatar initials="+3" color="ghost" class="ring-2 ring-ink-900" />
            </div>
            VUE;

            $stackReactCode = <<<'REACT'
            <div className="flex -space-x-2.5">
                <UiAvatar initials="WH" color="jade" className="ring-2 ring-ink-900" />
                <UiAvatar initials="AL" className="ring-2 ring-ink-900" />
                <UiAvatar initials="KO" className="ring-2 ring-ink-900" />
                <UiAvatar initials="+3" color="ghost" className="ring-2 ring-ink-900" />
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Jade for the current user, ink for everyone else, or an image when the profile has one."
                :code="$variantsCode" :vue-code="$variantsVueCode" :react-code="$variantsReactCode">
                <x-ui.avatar initials="WH" color="jade" />
                <x-ui.avatar initials="AL" />
                <x-ui.avatar src="https://github.com/laravel.png" alt="Laravel" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Sizes"
                description="sm for table rows, md for headers and stacks, lg for profile pages."
                :code="$sizesCode" :vue-code="$sizesVueCode" :react-code="$sizesReactCode">
                <x-ui.avatar initials="WH" color="jade" size="sm" />
                <x-ui.avatar initials="WH" color="jade" />
                <x-ui.avatar initials="WH" color="jade" size="lg" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Status"
                description="A presence dot pinned to the corner: online, away, busy, or offline."
                :code="$statusCode" :vue-code="$statusVueCode" :react-code="$statusReactCode">
                <x-ui.avatar initials="WH" color="jade" status="online" />
                <x-ui.avatar initials="AL" status="away" />
                <x-ui.avatar initials="KO" status="busy" />
                <x-ui.avatar initials="MB" status="offline" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Stack"
                description="Negative spacing plus a ring per avatar. Close the stack with a ghost avatar holding the overflow count."
                :code="$stackCode" :vue-code="$stackVueCode" :react-code="$stackReactCode">
                <div class="flex -space-x-2.5">
                    <x-ui.avatar initials="WH" color="jade" class="ring-2 ring-ink-900" />
                    <x-ui.avatar initials="AL" class="ring-2 ring-ink-900" />
                    <x-ui.avatar initials="KO" class="ring-2 ring-ink-900" />
                    <x-ui.avatar initials="+3" color="ghost" class="ring-2 ring-ink-900" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="avatar" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
