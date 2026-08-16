@php
    $to = fn (string $screen): string => route('templates.screen', ['auth', $screen]);
@endphp

<x-templates.auth.shell title="Reset your password" subtitle="We email a one-time link. It works once and expires after 60 minutes.">
    <x-slot:action>
        <span class="text-zinc-500">Remembered it?</span>
        <a href="{{ $to('sign-in') }}" target="_top" class="font-medium text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Sign in</a>
    </x-slot>

    <form class="flex flex-col gap-3">
        <x-ui.float-label label="Work email" type="email" name="email" autocomplete="email" />

        <x-ui.button class="w-full">Email me a link</x-ui.button>
    </form>

    <div class="mt-3 flex items-center justify-between font-mono text-[11px] text-zinc-600">
        <span>Last sent 30s ago to d••••@northbeam.co</span>
        <span class="text-zinc-500">Resend in 00:24</span>
    </div>

    <x-ui.alert variant="warning" title="SSO workspaces reset elsewhere" class="mt-6">
        Northbeam Supply signs in through Okta. Passwords live with your identity provider, so reset them there — this form only covers accounts on wharf's own login.
    </x-ui.alert>

    <div class="mt-6 rounded-xl border border-white/8 bg-ink-950 p-4">
        <p class="text-[13px] font-medium text-cream">Locked out entirely?</p>
        <p class="mt-1 text-xs/5 text-zinc-500">Any owner on the workspace can send a fresh invite or clear your second factor. Support only steps in when every owner is gone.</p>
        <div class="mt-3 flex items-center gap-4 text-[13px]">
            <a href="{{ $to('two-factor') }}" target="_top" class="text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Recover with a code</a>
            <a href="#" class="text-zinc-400 underline-offset-4 transition-colors duration-150 hover:text-cream hover:underline">Contact support</a>
        </div>
    </div>
</x-templates.auth.shell>
