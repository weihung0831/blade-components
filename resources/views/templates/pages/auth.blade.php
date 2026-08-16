@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/auth/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/auth/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/auth/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $events = [
        ['time' => '02:41:08', 'name' => 'auth.session.created', 'meta' => 'ap-1'],
        ['time' => '02:40:55', 'name' => 'sso.saml.asserted', 'meta' => 'northbeam'],
        ['time' => '02:40:12', 'name' => 'device.trusted', 'meta' => '+1'],
        ['time' => '02:38:47', 'name' => 'invite.accepted', 'meta' => 'seat 312'],
    ];

    $scopes = [
        ['label' => 'Deploys', 'detail' => 'Ship to staging on their own, production needs a review'],
        ['label' => 'Merchants', 'detail' => 'Read every tenant, edit the ones assigned to them'],
        ['label' => 'Billing', 'detail' => 'No access — owners and admins only'],
    ];

    $providerCode = <<<'BLADE'
    <x-templates.auth.providers />

    <x-ui.separator label="or" class="my-5" />
    BLADE;

    $providerVueCode = <<<'VUE'
    <AuthProviders />

    <UiSeparator label="or" class="my-5" />
    VUE;

    $providerReactCode = <<<'REACT'
    <AuthProviders />

    <UiSeparator label="or" className="my-5" />
    REACT;

    $fieldsCode = <<<'BLADE'
    <form class="flex flex-col gap-3">
        <x-ui.float-label label="Work email" type="email" name="email" autocomplete="email" />
        <x-ui.float-label label="Password" type="password" name="password" autocomplete="current-password" />

        <div class="mt-0.5 flex items-center justify-between gap-3">
            <x-ui.checkbox label="Keep me signed in" />
            <a href="#" class="shrink-0 text-[13px] text-jade-400 underline-offset-4 hover:text-jade-300 hover:underline">Forgot password?</a>
        </div>

        <x-ui.button class="mt-2 w-full">Sign in</x-ui.button>
    </form>
    BLADE;

    $fieldsVueCode = <<<'VUE'
    <form class="flex flex-col gap-3">
        <UiFloatLabel label="Work email" type="email" name="email" autocomplete="email" />
        <UiFloatLabel label="Password" type="password" name="password" autocomplete="current-password" />

        <div class="mt-0.5 flex items-center justify-between gap-3">
            <UiCheckbox label="Keep me signed in" />
            <a href="#" class="shrink-0 text-[13px] text-jade-400 underline-offset-4 hover:text-jade-300 hover:underline">Forgot password?</a>
        </div>

        <UiButton class="mt-2 w-full">Sign in</UiButton>
    </form>
    VUE;

    $fieldsReactCode = <<<'REACT'
    <form className="flex flex-col gap-3">
        <UiFloatLabel label="Work email" type="email" name="email" autoComplete="email" />
        <UiFloatLabel label="Password" type="password" name="password" autoComplete="current-password" />

        <div className="mt-0.5 flex items-center justify-between gap-3">
            <UiCheckbox label="Keep me signed in" />
            <a href="#" className="shrink-0 text-[13px] text-jade-400 underline-offset-4 hover:text-jade-300 hover:underline">Forgot password?</a>
        </div>

        <UiButton className="mt-2 w-full">Sign in</UiButton>
    </form>
    REACT;

    $workspaceCode = <<<'BLADE'
    <div class="flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-3 py-2.5">
        <x-ui.avatar initials="NB" size="sm" />
        <div class="min-w-0">
            <p class="truncate text-[13px] text-zinc-200">Northbeam Supply</p>
            <p class="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app</p>
        </div>
        <button type="button" class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500 hover:text-cream">Switch</button>
    </div>
    BLADE;

    $workspaceVueCode = <<<'VUE'
    <div class="flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-3 py-2.5">
        <UiAvatar initials="NB" size="sm" />
        <div class="min-w-0">
            <p class="truncate text-[13px] text-zinc-200">Northbeam Supply</p>
            <p class="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app</p>
        </div>
        <button type="button" class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500 hover:text-cream">Switch</button>
    </div>
    VUE;

    $workspaceReactCode = <<<'REACT'
    <div className="flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-3 py-2.5">
        <UiAvatar initials="NB" size="sm" />
        <div className="min-w-0">
            <p className="truncate text-[13px] text-zinc-200">Northbeam Supply</p>
            <p className="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app</p>
        </div>
        <button type="button" className="ml-auto shrink-0 font-mono text-[11px] text-zinc-500 hover:text-cream">Switch</button>
    </div>
    REACT;

    $subdomainCode = <<<'BLADE'
    <x-ui.input-group>
        <input type="text" name="workspace" placeholder="northbeam" autocomplete="off">
        <x-slot:suffix>.wharf.app</x-slot>
    </x-ui.input-group>
    <p class="mt-1.5 font-mono text-[11px] text-zinc-600">Your tenant URL. Owners can move it later.</p>
    BLADE;

    $subdomainVueCode = <<<'VUE'
    <UiInputGroup>
        <input type="text" name="workspace" placeholder="northbeam" autocomplete="off" />
        <template #suffix>.wharf.app</template>
    </UiInputGroup>
    <p class="mt-1.5 font-mono text-[11px] text-zinc-600">Your tenant URL. Owners can move it later.</p>
    VUE;

    $subdomainReactCode = <<<'REACT'
    <UiInputGroup suffix=".wharf.app">
        <input type="text" name="workspace" placeholder="northbeam" autoComplete="off" />
    </UiInputGroup>
    <p className="mt-1.5 font-mono text-[11px] text-zinc-600">Your tenant URL. Owners can move it later.</p>
    REACT;

    $passwordCode = <<<'BLADE'
    <x-ui.password label="Password" meter class="w-full!" />
    BLADE;

    $passwordVueCode = <<<'VUE'
    <UiPassword label="Password" meter class="w-full!" />
    VUE;

    $passwordReactCode = <<<'REACT'
    <UiPassword label="Password" meter className="w-full!" />
    REACT;

    $otpCode = <<<'BLADE'
    <x-ui.alert variant="warning" title="New device">
        Chrome on macOS · Taipei · 203.0.113.42. If this wasn't you, change your password and end every session.
    </x-ui.alert>

    <form class="mt-6">
        <x-ui.input-otp :length="6" label="Authenticator code" />

        <x-ui.checkbox class="mt-5" label="Trust this device for 30 days"
            description="Skips the code until the session or the region changes." />

        <x-ui.button class="mt-5 w-full">Verify and continue</x-ui.button>
    </form>
    BLADE;

    $otpVueCode = <<<'VUE'
    <UiAlert variant="warning" title="New device">
        Chrome on macOS · Taipei · 203.0.113.42. If this wasn't you, change your password and end every session.
    </UiAlert>

    <form class="mt-6">
        <UiInputOtp :length="6" label="Authenticator code" />

        <UiCheckbox class="mt-5" label="Trust this device for 30 days"
            description="Skips the code until the session or the region changes." />

        <UiButton class="mt-5 w-full">Verify and continue</UiButton>
    </form>
    VUE;

    $otpReactCode = <<<'REACT'
    <UiAlert variant="warning" title="New device">
        Chrome on macOS · Taipei · 203.0.113.42. If this wasn't you, change your password and end every session.
    </UiAlert>

    <form className="mt-6">
        <UiInputOtp length={6} label="Authenticator code" />

        <UiCheckbox className="mt-5" label="Trust this device for 30 days"
            description="Skips the code until the session or the region changes." />

        <UiButton className="mt-5 w-full">Verify and continue</UiButton>
    </form>
    REACT;

    $seatCode = <<<'BLADE'
    <div class="rounded-xl border border-white/10 bg-ink-950 p-4">
        <div class="flex items-center gap-3">
            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-jade-500 font-mono text-xs font-bold text-ink-950">NB</span>
            <div class="min-w-0">
                <p class="truncate text-sm font-medium text-cream">Northbeam Supply</p>
                <p class="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app · ap-1</p>
            </div>
            <x-ui.badge color="jade" class="ml-auto shrink-0">Developer</x-ui.badge>
        </div>

        <x-ui.separator class="my-4" />

        <x-ui.progress :value="312" :max="400" animate label="Seats · 312/400 on the Scale plan" />

        <p class="mt-2.5 text-[11px]/5 text-zinc-500">Accepting takes seat 313. Billing changes on the next invoice, 1 Sep.</p>
    </div>
    BLADE;

    $seatVueCode = <<<'VUE'
    <div class="rounded-xl border border-white/10 bg-ink-950 p-4">
        <div class="flex items-center gap-3">
            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-jade-500 font-mono text-xs font-bold text-ink-950">NB</span>
            <div class="min-w-0">
                <p class="truncate text-sm font-medium text-cream">Northbeam Supply</p>
                <p class="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app · ap-1</p>
            </div>
            <UiBadge color="jade" class="ml-auto shrink-0">Developer</UiBadge>
        </div>

        <UiSeparator class="my-4" />

        <UiProgress :value="312" :max="400" animate label="Seats · 312/400 on the Scale plan" />

        <p class="mt-2.5 text-[11px]/5 text-zinc-500">Accepting takes seat 313. Billing changes on the next invoice, 1 Sep.</p>
    </div>
    VUE;

    $seatReactCode = <<<'REACT'
    <div className="rounded-xl border border-white/10 bg-ink-950 p-4">
        <div className="flex items-center gap-3">
            <span className="grid size-10 shrink-0 place-items-center rounded-xl bg-jade-500 font-mono text-xs font-bold text-ink-950">NB</span>
            <div className="min-w-0">
                <p className="truncate text-sm font-medium text-cream">Northbeam Supply</p>
                <p className="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app · ap-1</p>
            </div>
            <UiBadge color="jade" className="ml-auto shrink-0">Developer</UiBadge>
        </div>

        <UiSeparator className="my-4" />

        <UiProgress value={312} max={400} animate label="Seats · 312/400 on the Scale plan" />

        <p className="mt-2.5 text-[11px]/5 text-zinc-500">Accepting takes seat 313. Billing changes on the next invoice, 1 Sep.</p>
    </div>
    REACT;

    $logCode = <<<'BLADE'
    <ul class="flex flex-col gap-2 font-mono text-[11px]">
        @foreach ($events as $event)
            <li class="flex items-center gap-3 border-l border-white/8 pl-3">
                <span class="text-zinc-600">{{ $event['time'] }}</span>
                <span class="truncate text-zinc-400">{{ $event['name'] }}</span>
                <span class="ml-auto shrink-0 text-jade-400">{{ $event['meta'] }}</span>
            </li>
        @endforeach
    </ul>
    BLADE;

    $logVueCode = <<<'VUE'
    <ul class="flex flex-col gap-2 font-mono text-[11px]">
        <li v-for="event in events" :key="event.time" class="flex items-center gap-3 border-l border-white/8 pl-3">
            <span class="text-zinc-600">{{ event.time }}</span>
            <span class="truncate text-zinc-400">{{ event.name }}</span>
            <span class="ml-auto shrink-0 text-jade-400">{{ event.meta }}</span>
        </li>
    </ul>
    VUE;

    $logReactCode = <<<'REACT'
    <ul className="flex flex-col gap-2 font-mono text-[11px]">
        {events.map((event) => (
            <li key={event.time} className="flex items-center gap-3 border-l border-white/8 pl-3">
                <span className="text-zinc-600">{event.time}</span>
                <span className="truncate text-zinc-400">{event.name}</span>
                <span className="ml-auto shrink-0 text-jade-400">{event.meta}</span>
            </li>
        ))}
    </ul>
    REACT;
@endphp

<x-layout title="Auth pages template — BLADE-COMPONENTS">
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
                    The front door to <span class="text-zinc-300">wharf</span>, the same fictional platform the Dashboard template runs.
                    Five screens covering the whole way in — SSO, a tenant subdomain, a second factor, and the seat an invite costs.
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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. The links inside each screen go to the next one, so you can walk the flow.</p>

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
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">The parts those screens are assembled from. Take one, take all of them.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Provider row" padding="p-8"
                    description="Two social buttons and the SAML row that B2B plans ask for, with the divider that follows them."
                    :code="$providerCode" :vue-code="$providerVueCode" :react-code="$providerReactCode">
                    <div class="w-full max-w-sm">
                        <x-templates.auth.providers />
                        <x-ui.separator label="or" class="my-5" />
                    </div>
                </x-demo>

                <x-demo title="Credential fields" padding="p-8"
                    description="Float labels leave room for the label without a second line of text. Everything else in the form hangs off them."
                    :code="$fieldsCode" :vue-code="$fieldsVueCode" :react-code="$fieldsReactCode">
                    <form class="flex w-full max-w-sm flex-col gap-3">
                        <x-ui.float-label label="Work email" type="email" name="block-email" autocomplete="email" />
                        <x-ui.float-label label="Password" type="password" name="block-password" autocomplete="current-password" />

                        <div class="mt-0.5 flex items-center justify-between gap-3">
                            <x-ui.checkbox label="Keep me signed in" />
                            <a href="#" class="shrink-0 text-[13px] text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Forgot password?</a>
                        </div>

                        <x-ui.button class="mt-2 w-full">Sign in</x-ui.button>
                    </form>
                </x-demo>

                <x-demo title="Workspace context" padding="p-8"
                    description="Multi-tenant sign-in should say which tenant you are signing into, and let you leave it."
                    :code="$workspaceCode" :vue-code="$workspaceVueCode" :react-code="$workspaceReactCode">
                    <div class="flex w-full max-w-sm items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-3 py-2.5">
                        <x-ui.avatar initials="NB" size="sm" />
                        <div class="min-w-0">
                            <p class="truncate text-[13px] text-zinc-200">Northbeam Supply</p>
                            <p class="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app</p>
                        </div>
                        <button type="button" class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream">Switch</button>
                    </div>
                </x-demo>

                <x-demo title="Tenant subdomain" padding="p-8"
                    description="The field that decides the URL every merchant will see. Suffix addon, so nobody types the domain."
                    :code="$subdomainCode" :vue-code="$subdomainVueCode" :react-code="$subdomainReactCode">
                    <div class="w-full max-w-sm">
                        <x-ui.input-group>
                            <input type="text" name="block-workspace" placeholder="northbeam" autocomplete="off">
                            <x-slot:suffix>.wharf.app</x-slot>
                        </x-ui.input-group>
                        <p class="mt-1.5 font-mono text-[11px] text-zinc-600">Your tenant URL. Owners can move it later.</p>
                    </div>
                </x-demo>

                <x-demo title="Password with meter" padding="p-8"
                    description="Four bars and one line of advice. The score updates as you type, no request involved."
                    :code="$passwordCode" :vue-code="$passwordVueCode" :react-code="$passwordReactCode">
                    <x-ui.password label="Password" meter class="w-full! max-w-sm" />
                </x-demo>

                <x-demo title="One-time code" padding="p-8"
                    description="Paste all six digits into the first cell and they spread across the rest. Backspace walks back."
                    :code="$otpCode" :vue-code="$otpVueCode" :react-code="$otpReactCode">
                    <div class="w-full max-w-sm">
                        <x-ui.alert variant="warning" title="New device">
                            Chrome on macOS · Taipei · 203.0.113.42. If this wasn't you, change your password and end every session.
                        </x-ui.alert>

                        <form class="mt-6">
                            <x-ui.input-otp :length="6" label="Authenticator code" />

                            <x-ui.checkbox class="mt-5" label="Trust this device for 30 days" description="Skips the code until the session or the region changes." />

                            <x-ui.button class="mt-5 w-full">Verify and continue</x-ui.button>
                        </form>
                    </div>
                </x-demo>

                <x-demo title="Seat invite card" padding="p-8"
                    description="An invite is a billing event. Say which seat it takes and when the invoice moves."
                    :code="$seatCode" :vue-code="$seatVueCode" :react-code="$seatReactCode">
                    <div class="w-full max-w-sm rounded-xl border border-white/10 bg-ink-950 p-4">
                        <div class="flex items-center gap-3">
                            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-jade-500 font-mono text-xs font-bold text-ink-950">NB</span>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-cream">Northbeam Supply</p>
                                <p class="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app · ap-1</p>
                            </div>
                            <x-ui.badge color="jade" class="ml-auto shrink-0">Developer</x-ui.badge>
                        </div>

                        <x-ui.separator class="my-4" />

                        <x-ui.progress :value="312" :max="400" animate label="Seats · 312/400 on the Scale plan" />

                        <p class="mt-2.5 text-[11px]/5 text-zinc-500">Accepting takes seat 313. Billing changes on the next invoice, 1 Sep.</p>
                    </div>
                </x-demo>

                <x-demo title="Session log" padding="p-8"
                    description="What fills the left panel. Four lines of real event names beat a stock photo of a laptop."
                    :code="$logCode" :vue-code="$logVueCode" :react-code="$logReactCode">
                    <ul class="flex w-full max-w-sm flex-col gap-2 font-mono text-[11px]">
                        @foreach ($events as $event)
                            <li class="flex items-center gap-3 border-l border-white/8 pl-3">
                                <span class="text-zinc-600">{{ $event['time'] }}</span>
                                <span class="truncate text-zinc-400">{{ $event['name'] }}</span>
                                <span class="ml-auto shrink-0 text-jade-400">{{ $event['meta'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[['slug' => 'shell', 'name' => 'Auth shell'], ['slug' => 'providers', 'name' => 'Provider row']]"
            description="Each screen above carries its own source under its preview. These two files are what all five share — paste them first."
            :components="['float-label', 'input-group', 'password', 'input-otp', 'checkbox', 'button', 'separator', 'alert', 'avatar', 'badge', 'progress']" />
    </div>
</x-layout>
