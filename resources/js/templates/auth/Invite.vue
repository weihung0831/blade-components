<script setup>
import AuthShell from './Shell.vue';
import UiBadge from '../../components/ui/data-display/Badge.vue';
import UiSeparator from '../../components/ui/data-display/Separator.vue';
import UiProgress from '../../components/ui/feedback/Progress.vue';
import UiButton from '../../components/ui/actions/Button.vue';

const to = (screen) => `/templates/auth/screens/${screen}`;

const scopes = [
    { label: 'Deploys', detail: 'Ship to staging on their own, production needs a review' },
    { label: 'Merchants', detail: 'Read every tenant, edit the ones assigned to them' },
    { label: 'Billing', detail: 'No access — owners and admins only' },
];
</script>

<template>
    <AuthShell title="Join Northbeam Supply" subtitle="Aiden Lau invited you to the workspace as a developer.">
        <template #action>
            <span class="text-zinc-500">Invite for</span>
            <span class="font-mono text-[11px] text-zinc-400">dana@northbeam.co</span>
        </template>

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

        <ul class="mt-5 flex flex-col gap-3">
            <li v-for="scope in scopes" :key="scope.label" class="flex items-start gap-2.5">
                <svg class="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="m4 8.4 2.6 2.6L12 5.4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <p class="text-[13px]/5 text-zinc-300">
                    {{ scope.label }}
                    <span class="text-zinc-500">— {{ scope.detail }}</span>
                </p>
            </li>
        </ul>

        <div class="mt-6 flex flex-col gap-2">
            <UiButton class="w-full">Accept and join</UiButton>
            <UiButton variant="ghost" class="w-full">Decline</UiButton>
        </div>

        <p class="mt-4 text-center font-mono text-[11px] text-zinc-600">
            Expires 24 Aug ·
            <a :href="to('sign-in')" target="_top" class="text-zinc-500 underline decoration-white/20 underline-offset-4 transition-colors duration-150 hover:text-cream">Use a different account</a>
        </p>
    </AuthShell>
</template>
