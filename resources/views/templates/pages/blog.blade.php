@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/blog/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/blog/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/blog/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $demoPost = [
        'title' => 'The 0.05 mm shim that closed a five-year complaint',
        'excerpt' => 'People kept saying the grind wandered after a week. It did. The fix cost less than the packaging it came in.',
        'topic' => 'Workshop',
        'date' => '15 Jul 2026',
        'read' => 9,
        'author' => 'Mei Tsai',
    ];

    $demoSections = [
        ['id' => 'what-came-back', 'label' => 'What came back'],
        ['id' => 'measuring', 'label' => 'How we measured'],
        ['id' => 'numbers', 'label' => 'The numbers'],
        ['id' => 'tuesday', 'label' => 'Four seats, one Tuesday'],
    ];

    $cardCode = <<<'BLADE'
    <x-templates.blog.post-card
        kicker="Long read"
        title="What 412 returned grinders told us about alignment"
        excerpt="Every unit that came back last year was measured before anyone touched it."
        topic="Machines"
        date="12 Aug 2026"
        :published="20260812"
        :read="14"
        author="Mei Tsai"
        featured />

    {{-- the card writes what the screen filters and sorts on --}}
    <article data-post-card data-topic="Machines" data-read="14" data-published="20260812">
    BLADE;

    $cardVueCode = <<<'VUE'
    <BlogPostCard :post="post" kicker="Long read" featured />

    <BlogPostCard v-for="post in listed" :key="post.title" :post="post" />
    VUE;

    $cardReactCode = <<<'REACT'
    <BlogPostCard post={FEATURED} kicker="Long read" featured />

    {listed.map((post) => <BlogPostCard key={post.title} post={post} />)}
    REACT;

    $filterCode = <<<'BLADE'
    <x-templates.blog.topic-pill value="all" label="Everything" :count="9" checked />
    <x-templates.blog.topic-pill value="Method" label="Method" :count="2" />

    <script>
        const apply = () => {
            const topic = root.dataset.topic;

            cards.forEach((card) => {
                card.classList.toggle('hidden', topic !== 'all' && card.dataset.topic !== topic);
            });

            // sorting is the same list, re-ordered with CSS order
            [...listed]
                .sort((a, b) => Number(b.dataset.published) - Number(a.dataset.published))
                .forEach((card, index) => card.style.order = index);
        };
    </script>
    BLADE;

    $filterVueCode = <<<'VUE'
    const listed = computed(() => posts
        .filter((post) => topic.value === 'all' || post.topic === topic.value)
        .sort((a, b) => (sort.value === 'longest' ? b.read - a.read : b.published - a.published)));
    VUE;

    $filterReactCode = <<<'REACT'
    const listed = POSTS
        .filter((post) => topic === 'all' || post.topic === topic)
        .sort((a, b) => (sort === 'longest' ? b.read - a.read : b.published - a.published));
    REACT;

    $bylineCode = <<<'BLADE'
    <x-templates.blog.byline name="Mei Tsai" role="workshop lead" date="12 Aug 2026" :read="14" />

    <x-templates.blog.byline size="lg" name="Mei Tsai" role="workshop lead"
        bio="Runs the bench in Taichung and signs the card that ships in every box.">
        <div class="mt-3 flex flex-wrap gap-2">
            <a href="#" class="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px]">9 notes</a>
        </div>
    </x-templates.blog.byline>
    BLADE;

    $bylineVueCode = <<<'VUE'
    <BlogByline name="Mei Tsai" role="workshop lead" date="12 Aug 2026" :read="14" />

    <BlogByline size="lg" name="Mei Tsai" role="workshop lead" bio="Runs the bench in Taichung.">
        <div class="mt-3 flex flex-wrap gap-2">…</div>
    </BlogByline>
    VUE;

    $bylineReactCode = <<<'REACT'
    <BlogByline name="Mei Tsai" role="workshop lead" date="12 Aug 2026" read={14} />

    <BlogByline size="lg" name="Mei Tsai" role="workshop lead" bio="Runs the bench in Taichung.">
        <div className="mt-3 flex flex-wrap gap-2">…</div>
    </BlogByline>
    REACT;

    $railCode = <<<'BLADE'
    <x-templates.blog.shell active="Latest" progress>
        <article data-blog-article data-type="m" class="group/read">
            <div data-prose class="text-[15px]/8 group-data-[type=s]/read:text-[13px]/7 group-data-[type=l]/read:text-[17px]/9">
    </x-templates.blog.shell>

    <script>
        // one scroll handler feeds both the bar and the rail
        const travelled = scroller.scrollHeight - scroller.clientHeight;

        bar.style.width = (scroller.scrollTop / travelled) * 100 + '%';

        const line = scroller.scrollTop + scroller.clientHeight * 0.3;
        const current = sections.filter((section) => offsetOf(section) <= line).pop();

        links.forEach((link) => link.toggleAttribute('data-active', link.dataset.tocLink === current.id));
    </script>
    BLADE;

    $railVueCode = <<<'VUE'
    const typeSizes = { s: 'text-[13px]/7', m: 'text-[15px]/8', l: 'text-[17px]/9' };

    const paint = () => {
        const travelled = scroller.scrollHeight - scroller.clientHeight;

        progress.value = travelled > 0 ? Math.min(100, (scroller.scrollTop / travelled) * 100) : 0;

        const line = scroller.scrollTop + scroller.clientHeight * 0.3;
        const passed = sections
            .map((section) => document.getElementById(section.id))
            .filter((element) => element && offsetOf(element) <= line);

        current.value = passed.length > 0 ? passed[passed.length - 1].id : sections[0].id;
    };
    VUE;

    $railReactCode = <<<'REACT'
    useEffect(() => {
        const scroller = document.querySelector('[data-blog-scroll]');

        const paint = () => {
            const travelled = scroller.scrollHeight - scroller.clientHeight;

            setProgress(travelled > 0 ? Math.min(100, (scroller.scrollTop / travelled) * 100) : 0);
        };

        scroller.addEventListener('scroll', paint, { passive: true });
        paint();

        return () => scroller.removeEventListener('scroll', paint);
    }, []);
    REACT;

    $subscribeCode = <<<'BLADE'
    <x-templates.blog.subscribe
        title="Pick how often you hear from the bench"
        note="Same writing either way. The digest holds it until the first Tuesday." />

    <x-templates.blog.subscribe compact :cadence="false" title="Two a month, no more" />
    BLADE;

    $subscribeVueCode = <<<'VUE'
    <BlogSubscribe title="Pick how often you hear from the bench" note="Same writing either way." />

    <BlogSubscribe compact :cadence="false" title="Two a month, no more" />
    VUE;

    $subscribeReactCode = <<<'REACT'
    <BlogSubscribe title="Pick how often you hear from the bench" note="Same writing either way." />

    <BlogSubscribe compact cadence={false} title="Two a month, no more" />
    REACT;
@endphp

<x-layout title="Blog template — BLADE-COMPONENTS">
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
                    A workshop journal for the same shop that sells the grinder in the <span class="text-zinc-300">Product page</span> template.
                    Four screens, 22 notes behind them, and one long read that knows how far down it you are.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. Pick a topic on the index, type in the archive search, or drag the article down and watch the rail keep up.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Five parts, used across all four screens. Every count on this page is worked out from the same list the cards come from.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Post card" padding="p-8"
                    description="One component, two densities. The featured version takes the image slot and the room to breathe; the plain one packs into a two-column grid."
                    :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                    <div class="flex w-full max-w-2xl flex-col gap-4">
                        <x-templates.blog.post-card
                            kicker="Long read"
                            title="What 412 returned grinders told us about alignment"
                            excerpt="Every unit that came back last year was measured before anyone touched it. The burrs were rarely the fault."
                            topic="Machines"
                            date="12 Aug 2026"
                            :published="20260812"
                            :read="14"
                            author="Mei Tsai"
                            featured />

                        <x-templates.blog.post-card
                            :title="$demoPost['title']"
                            :excerpt="$demoPost['excerpt']"
                            :topic="$demoPost['topic']"
                            :date="$demoPost['date']"
                            :read="$demoPost['read']"
                            :author="$demoPost['author']" />
                    </div>
                </x-demo>

                <x-demo title="Topic filter" padding="p-8"
                    description="Radios in a trench coat. The count next to each label comes from the same array the cards do, so a new note changes both or neither."
                    :code="$filterCode" :vue-code="$filterVueCode" :react-code="$filterReactCode">
                    <div class="flex w-full max-w-xl flex-wrap items-center gap-2">
                        <x-templates.blog.topic-pill name="demo-topic" value="all" label="Everything" :count="22" checked />
                        <x-templates.blog.topic-pill name="demo-topic" value="Workshop" label="Workshop" :count="6" />
                        <x-templates.blog.topic-pill name="demo-topic" value="Machines" label="Machines" :count="5" />
                        <x-templates.blog.topic-pill name="demo-topic" value="Supply" label="Supply" :count="6" />
                        <x-templates.blog.topic-pill name="demo-topic" value="Method" label="Method" :count="5" />
                    </div>
                </x-demo>

                <x-demo title="Byline" padding="p-8"
                    description="Initials rather than a stock photograph, because a three-person workshop does not have headshots. The large size carries the bio and whatever you slot under it."
                    :code="$bylineCode" :vue-code="$bylineVueCode" :react-code="$bylineReactCode">
                    <div class="flex w-full max-w-xl flex-col gap-6">
                        <x-templates.blog.byline name="Mei Tsai" role="workshop lead" date="12 Aug 2026" :read="14" />

                        <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <x-templates.blog.byline
                                size="lg"
                                name="Lena Kohler"
                                role="method and testing"
                                bio="Owns the sieve stack and the grinder that has done 340 kg without a clean. Came from a café that ran 14 kg a week.">
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-400">6 notes</span>
                                    <span class="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-600">grind data, brew tests</span>
                                </div>
                            </x-templates.blog.byline>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Reading rail" padding="p-8"
                    description="A contents list, a progress bar in the header, and three type sizes. One scroll handler drives the first two; the third is a data attribute on the article and three utility classes."
                    :code="$railCode" :vue-code="$railVueCode" :react-code="$railReactCode">
                    <div class="flex w-full max-w-xl flex-col gap-5 rounded-xl border border-white/8 bg-ink-950 p-5">
                        <div class="h-px w-full bg-white/5">
                            <span class="block h-px w-2/5 bg-jade-500"></span>
                        </div>

                        <div class="flex flex-wrap items-start justify-between gap-6">
                            <div>
                                <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">On this page</p>
                                <ul class="mt-3 flex flex-col gap-0.5 border-l border-white/8">
                                    @foreach ($demoSections as $section)
                                        <li>
                                            <span @class([
                                                '-ml-px block border-l py-1.5 pl-3 text-[13px]/5',
                                                'border-jade-500 text-jade-300' => $loop->iteration === 2,
                                                'border-transparent text-zinc-600' => $loop->iteration !== 2,
                                            ])>{{ $section['label'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="font-mono text-[10px] text-zinc-600">Type size</span>
                                <div class="flex items-center gap-0.5 rounded-lg bg-ink-900 p-0.5">
                                    @foreach (['S', 'M', 'L'] as $label)
                                        <label class="grid size-7 cursor-pointer place-items-center rounded-md font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/10 has-[:checked]:text-cream">
                                            <input type="radio" name="demo-type" @checked($label === 'M') class="sr-only">
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Subscribe card" padding="p-8"
                    description="Two cadences, one field, and a line about where the list lives. The compact form drops the cadence and fits a sidebar."
                    :code="$subscribeCode" :vue-code="$subscribeVueCode" :react-code="$subscribeReactCode">
                    <div class="w-full max-w-xl">
                        <x-templates.blog.subscribe
                            title="Pick how often you hear from the bench"
                            note="Same writing either way. The digest just holds it until the first Tuesday of the month." />
                    </div>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[
                ['slug' => 'shell', 'name' => 'Blog shell'],
                ['slug' => 'post-card', 'name' => 'Post card'],
                ['slug' => 'byline', 'name' => 'Byline'],
                ['slug' => 'topic-pill', 'name' => 'Topic pill'],
                ['slug' => 'subscribe', 'name' => 'Subscribe card'],
            ]"
            description="Each screen ships its own source under its preview. These five are what all four share — the shell holds the reading progress bar, so paste it first."
            :components="['button', 'scroll-top']" />
    </div>
</x-layout>
