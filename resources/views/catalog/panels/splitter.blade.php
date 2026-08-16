<x-layout title="Splitter — BLADE-COMPONENTS">
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
                    Two panes with a draggable gutter between them. Pointer events drive the resize, so it works with mouse and touch alike, and a min prop keeps either pane from collapsing.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.splitter :size="35" class="h-56 w-full max-w-lg">
                <x-slot:first>
                    <div class="flex flex-col gap-0.5 p-2 font-mono text-xs">
                        <span class="rounded-md bg-white/8 px-2 py-1.5 text-cream">routes.php</span>
                        <span class="px-2 py-1.5 text-zinc-500">schema.sql</span>
                        <span class="px-2 py-1.5 text-zinc-500">deploy.yml</span>
                    </div>
                </x-slot>
                <x-slot:second>
                    <div class="p-4">
                        <p class="text-sm font-medium text-cream">routes.php</p>
                        <p class="mt-1.5 text-xs/5 text-zinc-500">Twelve routes, three of them behind the subscription middleware. Last touched two days ago.</p>
                    </div>
                </x-slot>
            </x-ui.splitter>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiSplitter :size="35" class="h-56 w-full max-w-lg">
                <template #first>
                    <div class="flex flex-col gap-0.5 p-2 font-mono text-xs">
                        <span class="rounded-md bg-white/8 px-2 py-1.5 text-cream">routes.php</span>
                        <span class="px-2 py-1.5 text-zinc-500">schema.sql</span>
                        <span class="px-2 py-1.5 text-zinc-500">deploy.yml</span>
                    </div>
                </template>
                <template #second>
                    <div class="p-4">
                        <p class="text-sm font-medium text-cream">routes.php</p>
                        <p class="mt-1.5 text-xs/5 text-zinc-500">Twelve routes, three of them behind the subscription middleware. Last touched two days ago.</p>
                    </div>
                </template>
            </UiSplitter>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiSplitter
                size={35}
                className="h-56 w-full max-w-lg"
                first={
                    <div className="flex flex-col gap-0.5 p-2 font-mono text-xs">
                        <span className="rounded-md bg-white/8 px-2 py-1.5 text-cream">routes.php</span>
                        <span className="px-2 py-1.5 text-zinc-500">schema.sql</span>
                        <span className="px-2 py-1.5 text-zinc-500">deploy.yml</span>
                    </div>
                }
                second={
                    <div className="p-4">
                        <p className="text-sm font-medium text-cream">routes.php</p>
                        <p className="mt-1.5 text-xs/5 text-zinc-500">Twelve routes, three of them behind the subscription middleware. Last touched two days ago.</p>
                    </div>
                }
            />
            REACT;

            $verticalCode = <<<'BLADE'
            <x-ui.splitter orientation="vertical" :size="55" class="h-64 w-full max-w-lg">
                <x-slot:first>
                    <div class="p-4 font-mono text-xs/6 text-zinc-400">
                        <p><span class="text-jade-400">$tenant</span> = Tenant::current();</p>
                        <p><span class="text-jade-400">$plan</span> = $tenant-&gt;plan;</p>
                        <p>abort_if($plan-&gt;seatsLeft() === 0, 402);</p>
                    </div>
                </x-slot>
                <x-slot:second>
                    <div class="p-4 font-mono text-xs/6">
                        <p class="text-zinc-500">$ php artisan test --filter=Seats</p>
                        <p class="text-jade-400">PASS &nbsp;Tests\Feature\SeatLimitTest</p>
                    </div>
                </x-slot>
            </x-ui.splitter>
            BLADE;

            $verticalVueCode = <<<'VUE'
            <UiSplitter orientation="vertical" :size="55" class="h-64 w-full max-w-lg">
                <template #first>
                    <div class="p-4 font-mono text-xs/6 text-zinc-400">
                        <p><span class="text-jade-400">$tenant</span> = Tenant::current();</p>
                        <p><span class="text-jade-400">$plan</span> = $tenant->plan;</p>
                        <p>abort_if($plan->seatsLeft() === 0, 402);</p>
                    </div>
                </template>
                <template #second>
                    <div class="p-4 font-mono text-xs/6">
                        <p class="text-zinc-500">$ php artisan test --filter=Seats</p>
                        <p class="text-jade-400">PASS &nbsp;Tests\Feature\SeatLimitTest</p>
                    </div>
                </template>
            </UiSplitter>
            VUE;

            $verticalReactCode = <<<'REACT'
            <UiSplitter
                orientation="vertical"
                size={55}
                className="h-64 w-full max-w-lg"
                first={
                    <div className="p-4 font-mono text-xs/6 text-zinc-400">
                        <p><span className="text-jade-400">$tenant</span> = Tenant::current();</p>
                        <p><span className="text-jade-400">$plan</span> = $tenant-&gt;plan;</p>
                        <p>abort_if($plan-&gt;seatsLeft() === 0, 402);</p>
                    </div>
                }
                second={
                    <div className="p-4 font-mono text-xs/6">
                        <p className="text-zinc-500">$ php artisan test --filter=Seats</p>
                        <p className="text-jade-400">PASS&nbsp;&nbsp;Tests\Feature\SeatLimitTest</p>
                    </div>
                }
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Two named slots and a size prop for the first pane's share. Grab the gutter and drag."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.splitter :size="35" class="h-56 w-full max-w-lg">
                    <x-slot:first>
                        <div class="flex flex-col gap-0.5 p-2 font-mono text-xs">
                            <span class="rounded-md bg-white/8 px-2 py-1.5 text-cream">routes.php</span>
                            <span class="px-2 py-1.5 text-zinc-500">schema.sql</span>
                            <span class="px-2 py-1.5 text-zinc-500">deploy.yml</span>
                        </div>
                    </x-slot>
                    <x-slot:second>
                        <div class="p-4">
                            <p class="text-sm font-medium text-cream">routes.php</p>
                            <p class="mt-1.5 text-xs/5 text-zinc-500">Twelve routes, three of them behind the subscription middleware. Last touched two days ago.</p>
                        </div>
                    </x-slot>
                </x-ui.splitter>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Vertical"
                description="Flip the orientation and the gutter moves between stacked panes — the editor-over-console layout."
                :code="$verticalCode" :vue-code="$verticalVueCode" :react-code="$verticalReactCode">
                <x-ui.splitter orientation="vertical" :size="55" class="h-64 w-full max-w-lg">
                    <x-slot:first>
                        <div class="p-4 font-mono text-xs/6 text-zinc-400">
                            <p><span class="text-jade-400">$tenant</span> = Tenant::current();</p>
                            <p><span class="text-jade-400">$plan</span> = $tenant-&gt;plan;</p>
                            <p>abort_if($plan-&gt;seatsLeft() === 0, 402);</p>
                        </div>
                    </x-slot>
                    <x-slot:second>
                        <div class="p-4 font-mono text-xs/6">
                            <p class="text-zinc-500">$ php artisan test --filter=Seats</p>
                            <p class="text-jade-400">PASS &nbsp;Tests\Feature\SeatLimitTest</p>
                        </div>
                    </x-slot>
                </x-ui.splitter>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="splitter" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
