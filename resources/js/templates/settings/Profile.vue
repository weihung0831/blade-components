<script setup>
import { ref } from 'vue';
import SettingsShell from './Shell.vue';
import SettingsSection from './Section.vue';
import SettingsRow from './Row.vue';
import UiAvatar from '../../components/ui/Avatar.vue';
import UiBadge from '../../components/ui/Badge.vue';
import UiButton from '../../components/ui/Button.vue';
import UiInput from '../../components/ui/Input.vue';
import UiSelect from '../../components/ui/Select.vue';
import UiSwitch from '../../components/ui/Switch.vue';

const sessions = [
    { device: 'MacBook Pro · Chrome 128', where: 'Taipei, TW · 203.0.113.42', seen: 'Active now', current: true },
    { device: 'iPhone 15 · wharf iOS 2.9', where: 'Taipei, TW · 203.0.113.19', seen: '2h ago', current: false },
    { device: 'Windows 11 · Edge 127', where: 'Singapore, SG · 198.51.100.7', seen: '3d ago', current: false },
    { device: 'CLI · wharf/2.14.0', where: 'ap-1 runner · 10.24.6.3', seen: '6d ago', current: false },
];

const timezone = ref('Asia/Taipei (UTC+8)');
const locale = ref('English');
const passkeys = ref(true);
</script>

<template>
    <SettingsShell
        active="Profile"
        title="Profile"
        dirty
        description="One account, every workspace you've been invited to. Changes here follow you into all of them."
    >
        <template #actions>
            <UiBadge variant="outline">Owner · Northbeam Supply</UiBadge>
            <UiButton variant="secondary" size="sm">Switch workspace</UiButton>
        </template>

        <SettingsSection heading="Identity" description="What teammates see next to your commits, deploys, and audit entries.">
            <SettingsRow label="Photo" description="PNG or JPG, 2 MB max">
                <div class="flex items-center gap-3">
                    <UiAvatar initials="WH" size="lg" color="jade" />
                    <UiButton variant="secondary" size="sm">Upload</UiButton>
                    <button type="button" class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">Remove</button>
                </div>
            </SettingsRow>

            <SettingsRow label="Full name">
                <UiInput size="sm" name="name" value="Wei Hung" class="max-w-xs" />
            </SettingsRow>

            <SettingsRow label="Work email" description="Used for sign-in and every billing receipt">
                <div class="flex flex-wrap items-center gap-2">
                    <UiInput size="sm" type="email" name="email" value="wei@northbeam.com" class="max-w-xs" />
                    <UiBadge color="jade" class="py-0.5">Verified</UiBadge>
                </div>
            </SettingsRow>

            <SettingsRow label="Time zone" description="Schedules and digests follow it">
                <UiSelect
                    v-model="timezone"
                    size="sm"
                    class="max-w-xs"
                    :options="['Asia/Taipei (UTC+8)', 'Asia/Singapore (UTC+8)', 'Europe/Berlin (UTC+2)', 'America/Los_Angeles (UTC−7)']"
                />
            </SettingsRow>

            <SettingsRow label="Language">
                <UiSelect v-model="locale" size="sm" class="max-w-xs" :options="['English', '繁體中文', '日本語', 'Deutsch']" />
            </SettingsRow>

            <template #footer>
                <span class="font-mono text-[11px] text-zinc-600">Shared with 3 workspaces</span>
                <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Export account data</a>
            </template>
        </SettingsSection>

        <SettingsSection heading="Password and access" description="Owners are held to the workspace policy — a second factor on every new device.">
            <SettingsRow label="Password" description="Changed 3 months ago" align="center">
                <div class="flex items-center gap-3">
                    <span class="font-mono text-[13px] tracking-widest text-zinc-600">••••••••••</span>
                    <UiButton variant="secondary" size="sm" class="ml-auto">Change</UiButton>
                </div>
            </SettingsRow>

            <SettingsRow label="Two-factor" description="Required by workspace policy" align="center">
                <div class="flex items-center gap-3">
                    <UiBadge color="jade" class="py-0.5">Authenticator app</UiBadge>
                    <span class="text-[13px] text-zinc-500">1Password · added 14 Mar</span>
                    <UiButton variant="secondary" size="sm" class="ml-auto">Manage</UiButton>
                </div>
            </SettingsRow>

            <SettingsRow label="Recovery codes" description="Single use, keep them offline" align="center">
                <div class="flex items-center gap-3">
                    <span class="font-mono text-[13px] text-zinc-400">8 of 10 unused</span>
                    <UiButton variant="secondary" size="sm" class="ml-auto">Regenerate</UiButton>
                </div>
            </SettingsRow>

            <SettingsRow label="Passkeys" description="Skips the code on devices you own" align="center">
                <div class="flex items-center gap-3">
                    <span class="text-[13px] text-zinc-500">2 registered</span>
                    <UiSwitch v-model="passkeys" class="ml-auto" />
                </div>
            </SettingsRow>
        </SettingsSection>

        <SettingsSection flush heading="Sessions" description="Anything signed in as you, on any device, in any region.">
            <template #actions>
                <span class="font-mono text-[11px] text-zinc-600">4 active</span>
            </template>

            <ul class="divide-y divide-white/5">
                <li v-for="session in sessions" :key="session.device" class="flex flex-wrap items-center gap-x-4 gap-y-2 px-5 py-3.5">
                    <span class="mt-0.5 size-1.5 shrink-0 rounded-full" :class="session.current ? 'bg-jade-400' : 'bg-zinc-700'"></span>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[13px] text-zinc-200">{{ session.device }}</p>
                        <p class="mt-0.5 truncate font-mono text-[11px] text-zinc-600">{{ session.where }}</p>
                    </div>

                    <span class="shrink-0 font-mono text-[11px]" :class="session.current ? 'text-jade-400' : 'text-zinc-500'">{{ session.seen }}</span>

                    <span v-if="session.current" class="w-20 shrink-0 text-right font-mono text-[11px] text-zinc-700">this device</span>
                    <button v-else type="button" class="w-20 shrink-0 text-right text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Revoke</button>
                </li>
            </ul>

            <template #footer>
                <span class="text-[11px]/5 text-zinc-600">Sessions expire after 30 days of inactivity, or immediately when SSO revokes the account.</span>
                <UiButton variant="danger" size="sm">Sign out everywhere</UiButton>
            </template>
        </SettingsSection>

        <SettingsSection tone="danger" heading="Danger zone" description="Both actions are queued, not instant — you get 24 hours to change your mind.">
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
    </SettingsShell>
</template>
