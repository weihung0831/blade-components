import { useState } from 'react';
import { SettingsShell } from './Shell';
import { SettingsSection } from './Section';
import { SettingsRow } from './Row';
import { UiAlert } from '../../components/ui/feedback/Alert';
import { UiBadge } from '../../components/ui/data-display/Badge';
import { UiButton } from '../../components/ui/actions/Button';
import { UiProgress } from '../../components/ui/feedback/Progress';
import { UiSelect } from '../../components/ui/forms/Select';
import { UiSwitch } from '../../components/ui/forms/Switch';
import { UiTagsInput } from '../../components/ui/forms/TagsInput';

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

export function SettingsApiKeys() {
    const [expiry, setExpiry] = useState('90 days');

    return (
        <SettingsShell
            active="API keys"
            title="API keys"
            description="Server credentials for the wharf REST API, the webhooks they trigger, and the limits they run under."
            actions={
                <>
                    <UiButton variant="secondary" size="sm">API reference</UiButton>
                    <UiButton size="sm">Create key</UiButton>
                </>
            }
        >
            <UiAlert variant="warning" title="Copy the secret now" dismissible>
                <p>This is the only time <span className="font-mono text-zinc-300">Storefront server</span> will be shown in full. Store it in your secret manager — we keep a hash, not the key.</p>

                <div className="mt-3 flex items-center gap-2 rounded-lg border border-white/10 bg-ink-950 px-3 py-2">
                    <span className="min-w-0 flex-1 truncate font-mono text-[12px] text-zinc-300">whk_live_9f2c41b7d0e83a5c6f19b2470dd8e1a3</span>
                    <button type="button" className="shrink-0 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Copy</button>
                </div>
            </UiAlert>

            <SettingsSection
                flush
                heading="Keys"
                description="Scoped per environment. A revoked key stops working on the next request."
                actions={<span className="font-mono text-[11px] text-zinc-600">4 of 20 used</span>}
                footer={
                    <>
                        <span className="text-[11px]/5 text-zinc-600">Legacy importer hasn't been used in 94 days. Idle keys are the ones that leak.</span>
                        <UiButton variant="danger" size="sm">Rotate all</UiButton>
                    </>
                }
            >
                <ul className="divide-y divide-white/5">
                    {keys.map((key) => (
                        <li key={key.prefix} className="flex flex-wrap items-center gap-x-4 gap-y-2.5 px-5 py-3.5">
                            <div className="min-w-0 flex-1">
                                <div className="flex items-center gap-2">
                                    <p className="truncate text-[13px] text-zinc-200">{key.name}</p>
                                    <span className={`shrink-0 rounded-full px-1.5 font-mono text-[10px] ${key.live ? 'bg-jade-500/15 text-jade-400' : 'bg-white/8 text-zinc-500'}`}>
                                        {key.live ? 'live' : 'test'}
                                    </span>
                                </div>
                                <p className="mt-1 truncate font-mono text-[11px] text-zinc-600">{key.prefix} · created {key.created}</p>
                            </div>

                            <div className="flex flex-wrap gap-1.5">
                                {key.scopes.map((scope) => (
                                    <span key={scope} className="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{scope}</span>
                                ))}
                            </div>

                            <span className={`w-20 shrink-0 text-right font-mono text-[11px] ${key.used === '94d ago' ? 'text-amber-400' : 'text-zinc-600'}`}>{key.used}</span>

                            <button type="button" className="shrink-0 text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Revoke</button>
                        </li>
                    ))}
                </ul>
            </SettingsSection>

            <SettingsSection
                flush
                heading="Webhook endpoints"
                description="Delivery is retried for 24 hours, then the endpoint is paused."
                actions={<UiButton variant="secondary" size="sm">Add endpoint</UiButton>}
                footer={
                    <>
                        <span className="font-mono text-[11px] text-zinc-600">Signing secret whsec_2f…9c</span>
                        <a href="#" className="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Roll secret</a>
                    </>
                }
            >
                <ul className="divide-y divide-white/5">
                    {hooks.map((hook, index) => (
                        <li key={hook.url} className="px-5 py-4">
                            <div className="flex flex-wrap items-center gap-x-4 gap-y-2">
                                <p className="min-w-0 flex-1 truncate font-mono text-[13px] text-zinc-300">{hook.url}</p>
                                <span className="shrink-0 font-mono text-[11px] text-zinc-600">last {hook.last}</span>
                                <UiSwitch size="sm" defaultChecked={hook.on} />
                            </div>

                            <div className="mt-3 flex flex-wrap items-center gap-1.5">
                                {hook.events.map((event) => (
                                    <span key={event} className="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{event}</span>
                                ))}
                            </div>

                            <UiProgress size="sm" className="mt-3" animate delay={index * 110} value={hook.rate} label="Delivered · last 7 days" />
                        </li>
                    ))}
                </ul>
            </SettingsSection>

            <SettingsSection heading="Limits" description="Set by the Scale plan. Enterprise lifts them per key.">
                <SettingsRow label="Rate limit" description="Burst of 2,000 over 10 seconds" align="center">
                    <div className="flex items-center gap-3">
                        <span className="font-mono text-[13px] text-zinc-300">1,000 req / min</span>
                        <UiBadge variant="outline" className="ml-auto">Plan limit</UiBadge>
                    </div>
                </SettingsRow>

                <SettingsRow label="IP allowlist" description="Empty means any address">
                    <UiTagsInput className="w-full! max-w-md" defaultTags={['203.0.113.0/24', '198.51.100.7']} placeholder="Add CIDR…" />
                </SettingsRow>

                <SettingsRow label="Key expiry" description="Keys stop working after this window" align="center">
                    <UiSelect size="sm" value={expiry} onChange={setExpiry} className="max-w-xs" options={['30 days', '90 days', '180 days', 'Never']} />
                </SettingsRow>

                <SettingsRow label="Log requests" description="Headers and status, never bodies" align="center">
                    <div className="flex items-center gap-3">
                        <span className="text-[13px] text-zinc-500">Retained 30 days</span>
                        <UiSwitch className="ml-auto" defaultChecked />
                    </div>
                </SettingsRow>
            </SettingsSection>
        </SettingsShell>
    );
}
