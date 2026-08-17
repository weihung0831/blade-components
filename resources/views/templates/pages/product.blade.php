@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/product/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/product/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/product/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $finishCode = <<<'BLADE'
    <div class="group/shell" data-finish="graphite">
        <x-templates.product.finish-picker detailed />

        <p class="text-3xl text-cream">
            <span class="group-data-[finish=jade]/shell:hidden">$1,180</span>
            <span class="hidden group-data-[finish=jade]/shell:inline">$1,300</span>
        </p>
    </div>

    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-finish-set]');

            if (button) {
                button.closest('[data-finish]').dataset.finish = button.dataset.finishSet;
            }
        });
    </script>
    BLADE;

    $finishVueCode = <<<'VUE'
    <script setup>
    import { ref } from 'vue';
    import ProductFinishPicker from './FinishPicker.vue';

    const finish = ref('graphite');
    </script>

    <template>
        <div class="group/shell" :data-finish="finish">
            <ProductFinishPicker v-model="finish" detailed />

            <p class="text-3xl text-cream">{{ finish === 'jade' ? '$1,300' : '$1,180' }}</p>
        </div>
    </template>
    VUE;

    $finishReactCode = <<<'REACT'
    const [finish, setFinish] = useState('graphite');

    return (
        <div className="group/shell" data-finish={finish}>
            <ProductFinishPicker value={finish} onChange={setFinish} detailed />

            <p className="text-3xl text-cream">{finish === 'jade' ? '$1,300' : '$1,180'}</p>
        </div>
    );
    REACT;

    $galleryCode = <<<'BLADE'
    <x-templates.product.gallery shot="front" />

    {{-- Inside the gallery: one attribute on the shell, every stage reads it --}}
    <div class="group/gallery" data-shot="front">
        <div class="pointer-events-none absolute inset-0 opacity-0 group-data-[shot=burrs]/gallery:opacity-100">
            <img src="/img/eg-83/burrs.webp" alt="83 mm burr set" class="size-full object-cover" />
        </div>

        <button type="button" data-shot-set="burrs"
            class="rounded-xl border border-white/8 group-data-[shot=burrs]/gallery:border-jade-500/60">Burr set</button>
    </div>
    BLADE;

    $galleryVueCode = <<<'VUE'
    <script setup>
    import { ref } from 'vue';

    const shot = ref('front');
    </script>

    <template>
        <div class="group/gallery" :data-shot="shot">
            <div class="pointer-events-none absolute inset-0 opacity-0 group-data-[shot=burrs]/gallery:opacity-100">
                <img src="/img/eg-83/burrs.webp" alt="83 mm burr set" class="size-full object-cover" />
            </div>

            <button type="button" @click="shot = 'burrs'"
                class="rounded-xl border" :class="shot === 'burrs' ? 'border-jade-500/60' : 'border-white/8'">Burr set</button>
        </div>
    </template>
    VUE;

    $galleryReactCode = <<<'REACT'
    const [shot, setShot] = useState('front');

    return (
        <div className="group/gallery" data-shot={shot}>
            <div className="pointer-events-none absolute inset-0 opacity-0 group-data-[shot=burrs]/gallery:opacity-100">
                <img src="/img/eg-83/burrs.webp" alt="83 mm burr set" class="size-full object-cover" />
            </div>

            <button type="button" onClick={() => setShot('burrs')}
                className={`rounded-xl border ${shot === 'burrs' ? 'border-jade-500/60' : 'border-white/8'}`}>Burr set</button>
        </div>
    );
    REACT;

    $specCode = <<<'BLADE'
    <div class="flex flex-col divide-y divide-white/5 rounded-2xl border border-white/8 bg-ink-900">
        <x-templates.product.spec-row label="Diameter" value="83 mm flat" note="Italian tool steel" />
        <x-templates.product.spec-row label="Coating" value="Titanium nitride" note="2,400 HV" />
        <x-templates.product.spec-row label="Rated life" value="1,400 kg" note="filter roast, 20 g doses" />
    </div>
    BLADE;

    $specVueCode = <<<'VUE'
    <div class="flex flex-col divide-y divide-white/5 rounded-2xl border border-white/8 bg-ink-900">
        <ProductSpecRow
            v-for="row in rows"
            :key="row.label"
            :label="row.label"
            :value="row.value"
            :note="row.note ?? null"
        />
    </div>
    VUE;

    $specReactCode = <<<'REACT'
    <div className="flex flex-col divide-y divide-white/5 rounded-2xl border border-white/8 bg-ink-900">
        {rows.map((row) => (
            <ProductSpecRow key={row.label} label={row.label} value={row.value} note={row.note ?? null} />
        ))}
    </div>
    REACT;

    $barCode = <<<'BLADE'
    <x-templates.product.review-bar :stars="5" :count="241" :percent="77" active />
    <x-templates.product.review-bar :stars="4" :count="48" :percent="15" />

    <script>
        root.addEventListener('click', (event) => {
            const button = event.target.closest('[data-review-filter]');

            if (!button) {
                return;
            }

            root.querySelectorAll('[data-review-filter]').forEach((control) => {
                control.toggleAttribute('data-active', control === button);
            });

            cards.forEach((card) => {
                card.classList.toggle('hidden', card.dataset.stars !== button.dataset.reviewFilter);
            });
        });
    </script>
    BLADE;

    $barVueCode = <<<'VUE'
    <ProductReviewBar
        v-for="row in distribution"
        :key="row.stars"
        :stars="row.stars"
        :count="row.count"
        :percent="row.percent"
        :active="filter === String(row.stars)"
        @select="filter = String(row.stars)"
    />
    VUE;

    $barReactCode = <<<'REACT'
    {distribution.map((row) => (
        <ProductReviewBar
            key={row.stars}
            stars={row.stars}
            count={row.count}
            percent={row.percent}
            active={filter === String(row.stars)}
            onSelect={(stars) => setFilter(String(stars))}
        />
    ))}
    REACT;

    $optionCode = <<<'BLADE'
    <x-templates.product.option-row option="bin" label="Bin hopper, 1.2 kg" :price="84"
        detail="For a bar that runs one roast all day. Swaps in without tools." lead="in stock" />

    <script>
        const render = () => {
            let total = finish === 'jade' ? 1300 : 1180;

            inputs.forEach((input) => {
                const line = root.querySelector('[data-line="' + input.dataset.option + '"]');

                line.classList.toggle('hidden', !input.checked);
                line.classList.toggle('flex', input.checked);

                total += input.checked ? Number(input.dataset.price) : 0;
            });

            root.querySelector('[data-config-total]').textContent = '$' + total.toLocaleString('en-US');
        };
    </script>
    BLADE;

    $optionVueCode = <<<'VUE'
    <ProductOptionRow
        v-for="option in group.options"
        :key="option.option"
        v-model="selected[option.option]"
        :label="option.label"
        :detail="option.detail"
        :price="option.price"
        :included="option.included ?? false"
        :lead="option.lead ?? null"
    />

    <!-- const total = computed(() => options.reduce(
        (sum, option) => sum + (selected[option.option] ? option.price : 0),
        base.value,
    )); -->
    VUE;

    $optionReactCode = <<<'REACT'
    {group.options.map((option) => (
        <ProductOptionRow
            key={option.option}
            label={option.label}
            detail={option.detail}
            price={option.price}
            checked={selected[option.option]}
            included={option.included ?? false}
            lead={option.lead ?? null}
            onChange={(next) => setSelected({ ...selected, [option.option]: next })}
        />
    ))}
    REACT;
@endphp

<x-layout title="Product page template — BLADE-COMPONENTS">
    <div class="mx-auto max-w-6xl px-6 py-16 pb-28">

        <a href="{{ route('templates') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Templates
        </a>

        <div class="rise mt-5 flex flex-wrap items-end justify-between gap-4" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Template</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $template['name'] }}</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    One product, sold properly: <span class="text-zinc-300">NOMAD Supply</span> is a storefront running on the same platform the Pricing template sells.
                    A grinder is a spec sheet, a set of finishes, and a pile of opinions, so these four screens are exactly that.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $template['pages']) }} screens</span>
        </div>

        <nav class="rise sticky top-14 z-30 -mx-6 mt-8 border-y border-white/5 bg-ink-950/85 px-6 py-2.5 backdrop-blur" style="animation-delay: 120ms">
            <ul class="flex flex-wrap items-center gap-1 text-sm">
                @foreach ($screens as $screen)
                    <li>
                        <a href="#{{ $screen['slug'] }}" data-spy-link
                            class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">{{ $screen['name'] }}</a>
                    </li>
                @endforeach
                <li class="ml-auto flex items-center gap-1">
                    <a href="#blocks" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Blocks</a>
                    <a href="#install" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Installation</a>
                </li>
            </ul>
        </nav>

        <section class="mt-10">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Screens</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. Pick a finish anywhere and the price, the SKU, the stock line, and the drawing all move with it.</p>

            <div class="mt-6 flex flex-col gap-10">
                @foreach ($screens as $screen)
                    <x-screen-preview
                        :id="$screen['slug']"
                        data-spy-section
                        class="scroll-mt-32"
                        :title="$screen['name']"
                        :description="$screen['description']"
                        :href="route('templates.screen', [$template['slug'], $screen['slug']])"
                        :panels="$sourcesFor($screen['slug'])">
                        <x-dynamic-component :component="'templates.'.$template['slug'].'.'.$screen['slug']" />
                    </x-screen-preview>
                @endforeach
            </div>
        </section>

        <section id="blocks" data-spy-section class="mt-16 scroll-mt-32">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Blocks</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The parts the four screens are assembled from. Take one, take all of them.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Finish switch" padding="p-8"
                    description="One attribute on the storefront shell. Price, SKU, stock line, and the colour of the drawing are all written as variants of it, so nothing is duplicated in JavaScript."
                    :code="$finishCode" :vue-code="$finishVueCode" :react-code="$finishReactCode">
                    <div class="group/shell flex w-full max-w-md flex-col items-center gap-5" data-finish="graphite">
                        <x-templates.product.finish-picker detailed class="w-full" />

                        <div class="text-center">
                            <p class="text-3xl font-semibold tracking-tight text-cream">
                                <span class="group-data-[finish=jade]/shell:hidden">$1,180</span>
                                <span class="hidden group-data-[finish=jade]/shell:inline">$1,300</span>
                            </p>
                            <p class="mt-2 font-mono text-[11px] text-zinc-600">
                                <span class="hidden group-data-[finish=graphite]/shell:inline">SKU EG83-GRA · 12 in stock, ships tomorrow</span>
                                <span class="hidden group-data-[finish=cream]/shell:inline">SKU EG83-CRM · 4 in stock, ships tomorrow</span>
                                <span class="hidden group-data-[finish=jade]/shell:inline">SKU EG83-JDE · batch 07, charged when it ships</span>
                            </p>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Gallery" padding="p-8"
                    description="Four image slots stacked in one square, switched by a data attribute. Drop a photo into each and the markup does not change — the placeholder carries the crop and the file size it wants."
                    :code="$galleryCode" :vue-code="$galleryVueCode" :react-code="$galleryReactCode">
                    <div class="group/shell w-full max-w-sm" data-finish="graphite">
                        <x-templates.product.gallery />
                    </div>
                </x-demo>

                <x-demo title="Spec row" padding="p-8"
                    description="Label, figure, and the condition the figure was measured under. The condition drops off on narrow screens instead of wrapping into the number."
                    :code="$specCode" :vue-code="$specVueCode" :react-code="$specReactCode">
                    <div class="flex w-full max-w-xl flex-col divide-y divide-white/5 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <x-templates.product.spec-row label="Diameter" value="83 mm flat" note="Italian tool steel" />
                        <x-templates.product.spec-row label="Coating" value="Titanium nitride" note="2,400 HV" />
                        <x-templates.product.spec-row label="Rated life" value="1,400 kg" note="filter roast, 20 g doses" />
                        <x-templates.product.spec-row label="Retention" value="< 0.1 g" note="knocker and anti-static ring" />
                    </div>
                </x-demo>

                <x-demo title="Review distribution" padding="p-8"
                    description="A histogram that is also the filter. Click a row and the list below it narrows to that rating — the bar doubles as the control, so there is no second filter UI to keep in sync."
                    :code="$barCode" :vue-code="$barVueCode" :react-code="$barReactCode">
                    <div class="flex w-full max-w-sm flex-col gap-0.5 rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <x-templates.product.review-bar :stars="5" :count="241" :percent="77" active />
                        <x-templates.product.review-bar :stars="4" :count="48" :percent="15" />
                        <x-templates.product.review-bar :stars="3" :count="14" :percent="5" />
                        <x-templates.product.review-bar :stars="2" :count="6" :percent="2" />
                        <x-templates.product.review-bar :stars="1" :count="3" :percent="1" />
                    </div>
                </x-demo>

                <x-demo title="Add-on row" padding="p-8"
                    description="Each row carries its own price on the input, so the running total is a reduce over the checked boxes rather than a table of prices kept somewhere else."
                    :code="$optionCode" :vue-code="$optionVueCode" :react-code="$optionReactCode">
                    <div class="flex w-full max-w-xl flex-col divide-y divide-white/5 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <x-templates.product.option-row option="demo-hopper" label="Single-dose hopper, 60 g"
                            detail="Bellows lid, 12° cone. The one the grinder is designed around." :price="0" included />
                        <x-templates.product.option-row option="demo-bin" label="Bin hopper, 1.2 kg"
                            detail="For a bar that runs one roast all day. Swaps in without tools." :price="84" lead="in stock" />
                        <x-templates.product.option-row option="demo-shims" label="Alignment shim kit"
                            detail="0.05, 0.1 and 0.2 mm, plus the marker pen method printed on the card." :price="28" checked lead="in stock" />
                    </div>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[['slug' => 'shell', 'name' => 'Storefront shell'], ['slug' => 'gallery', 'name' => 'Gallery'], ['slug' => 'option-row', 'name' => 'Add-on row']]"
            description="Every screen carries its own source under its preview. These three are what all four share — the shell owns the finish, so paste it first."
            :components="['button', 'badge', 'rating', 'input-number', 'accordion', 'separator', 'dropdown', 'checkbox', 'scroll-top']" />
    </div>
</x-layout>
