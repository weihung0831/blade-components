@php
    $sessions = [
        ['device' => 'MacBook Pro · Chrome 128', 'where' => 'Taipei, TW · 203.0.113.42', 'seen' => 'Active now', 'current' => true],
        ['device' => 'iPhone 15 · wharf iOS 2.9', 'where' => 'Taipei, TW · 203.0.113.19', 'seen' => '2h ago', 'current' => false],
        ['device' => 'Windows 11 · Edge 127', 'where' => 'Singapore, SG · 198.51.100.7', 'seen' => '3d ago', 'current' => false],
        ['device' => 'CLI · wharf/2.14.0', 'where' => 'ap-1 runner · 10.24.6.3', 'seen' => '6d ago', 'current' => false],
    ];
@endphp

<x-templates.settings.shell active="Profile" title="Profile" dirty
    description="One account, every workspace you've been invited to. Changes here follow you into all of them.">
    <x-slot:actions>
        <x-ui.badge variant="outline">Owner · Northbeam Supply</x-ui.badge>
        <x-ui.button variant="secondary" size="sm">Switch workspace</x-ui.button>
    </x-slot>

    <x-templates.settings.section heading="Identity" description="What teammates see next to your commits, deploys, and audit entries.">
        <x-templates.settings.row label="Photo" description="PNG or JPG, 2 MB max">
            <div class="flex items-center gap-3">
                <x-ui.avatar initials="WH" size="lg" color="jade" />
                <x-ui.button variant="secondary" size="sm">Upload</x-ui.button>
                <button type="button" class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">Remove</button>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="Full name">
            <x-ui.input size="sm" name="name" value="Wei Hung" class="max-w-xs" />
        </x-templates.settings.row>

        <x-templates.settings.row label="Work email" description="Used for sign-in and every billing receipt">
            <div class="flex flex-wrap items-center gap-2">
                <x-ui.input size="sm" type="email" name="email" value="wei@northbeam.com" class="max-w-xs" />
                <x-ui.badge color="jade" class="py-0.5">Verified</x-ui.badge>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="Time zone" description="Schedules and digests follow it">
            <x-ui.select size="sm" name="timezone" value="Asia/Taipei (UTC+8)" class="max-w-xs"
                :options="['Asia/Taipei (UTC+8)', 'Asia/Singapore (UTC+8)', 'Europe/Berlin (UTC+2)', 'America/Los_Angeles (UTC−7)']" />
        </x-templates.settings.row>

        <x-templates.settings.row label="Language">
            <x-ui.select size="sm" name="locale" value="English" class="max-w-xs"
                :options="['English', '繁體中文', '日本語', 'Deutsch']" />
        </x-templates.settings.row>

        <x-slot:footer>
            <span class="font-mono text-[11px] text-zinc-600">Shared with 3 workspaces</span>
            <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Export account data</a>
        </x-slot>
    </x-templates.settings.section>

    <x-templates.settings.section heading="Password and access" description="Owners are held to the workspace policy — a second factor on every new device.">
        <x-templates.settings.row label="Password" description="Changed 3 months ago" align="center">
            <div class="flex items-center gap-3">
                <span class="font-mono text-[13px] tracking-widest text-zinc-600">••••••••••</span>
                <x-ui.button variant="secondary" size="sm" class="ml-auto">Change</x-ui.button>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="Two-factor" description="Required by workspace policy" align="center">
            <div class="flex items-center gap-3">
                <x-ui.badge color="jade" class="py-0.5">Authenticator app</x-ui.badge>
                <span class="text-[13px] text-zinc-500">1Password · added 14 Mar</span>
                <x-ui.button variant="secondary" size="sm" class="ml-auto">Manage</x-ui.button>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="Recovery codes" description="Single use, keep them offline" align="center">
            <div class="flex items-center gap-3">
                <span class="font-mono text-[13px] text-zinc-400">8 of 10 unused</span>
                <x-ui.button variant="secondary" size="sm" class="ml-auto">Regenerate</x-ui.button>
            </div>
        </x-templates.settings.row>

        <x-templates.settings.row label="Passkeys" description="Skips the code on devices you own" align="center">
            <div class="flex items-center gap-3">
                <span class="text-[13px] text-zinc-500">2 registered</span>
                <x-ui.switch class="ml-auto" name="passkeys" checked />
            </div>
        </x-templates.settings.row>
    </x-templates.settings.section>

    <x-templates.settings.section flush heading="Sessions" description="Anything signed in as you, on any device, in any region.">
        <x-slot:actions>
            <span class="font-mono text-[11px] text-zinc-600">4 active</span>
        </x-slot>

        <ul class="divide-y divide-white/5">
            @foreach ($sessions as $session)
                <li class="flex flex-wrap items-center gap-x-4 gap-y-2 px-5 py-3.5">
                    <span @class(['mt-0.5 size-1.5 shrink-0 rounded-full', 'bg-jade-400' => $session['current'], 'bg-zinc-700' => ! $session['current']])></span>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[13px] text-zinc-200">{{ $session['device'] }}</p>
                        <p class="mt-0.5 truncate font-mono text-[11px] text-zinc-600">{{ $session['where'] }}</p>
                    </div>

                    <span @class(['shrink-0 font-mono text-[11px]', 'text-jade-400' => $session['current'], 'text-zinc-500' => ! $session['current']])>{{ $session['seen'] }}</span>

                    @if ($session['current'])
                        <span class="w-20 shrink-0 text-right font-mono text-[11px] text-zinc-700">this device</span>
                    @else
                        <button type="button" class="w-20 shrink-0 text-right text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Revoke</button>
                    @endif
                </li>
            @endforeach
        </ul>

        <x-slot:footer>
            <span class="text-[11px]/5 text-zinc-600">Sessions expire after 30 days of inactivity, or immediately when SSO revokes the account.</span>
            <x-ui.button variant="danger" size="sm">Sign out everywhere</x-ui.button>
        </x-slot>
    </x-templates.settings.section>

    <x-templates.settings.section tone="danger" heading="Danger zone" description="Both actions are queued, not instant — you get 24 hours to change your mind.">
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
</x-templates.settings.shell>
