<script setup>
import { ref } from 'vue';
import SettingsShell from './Shell.vue';
import SettingsSection from './Section.vue';
import SettingsRow from './Row.vue';
import UiAlert from '../../components/ui/feedback/Alert.vue';
import UiBadge from '../../components/ui/data-display/Badge.vue';
import UiButton from '../../components/ui/actions/Button.vue';
import UiProgress from '../../components/ui/feedback/Progress.vue';
import UiSelect from '../../components/ui/forms/Select.vue';
import UiSwitch from '../../components/ui/forms/Switch.vue';
import UiTagsInput from '../../components/ui/forms/TagsInput.vue';

const keys = [
    { name: 'Storefront server', prefix: 'whk_live_9f2c…', scopes: ['orders:write', 'merchants:read'], created: '14 Mar 2026', used: '2m ago', live: true },
    { name: 'Payout worker', prefix: 'whk_live_4a71…', scopes: ['payouts:write'], created: '2 Feb 2026', used: '18m ago', live: true },
    { name: 'Staging seeder', prefix: 'whk_test_c08e…', scopes: ['merchants:write', 'orders:write'], created: '9 Jan 2026', used: '3d ago', live: false },
    { name: 'Legacy importer', prefix: 'whk_live_1b55…', scopes: ['merchants:read'], created: '30 Nov 2025', used: '94d ago', live: true },
];

const hooks = [
    { url: 'https://api.northbeam.com/hooks/wharf', events: ['order.paid', 'order.refunded', 'payout.settled'], rate: 99, last: '12s ago', on: true },
    { url: 'https://ops.northbeam.com/wharf/deploys', events: ['deploy.succeeded', 'deploy.failed'], rate: 96, last: '4m ago', on: true },
    { url: 'https://hooks.zapier.com/wharf/inbound', events: ['merchant.created'], rate: 61, last: '2d ago', on: false },
];

const hookStates = ref(hooks.map((hook) => hook.on));
const allowlist = ref(['203.0.113.0/24', '198.51.100.7']);
const expiry = ref('90 days');
const requestLog = ref(true);
</script>

<template>
    <SettingsShell
        active="API keys"
        title="API keys"
        description="Server credentials for the wharf REST API, the webhooks they trigger, and the limits they run under."
    >
        <template #actions>
            <UiButton variant="secondary" size="sm">API reference</UiButton>
            <UiButton size="sm">Create key</UiButton>
        </template>

        <UiAlert variant="warning" title="Copy the secret now" dismissible>
            <p>This is the only time <span class="font-mono text-zinc-300">Storefront server</span> will be shown in full. Store it in your secret manager — we keep a hash, not the key.</p>

            <div class="mt-3 flex items-center gap-2 rounded-lg border border-white/10 bg-ink-950 px-3 py-2">
                <span class="min-w-0 flex-1 truncate font-mono text-[12px] text-zinc-300">whk_live_9f2c41b7d0e83a5c6f19b2470dd8e1a3</span>
                <button type="button" class="shrink-0 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Copy</button>
            </div>
        </UiAlert>

        <SettingsSection flush heading="Keys" description="Scoped per environment. A revoked key stops working on the next request.">
            <template #actions>
                <span class="font-mono text-[11px] text-zinc-600">4 of 20 used</span>
            </template>

            <ul class="divide-y divide-white/5">
                <li v-for="key in keys" :key="key.prefix" class="flex flex-wrap items-center gap-x-4 gap-y-2.5 px-5 py-3.5">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <p class="truncate text-[13px] text-zinc-200">{{ key.name }}</p>
                            <span
                                class="shrink-0 rounded-full px-1.5 font-mono text-[10px]"
                                :class="key.live ? 'bg-jade-500/15 text-jade-400' : 'bg-white/8 text-zinc-500'"
                            >{{ key.live ? 'live' : 'test' }}</span>
                        </div>
                        <p class="mt-1 truncate font-mono text-[11px] text-zinc-600">{{ key.prefix }} · created {{ key.created }}</p>
                    </div>

                    <div class="flex flex-wrap gap-1.5">
                        <span v-for="scope in key.scopes" :key="scope" class="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{{ scope }}</span>
                    </div>

                    <span class="w-20 shrink-0 text-right font-mono text-[11px]" :class="key.used === '94d ago' ? 'text-amber-400' : 'text-zinc-600'">{{ key.used }}</span>

                    <button type="button" class="shrink-0 text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Revoke</button>
                </li>
            </ul>

            <template #footer>
                <span class="text-[11px]/5 text-zinc-600">Legacy importer hasn't been used in 94 days. Idle keys are the ones that leak.</span>
                <UiButton variant="danger" size="sm">Rotate all</UiButton>
            </template>
        </SettingsSection>

        <SettingsSection flush heading="Webhook endpoints" description="Delivery is retried for 24 hours, then the endpoint is paused.">
            <template #actions>
                <UiButton variant="secondary" size="sm">Add endpoint</UiButton>
            </template>

            <ul class="divide-y divide-white/5">
                <li v-for="(hook, index) in hooks" :key="hook.url" class="px-5 py-4">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                        <p class="min-w-0 flex-1 truncate font-mono text-[13px] text-zinc-300">{{ hook.url }}</p>
                        <span class="shrink-0 font-mono text-[11px] text-zinc-600">last {{ hook.last }}</span>
                        <UiSwitch v-model="hookStates[index]" size="sm" />
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-1.5">
                        <span v-for="event in hook.events" :key="event" class="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{{ event }}</span>
                    </div>

                    <UiProgress size="sm" class="mt-3" animate :delay="index * 110" :value="hook.rate" label="Delivered · last 7 days" />
                </li>
            </ul>

            <template #footer>
                <span class="font-mono text-[11px] text-zinc-600">Signing secret whsec_2f…9c</span>
                <a href="#" class="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Roll secret</a>
            </template>
        </SettingsSection>

        <SettingsSection heading="Limits" description="Set by the Scale plan. Enterprise lifts them per key.">
            <SettingsRow label="Rate limit" description="Burst of 2,000 over 10 seconds" align="center">
                <div class="flex items-center gap-3">
                    <span class="font-mono text-[13px] text-zinc-300">1,000 req / min</span>
                    <UiBadge variant="outline" class="ml-auto">Plan limit</UiBadge>
                </div>
            </SettingsRow>

            <SettingsRow label="IP allowlist" description="Empty means any address">
                <UiTagsInput v-model="allowlist" class="w-full! max-w-md" placeholder="Add CIDR…" />
            </SettingsRow>

            <SettingsRow label="Key expiry" description="Keys stop working after this window" align="center">
                <UiSelect v-model="expiry" size="sm" class="max-w-xs" :options="['30 days', '90 days', '180 days', 'Never']" />
            </SettingsRow>

            <SettingsRow label="Log requests" description="Headers and status, never bodies" align="center">
                <div class="flex items-center gap-3">
                    <span class="text-[13px] text-zinc-500">Retained 30 days</span>
                    <UiSwitch v-model="requestLog" class="ml-auto" />
                </div>
            </SettingsRow>
        </SettingsSection>
    </SettingsShell>
</template>
