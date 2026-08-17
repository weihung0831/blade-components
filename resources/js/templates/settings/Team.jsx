import { useState } from 'react';
import { SettingsShell } from './Shell';
import { SettingsSection } from './Section';
import { SettingsRow } from './Row';
import { UiAvatar } from '../../components/ui/data-display/Avatar';
import { UiBadge } from '../../components/ui/data-display/Badge';
import { UiButton } from '../../components/ui/actions/Button';
import { UiIconButton } from '../../components/ui/actions/IconButton';
import { UiPagination } from '../../components/ui/navigation/Pagination';
import { UiProgress } from '../../components/ui/feedback/Progress';
import { UiSearch } from '../../components/ui/forms/Search';
import { UiSelect } from '../../components/ui/forms/Select';
import { UiSwitch } from '../../components/ui/forms/Switch';
import { UiTagsInput } from '../../components/ui/forms/TagsInput';

const members = [
    { name: 'Wei Hung', email: 'wei@northbeam.com', initials: 'WH', role: 'Owner', seen: '2m ago', state: 'active' },
    { name: 'Mira Talbot', email: 'mira@northbeam.com', initials: 'MT', role: 'Admin', seen: '1h ago', state: 'active' },
    { name: 'Dan Okafor', email: 'dan@northbeam.com', initials: 'DO', role: 'Developer', seen: '4h ago', state: 'active' },
    { name: 'Sana Rees', email: 'sana@northbeam.com', initials: 'SR', role: 'Billing', seen: '2d ago', state: 'active' },
    { name: 'Iggy Vance', email: 'iggy@contractor.io', initials: 'IV', role: 'Read-only', seen: '21d ago', state: 'idle' },
];

const invites = [
    { email: 'priya@northbeam.com', role: 'Developer', by: 'Mira Talbot', expires: 'in 5 days' },
    { email: 'lars@northbeam.com', role: 'Admin', by: 'Wei Hung', expires: 'in 6 days' },
    { email: 'ops@halcyon.co', role: 'Read-only', by: 'Dan Okafor', expires: 'tomorrow' },
];

const roles = [
    { name: 'Owner', seats: 1, scopes: ['Billing', 'Members', 'Production', 'API keys', 'Delete workspace'] },
    { name: 'Admin', seats: 4, scopes: ['Members', 'Production', 'API keys'] },
    { name: 'Developer', seats: 286, scopes: ['Staging deploys', 'Merchants', 'Logs'] },
    { name: 'Billing', seats: 2, scopes: ['Invoices', 'Payment method'] },
    { name: 'Read-only', seats: 19, scopes: ['Merchants', 'Logs'] },
];

export function SettingsTeam() {
    const [roleFilter, setRoleFilter] = useState('All roles');
    const [memberRoles, setMemberRoles] = useState(members.map((member) => member.role));
    const [defaultRole, setDefaultRole] = useState('Read-only');

    const setMemberRole = (index, role) => setMemberRoles((current) => current.map((value, position) => (position === index ? role : value)));

    return (
        <SettingsShell
            active="Team"
            title="Team"
            description="Seats are billed monthly and counted the moment an invite is accepted. Roles decide what a seat can reach."
            actions={
                <>
                    <UiButton variant="secondary" size="sm">Buy seats</UiButton>
                    <UiButton size="sm">Invite people</UiButton>
                </>
            }
        >
            <SettingsSection
                flush
                heading="Seats"
                description="Scale plan · 400 licensed seats, renewing 1 Sep."
                actions={<span className="font-mono text-[11px] text-jade-400">88 left</span>}
                footer={
                    <>
                        <span className="text-[11px]/5 text-zinc-600">New seats are prorated to the day. Removing a seat credits the next invoice.</span>
                        <a href="/templates/settings/screens/billing" target="_top" className="font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Open billing</a>
                    </>
                }
            >
                <div className="px-5 py-4">
                    <UiProgress value={312} max={400} animate label="312 of 400 seats in use" />

                    <div className="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4">
                        <div>
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Per seat</p>
                            <p className="mt-1 font-mono text-sm text-cream">$12 / mo</p>
                        </div>
                        <div>
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Added this cycle</p>
                            <p className="mt-1 font-mono text-sm text-jade-400">+18</p>
                        </div>
                        <div>
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Idle 30 days</p>
                            <p className="mt-1 font-mono text-sm text-amber-400">24</p>
                        </div>
                        <div>
                            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Next invoice</p>
                            <p className="mt-1 font-mono text-sm text-cream">$3,744</p>
                        </div>
                    </div>
                </div>
            </SettingsSection>

            <SettingsSection
                flush
                heading="Members"
                description="Changing a role takes effect on their next request, no sign-out needed."
                actions={
                    <UiSelect
                        size="sm"
                        value={roleFilter}
                        onChange={setRoleFilter}
                        className="w-32"
                        options={['All roles', 'Owner', 'Admin', 'Developer', 'Billing', 'Read-only']}
                    />
                }
                footer={
                    <>
                        <span className="font-mono text-[11px] text-zinc-600">Showing 5 of 312</span>
                        <UiPagination pages={63} current={1} variant="simple" />
                    </>
                }
            >
                <div className="border-b border-white/5 px-5 py-3">
                    <UiSearch size="sm" placeholder="Search by name, email, or role…" />
                </div>

                <ul className="divide-y divide-white/5">
                    {members.map((member, index) => (
                        <li key={member.email} className="flex flex-wrap items-center gap-x-4 gap-y-3 px-5 py-3">
                            <UiAvatar
                                initials={member.initials}
                                size="sm"
                                color="ghost"
                                status={member.state === 'active' ? 'online' : 'offline'}
                            />

                            <div className="min-w-0 flex-1">
                                <p className="truncate text-[13px] text-zinc-200">{member.name}</p>
                                <p className="mt-0.5 truncate font-mono text-[11px] text-zinc-600">{member.email}</p>
                            </div>

                            <span className="hidden w-20 shrink-0 text-right font-mono text-[11px] text-zinc-600 sm:block">{member.seen}</span>

                            {member.role === 'Owner' ? (
                                <span className="w-32 shrink-0 rounded-lg border border-white/8 px-2.5 py-1.5 text-center text-[13px] text-zinc-500">Owner</span>
                            ) : (
                                <UiSelect
                                    size="sm"
                                    value={memberRoles[index]}
                                    onChange={(role) => setMemberRole(index, role)}
                                    className="w-32 shrink-0"
                                    options={['Admin', 'Developer', 'Billing', 'Read-only']}
                                />
                            )}

                            <UiIconButton size="sm" variant="secondary" aria-label="More actions">
                                <svg viewBox="0 0 16 16" fill="none"><path d="M8 4.5h.01M8 8h.01M8 11.5h.01" stroke="currentColor" strokeWidth="2" strokeLinecap="round"/></svg>
                            </UiIconButton>
                        </li>
                    ))}
                </ul>
            </SettingsSection>

            <SettingsSection
                flush
                heading="Pending invites"
                description="An invite holds no seat until it is accepted."
                actions={<UiBadge variant="outline">3 waiting</UiBadge>}
            >
                <ul className="divide-y divide-white/5">
                    {invites.map((invite) => (
                        <li key={invite.email} className="flex flex-wrap items-center gap-x-4 gap-y-2 px-5 py-3">
                            <div className="min-w-0 flex-1">
                                <p className="truncate font-mono text-[13px] text-zinc-300">{invite.email}</p>
                                <p className="mt-0.5 truncate text-[11px] text-zinc-600">{invite.role} · sent by {invite.by}</p>
                            </div>

                            <span className="shrink-0 font-mono text-[11px] text-zinc-600">expires {invite.expires}</span>

                            <div className="flex shrink-0 items-center gap-3">
                                <button type="button" className="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">Resend</button>
                                <button type="button" className="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-red-400">Revoke</button>
                            </div>
                        </li>
                    ))}
                </ul>
            </SettingsSection>

            <SettingsSection heading="Joining rules" description="How people get in without an invite, and what they get when they do.">
                <SettingsRow label="Verified domains" description="Anyone with a matching address can join">
                    <UiTagsInput className="w-full! max-w-md" defaultTags={['northbeam.com', 'northbeam.co.uk']} placeholder="Add a domain…" />
                </SettingsRow>

                <SettingsRow label="Default role" description="What a domain join gets on day one" align="center">
                    <UiSelect size="sm" value={defaultRole} onChange={setDefaultRole} className="max-w-xs" options={['Read-only', 'Developer', 'Billing']} />
                </SettingsRow>

                <SettingsRow label="Require SSO" description="Password sign-in stops working for members" align="center">
                    <div className="flex items-center gap-3">
                        <span className="text-[13px] text-zinc-500">Okta · SAML 2.0</span>
                        <UiSwitch className="ml-auto" defaultChecked />
                    </div>
                </SettingsRow>

                <SettingsRow label="Reclaim idle seats" description="Frees a seat after 60 days without a sign-in" align="center">
                    <div className="flex items-center gap-3">
                        <span className="text-[13px] text-zinc-500">24 seats would be reclaimed</span>
                        <UiSwitch className="ml-auto" />
                    </div>
                </SettingsRow>
            </SettingsSection>

            <SettingsSection flush heading="Roles" description="Five built-in roles. Custom roles land on the Enterprise plan.">
                <ul className="divide-y divide-white/5">
                    {roles.map((role) => (
                        <li key={role.name} className="flex flex-col gap-2 px-5 py-3.5 sm:flex-row sm:items-center sm:gap-4">
                            <div className="sm:w-32 sm:shrink-0">
                                <p className="text-[13px] text-zinc-200">{role.name}</p>
                                <p className="mt-0.5 font-mono text-[11px] text-zinc-600">{role.seats} {role.seats === 1 ? 'seat' : 'seats'}</p>
                            </div>

                            <div className="flex flex-wrap gap-1.5">
                                {role.scopes.map((scope) => (
                                    <span key={scope} className="rounded-full border border-white/8 px-2 py-0.5 font-mono text-[10px] text-zinc-500">{scope}</span>
                                ))}
                            </div>
                        </li>
                    ))}
                </ul>
            </SettingsSection>
        </SettingsShell>
    );
}
