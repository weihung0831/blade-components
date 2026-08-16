@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/settings/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/settings/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/settings/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $navCode = <<<'BLADE'
    <nav class="flex w-56 shrink-0 flex-col gap-0.5 border-r border-white/5 p-4">
        @foreach ($sections as $section)
            <p @class(['px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase', 'pt-4' => ! $loop->first])>{{ $section['label'] }}</p>

            @foreach ($section['items'] as $item)
                <a href="{{ $item['href'] }}" @class([
                    'flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150',
                    'bg-jade-500/12 text-jade-300' => $item['active'],
                    'text-zinc-400 hover:bg-white/5 hover:text-cream' => ! $item['active'],
                ])>
                    <span class="truncate">{{ $item['label'] }}</span>
                    @isset($item['meta'])
                        <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ $item['meta'] }}</span>
                    @endisset
                </a>
            @endforeach
        @endforeach
    </nav>
    BLADE;

    $navVueCode = <<<'VUE'
    <nav class="flex w-56 shrink-0 flex-col gap-0.5 border-r border-white/5 p-4">
        <template v-for="(section, index) in sections" :key="section.label">
            <p class="px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase" :class="index > 0 && 'pt-4'">{{ section.label }}</p>

            <a
                v-for="item in section.items"
                :key="item.label"
                :href="item.href"
                class="flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150"
                :class="item.active ? 'bg-jade-500/12 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'"
            >
                <span class="truncate">{{ item.label }}</span>
                <span v-if="item.meta" class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ item.meta }}</span>
            </a>
        </template>
    </nav>
    VUE;

    $navReactCode = <<<'REACT'
    <nav className="flex w-56 shrink-0 flex-col gap-0.5 border-r border-white/5 p-4">
        {sections.map((section, index) => (
            <div key={section.label} className="contents">
                <p className={`px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase ${index > 0 ? 'pt-4' : ''}`}>{section.label}</p>

                {section.items.map((item) => (
                    <a
                        key={item.label}
                        href={item.href}
                        className={`flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 ${item.active ? 'bg-jade-500/12 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'}`}
                    >
                        <span className="truncate">{item.label}</span>
                        {item.meta && <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{item.meta}</span>}
                    </a>
                ))}
            </div>
        ))}
    </nav>
    REACT;

    $rowCode = <<<'BLADE'
    <x-templates.settings.row label="Two-factor" description="Required by workspace policy" align="center">
        <div class="flex items-center gap-3">
            <x-ui.badge color="jade" class="py-0.5">Authenticator app</x-ui.badge>
            <span class="text-[13px] text-zinc-500">1Password · added 14 Mar</span>
            <x-ui.button variant="secondary" size="sm" class="ml-auto">Manage</x-ui.button>
        </div>
    </x-templates.settings.row>
    BLADE;

    $rowVueCode = <<<'VUE'
    <SettingsRow label="Two-factor" description="Required by workspace policy" align="center">
        <div class="flex items-center gap-3">
            <UiBadge color="jade" class="py-0.5">Authenticator app</UiBadge>
            <span class="text-[13px] text-zinc-500">1Password · added 14 Mar</span>
            <UiButton variant="secondary" size="sm" class="ml-auto">Manage</UiButton>
        </div>
    </SettingsRow>
    VUE;

    $rowReactCode = <<<'REACT'
    <SettingsRow label="Two-factor" description="Required by workspace policy" align="center">
        <div className="flex items-center gap-3">
            <UiBadge color="jade" className="py-0.5">Authenticator app</UiBadge>
            <span className="text-[13px] text-zinc-500">1Password · added 14 Mar</span>
            <UiButton variant="secondary" size="sm" className="ml-auto">Manage</UiButton>
        </div>
    </SettingsRow>
    REACT;

    $sectionCode = <<<'BLADE'
    <x-templates.settings.section heading="Identity" description="What teammates see next to your commits and deploys.">
        <x-templates.settings.row label="Full name">
            <x-ui.input size="sm" name="name" value="Wei Hung" class="max-w-xs" />
        </x-templates.settings.row>

        <x-templates.settings.row label="Language">
            <x-ui.select size="sm" name="locale" value="English" class="max-w-xs" :options="['English', '繁體中文']" />
        </x-templates.settings.row>

        <x-slot:footer>
            <span class="font-mono text-[11px] text-zinc-600">Shared with 3 workspaces</span>
            <a href="#" class="font-mono text-[11px] text-jade-400 hover:text-jade-300">Export account data</a>
        </x-slot>
    </x-templates.settings.section>
    BLADE;

    $sectionVueCode = <<<'VUE'
    <SettingsSection heading="Identity" description="What teammates see next to your commits and deploys.">
        <SettingsRow label="Full name">
            <UiInput size="sm" name="name" value="Wei Hung" class="max-w-xs" />
        </SettingsRow>

        <SettingsRow label="Language">
            <UiSelect v-model="locale" size="sm" class="max-w-xs" :options="['English', '繁體中文']" />
        </SettingsRow>

        <template #footer>
            <span class="font-mono text-[11px] text-zinc-600">Shared with 3 workspaces</span>
            <a href="#" class="font-mono text-[11px] text-jade-400 hover:text-jade-300">Export account data</a>
        </template>
    </SettingsSection>
    VUE;

    $sectionReactCode = <<<'REACT'
    <SettingsSection
        heading="Identity"
        description="What teammates see next to your commits and deploys."
        footer={
            <>
                <span className="font-mono text-[11px] text-zinc-600">Shared with 3 workspaces</span>
                <a href="#" className="font-mono text-[11px] text-jade-400 hover:text-jade-300">Export account data</a>
            </>
        }
    >
        <SettingsRow label="Full name">
            <UiInput size="sm" name="name" defaultValue="Wei Hung" className="max-w-xs" />
        </SettingsRow>

        <SettingsRow label="Language">
            <UiSelect size="sm" value={locale} onChange={setLocale} className="max-w-xs" options={['English', '繁體中文']} />
        </SettingsRow>
    </SettingsSection>
    REACT;

    $saveBarCode = <<<'BLADE'
    <div class="sticky bottom-0 z-10 flex flex-wrap items-center gap-x-3 gap-y-2 rounded-xl border border-jade-500/25 bg-ink-900/95 px-4 py-3 backdrop-blur">
        <span class="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
        <p class="text-[13px] text-zinc-200">Unsaved changes</p>
        <p class="font-mono text-[11px] text-zinc-600">applies to every workspace you belong to</p>

        <div class="ml-auto flex shrink-0 items-center gap-2">
            <x-ui.button variant="ghost" size="sm">Reset</x-ui.button>
            <x-ui.button size="sm">Save changes</x-ui.button>
        </div>
    </div>
    BLADE;

    $saveBarVueCode = <<<'VUE'
    <div class="sticky bottom-0 z-10 flex flex-wrap items-center gap-x-3 gap-y-2 rounded-xl border border-jade-500/25 bg-ink-900/95 px-4 py-3 backdrop-blur">
        <span class="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
        <p class="text-[13px] text-zinc-200">Unsaved changes</p>
        <p class="font-mono text-[11px] text-zinc-600">applies to every workspace you belong to</p>

        <div class="ml-auto flex shrink-0 items-center gap-2">
            <UiButton variant="ghost" size="sm">Reset</UiButton>
            <UiButton size="sm">Save changes</UiButton>
        </div>
    </div>
    VUE;

    $saveBarReactCode = <<<'REACT'
    <div className="sticky bottom-0 z-10 flex flex-wrap items-center gap-x-3 gap-y-2 rounded-xl border border-jade-500/25 bg-ink-900/95 px-4 py-3 backdrop-blur">
        <span className="size-1.5 shrink-0 rounded-full bg-jade-400" />
        <p className="text-[13px] text-zinc-200">Unsaved changes</p>
        <p className="font-mono text-[11px] text-zinc-600">applies to every workspace you belong to</p>

        <div className="ml-auto flex shrink-0 items-center gap-2">
            <UiButton variant="ghost" size="sm">Reset</UiButton>
            <UiButton size="sm">Save changes</UiButton>
        </div>
    </div>
    REACT;

    $seatCode = <<<'BLADE'
    <x-ui.progress :value="312" :max="400" animate label="312 of 400 seats in use" />

    <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach ($facts as $fact)
            <div>
                <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $fact['label'] }}</p>
                <p class="mt-1 font-mono text-sm {{ $fact['tone'] }}">{{ $fact['value'] }}</p>
            </div>
        @endforeach
    </div>
    BLADE;

    $seatVueCode = <<<'VUE'
    <UiProgress :value="312" :max="400" animate label="312 of 400 seats in use" />

    <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div v-for="fact in facts" :key="fact.label">
            <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ fact.label }}</p>
            <p class="mt-1 font-mono text-sm" :class="fact.tone">{{ fact.value }}</p>
        </div>
    </div>
    VUE;

    $seatReactCode = <<<'REACT'
    <UiProgress value={312} max={400} animate label="312 of 400 seats in use" />

    <div className="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4">
        {facts.map((fact) => (
            <div key={fact.label}>
                <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{fact.label}</p>
                <p className={`mt-1 font-mono text-sm ${fact.tone}`}>{fact.value}</p>
            </div>
        ))}
    </div>
    REACT;

    $secretCode = <<<'BLADE'
    <x-ui.alert variant="warning" title="Copy the secret now" dismissible>
        <p>This is the only time <span class="font-mono text-zinc-300">Storefront server</span> will be shown in full. We keep a hash, not the key.</p>

        <div class="mt-3 flex items-center gap-2 rounded-lg border border-white/10 bg-ink-950 px-3 py-2">
            <span class="min-w-0 flex-1 truncate font-mono text-[12px] text-zinc-300">whk_live_9f2c41b7d0e83a5c6f19b2470dd8e1a3</span>
            <button type="button" class="shrink-0 font-mono text-[11px] text-jade-400 hover:text-jade-300">Copy</button>
        </div>
    </x-ui.alert>
    BLADE;

    $secretVueCode = <<<'VUE'
    <UiAlert variant="warning" title="Copy the secret now" dismissible>
        <p>This is the only time <span class="font-mono text-zinc-300">Storefront server</span> will be shown in full. We keep a hash, not the key.</p>

        <div class="mt-3 flex items-center gap-2 rounded-lg border border-white/10 bg-ink-950 px-3 py-2">
            <span class="min-w-0 flex-1 truncate font-mono text-[12px] text-zinc-300">whk_live_9f2c41b7d0e83a5c6f19b2470dd8e1a3</span>
            <button type="button" class="shrink-0 font-mono text-[11px] text-jade-400 hover:text-jade-300">Copy</button>
        </div>
    </UiAlert>
    VUE;

    $secretReactCode = <<<'REACT'
    <UiAlert variant="warning" title="Copy the secret now" dismissible>
        <p>This is the only time <span className="font-mono text-zinc-300">Storefront server</span> will be shown in full. We keep a hash, not the key.</p>

        <div className="mt-3 flex items-center gap-2 rounded-lg border border-white/10 bg-ink-950 px-3 py-2">
            <span className="min-w-0 flex-1 truncate font-mono text-[12px] text-zinc-300">whk_live_9f2c41b7d0e83a5c6f19b2470dd8e1a3</span>
            <button type="button" className="shrink-0 font-mono text-[11px] text-jade-400 hover:text-jade-300">Copy</button>
        </div>
    </UiAlert>
    REACT;

    $dangerCode = <<<'BLADE'
    <x-templates.settings.section tone="danger" heading="Danger zone"
        description="Both actions are queued, not instant — you get 24 hours to change your mind.">
        <x-templates.settings.row label="Leave workspace" description="You hold the only owner seat" align="center">
            <div class="flex items-center gap-3">
                <span class="text-[13px] text-zinc-500">Transfer ownership first</span>
                <x-ui.button variant="secondary" size="sm" class="ml-auto" disabled>Leave</x-ui.button>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="Delete account" description="Removes you from all 3 workspaces" align="center">
            <div class="flex items-center gap-3">
                <span class="text-[13px] text-zinc-500">Data purged after 30 days</span>
                <x-ui.button variant="danger" size="sm" class="ml-auto">Delete account</x-ui.button>
            </div>
        </x-templates.settings.row>
    </x-templates.settings.section>
    BLADE;

    $dangerVueCode = <<<'VUE'
    <SettingsSection tone="danger" heading="Danger zone"
        description="Both actions are queued, not instant — you get 24 hours to change your mind.">
        <SettingsRow label="Leave workspace" description="You hold the only owner seat" align="center">
            <div class="flex items-center gap-3">
                <span class="text-[13px] text-zinc-500">Transfer ownership first</span>
                <UiButton variant="secondary" size="sm" class="ml-auto" disabled>Leave</UiButton>
            </div>
        </SettingsRow>

        <SettingsRow label="Delete account" description="Removes you from all 3 workspaces" align="center">
            <div class="flex items-center gap-3">
                <span class="text-[13px] text-zinc-500">Data purged after 30 days</span>
                <UiButton variant="danger" size="sm" class="ml-auto">Delete account</UiButton>
            </div>
        </SettingsRow>
    </SettingsSection>
    VUE;

    $dangerReactCode = <<<'REACT'
    <SettingsSection tone="danger" heading="Danger zone"
        description="Both actions are queued, not instant — you get 24 hours to change your mind.">
        <SettingsRow label="Leave workspace" description="You hold the only owner seat" align="center">
            <div className="flex items-center gap-3">
                <span className="text-[13px] text-zinc-500">Transfer ownership first</span>
                <UiButton variant="secondary" size="sm" className="ml-auto" disabled>Leave</UiButton>
            </div>
        </SettingsRow>

        <SettingsRow label="Delete account" description="Removes you from all 3 workspaces" align="center">
            <div className="flex items-center gap-3">
                <span className="text-[13px] text-zinc-500">Data purged after 30 days</span>
                <UiButton variant="danger" size="sm" className="ml-auto">Delete account</UiButton>
            </div>
        </SettingsRow>
    </SettingsSection>
    REACT;

    $navPreview = [
        ['label' => 'Personal', 'items' => [
            ['label' => 'Profile', 'active' => true],
            ['label' => 'Notifications'],
            ['label' => 'Appearance'],
        ]],
        ['label' => 'Workspace', 'items' => [
            ['label' => 'General'],
            ['label' => 'Team', 'meta' => '312'],
            ['label' => 'Billing'],
            ['label' => 'API keys'],
        ]],
    ];

    $facts = [
        ['label' => 'Per seat', 'value' => '$12 / mo', 'tone' => 'text-cream'],
        ['label' => 'Added this cycle', 'value' => '+18', 'tone' => 'text-jade-400'],
        ['label' => 'Idle 30 days', 'value' => '24', 'tone' => 'text-amber-400'],
        ['label' => 'Next invoice', 'value' => '$3,744', 'tone' => 'text-cream'],
    ];
@endphp

<x-layout title="Settings template — BLADE-COMPONENTS">
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
                    The admin side of <span class="text-zinc-300">wharf</span>, the same fictional platform the Dashboard and Auth templates run.
                    Four panels covering what a tenant actually configures — the account, the seats it pays for, the invoice, and the keys.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. The section nav inside each screen moves between the other three.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The parts those panels are assembled from. Take one, take all of them.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Section nav" padding="p-8"
                    description="Two groups, a slot for a count on the right, and one active state. It is the spine of every settings area."
                    :code="$navCode" :vue-code="$navVueCode" :react-code="$navReactCode">
                    <nav class="flex w-56 shrink-0 flex-col gap-0.5 rounded-xl border border-white/8 bg-ink-950 p-4">
                        @foreach ($navPreview as $section)
                            <p @class(['px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase', 'pt-4' => ! $loop->first])>{{ $section['label'] }}</p>

                            @foreach ($section['items'] as $item)
                                <a href="#" @class([
                                    'flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150',
                                    'bg-jade-500/12 text-jade-300' => $item['active'] ?? false,
                                    'text-zinc-400 hover:bg-white/5 hover:text-cream' => ! ($item['active'] ?? false),
                                ])>
                                    <span class="truncate">{{ $item['label'] }}</span>
                                    @isset($item['meta'])
                                        <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ $item['meta'] }}</span>
                                    @endisset
                                </a>
                            @endforeach
                        @endforeach
                    </nav>
                </x-demo>

                <x-demo title="Setting row" padding="p-8"
                    description="Label and reason on the left, control on the right. Every panel on every screen is a stack of these."
                    :code="$rowCode" :vue-code="$rowVueCode" :react-code="$rowReactCode">
                    <div class="w-full max-w-xl rounded-xl border border-white/8 bg-ink-950 px-5">
                        <x-templates.settings.row label="Two-factor" description="Required by workspace policy" align="center">
                            <div class="flex items-center gap-3">
                                <x-ui.badge color="jade" class="py-0.5">Authenticator app</x-ui.badge>
                                <span class="text-[13px] text-zinc-500">1Password · added 14 Mar</span>
                                <x-ui.button variant="secondary" size="sm" class="ml-auto">Manage</x-ui.button>
                            </div>
                        </x-templates.settings.row>
                    </div>
                </x-demo>

                <x-demo title="Section card" padding="p-8"
                    description="Heading, one line saying why the setting exists, rows divided down the middle, and a footer for the fine print."
                    :code="$sectionCode" :vue-code="$sectionVueCode" :react-code="$sectionReactCode">
                    <x-templates.settings.section class="w-full max-w-xl" heading="Identity" description="What teammates see next to your commits and deploys.">
                        <x-templates.settings.row label="Full name">
                            <x-ui.input size="sm" name="block-name" value="Wei Hung" class="max-w-xs" />
                        </x-templates.settings.row>

                        <x-templates.settings.row label="Language">
                            <x-ui.select size="sm" name="block-locale" value="English" class="max-w-xs" :options="['English', '繁體中文']" />
                        </x-templates.settings.row>

                        <x-slot:footer>
                            <span class="font-mono text-[11px] text-zinc-600">Shared with 3 workspaces</span>
                            <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Export account data</a>
                        </x-slot>
                    </x-templates.settings.section>
                </x-demo>

                <x-demo title="Save bar" padding="p-8"
                    description="Settings screens save on submit, not on change. The bar sticks to the bottom of the scroll area until you deal with it."
                    :code="$saveBarCode" :vue-code="$saveBarVueCode" :react-code="$saveBarReactCode">
                    <div class="flex w-full max-w-xl flex-wrap items-center gap-x-3 gap-y-2 rounded-xl border border-jade-500/25 bg-ink-900/95 px-4 py-3">
                        <span class="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                        <p class="text-[13px] text-zinc-200">Unsaved changes</p>
                        <p class="font-mono text-[11px] text-zinc-600">applies to every workspace you belong to</p>

                        <div class="ml-auto flex shrink-0 items-center gap-2">
                            <x-ui.button variant="ghost" size="sm">Reset</x-ui.button>
                            <x-ui.button size="sm">Save changes</x-ui.button>
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Seat meter" padding="p-8"
                    description="Seats are the unit a per-seat plan bills on. Show the limit, what a new one costs, and what the next invoice becomes."
                    :code="$seatCode" :vue-code="$seatVueCode" :react-code="$seatReactCode">
                    <div class="w-full max-w-xl rounded-xl border border-white/8 bg-ink-950 p-5">
                        <x-ui.progress :value="312" :max="400" animate label="312 of 400 seats in use" />

                        <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4">
                            @foreach ($facts as $fact)
                                <div>
                                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $fact['label'] }}</p>
                                    <p class="mt-1 font-mono text-sm {{ $fact['tone'] }}">{{ $fact['value'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-demo>

                <x-demo title="One-time secret" padding="p-8"
                    description="A key is readable once. Say so plainly, put it in a row that can be copied, and let the alert be dismissed."
                    :code="$secretCode" :vue-code="$secretVueCode" :react-code="$secretReactCode">
                    <div class="w-full max-w-xl">
                        <x-ui.alert variant="warning" title="Copy the secret now" dismissible>
                            <p>This is the only time <span class="font-mono text-zinc-300">Storefront server</span> will be shown in full. We keep a hash, not the key.</p>

                            <div class="mt-3 flex items-center gap-2 rounded-lg border border-white/10 bg-ink-950 px-3 py-2">
                                <span class="min-w-0 flex-1 truncate font-mono text-[12px] text-zinc-300">whk_live_9f2c41b7d0e83a5c6f19b2470dd8e1a3</span>
                                <button type="button" class="shrink-0 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Copy</button>
                            </div>
                        </x-ui.alert>
                    </div>
                </x-demo>

                <x-demo title="Danger zone" padding="p-8"
                    description="Same row, red border, and a sentence saying what happens after the click. Nothing here should be a surprise."
                    :code="$dangerCode" :vue-code="$dangerVueCode" :react-code="$dangerReactCode">
                    <x-templates.settings.section class="w-full max-w-xl" tone="danger" heading="Danger zone"
                        description="Both actions are queued, not instant — you get 24 hours to change your mind.">
                        <x-templates.settings.row label="Leave workspace" description="You hold the only owner seat" align="center">
                            <div class="flex items-center gap-3">
                                <span class="text-[13px] text-zinc-500">Transfer ownership first</span>
                                <x-ui.button variant="secondary" size="sm" class="ml-auto" disabled>Leave</x-ui.button>
                            </div>
                        </x-templates.settings.row>

                        <x-templates.settings.row label="Delete account" description="Removes you from all 3 workspaces" align="center">
                            <div class="flex items-center gap-3">
                                <span class="text-[13px] text-zinc-500">Data purged after 30 days</span>
                                <x-ui.button variant="danger" size="sm" class="ml-auto">Delete account</x-ui.button>
                            </div>
                        </x-templates.settings.row>
                    </x-templates.settings.section>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[['slug' => 'shell', 'name' => 'Settings shell'], ['slug' => 'section', 'name' => 'Section card'], ['slug' => 'row', 'name' => 'Setting row']]"
            description="Each screen above carries its own source under its preview. These three files are what all four share — paste them first."
            :components="['badge', 'button', 'icon-button', 'input', 'textarea', 'select', 'switch', 'progress', 'separator', 'avatar', 'breadcrumb', 'search', 'pagination', 'table', 'tags-input', 'toggle-button', 'alert']" />
    </div>
</x-layout>
