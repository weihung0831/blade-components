@php
    $to = fn (string $screen): string => route('templates.screen', ['auth', $screen]);
@endphp

<x-templates.auth.shell title="Sign in to wharf" subtitle="Your account works across every workspace you've been invited to.">
    <x-slot:action>
        <span class="text-zinc-500">No account?</span>
        <a href="{{ $to('sign-up') }}" target="_top" class="font-medium text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Start a trial</a>
    </x-slot>

    <div class="flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-3 py-2.5">
        <x-ui.avatar initials="NB" size="sm" />
        <div class="min-w-0">
            <p class="truncate text-[13px] text-zinc-200">Northbeam Supply</p>
            <p class="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app</p>
        </div>
        <button type="button" class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream">Switch</button>
    </div>

    <x-templates.auth.providers class="mt-4" />

    <x-ui.separator label="or" class="my-5" />

    <form class="flex flex-col gap-3">
        <x-ui.float-label label="Work email" type="email" name="email" autocomplete="email" />
        <x-ui.float-label label="Password" type="password" name="password" autocomplete="current-password" />

        <div class="mt-0.5 flex items-center justify-between gap-3">
            <x-ui.checkbox label="Keep me signed in" />
            <a href="{{ $to('reset') }}" target="_top" class="shrink-0 text-[13px] text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Forgot password?</a>
        </div>

        <x-ui.button class="mt-2 w-full">Sign in</x-ui.button>
    </form>

    <p class="mt-4 text-center font-mono text-[11px] text-zinc-600">
        Owners require a
        <a href="{{ $to('two-factor') }}" target="_top" class="text-zinc-500 underline decoration-white/20 underline-offset-4 transition-colors duration-150 hover:text-cream">second factor</a>
        on new devices
    </p>
</x-templates.auth.shell>
