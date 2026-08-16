import { AuthShell } from './Shell';
import { UiBadge } from '../../components/ui/Badge';
import { UiSeparator } from '../../components/ui/Separator';
import { UiProgress } from '../../components/ui/Progress';
import { UiButton } from '../../components/ui/Button';

const to = (screen) => `/templates/auth/screens/${screen}`;

const scopes = [
    { label: 'Deploys', detail: 'Ship to staging on their own, production needs a review' },
    { label: 'Merchants', detail: 'Read every tenant, edit the ones assigned to them' },
    { label: 'Billing', detail: 'No access — owners and admins only' },
];

export function AuthInvite() {
    return (
        <AuthShell
            title="Join Northbeam Supply"
            subtitle="Aiden Lau invited you to the workspace as a developer."
            action={
                <>
                    <span className="text-zinc-500">Invite for</span>
                    <span className="font-mono text-[11px] text-zinc-400">dana@northbeam.co</span>
                </>
            }
        >
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

            <ul className="mt-5 flex flex-col gap-3">
                {scopes.map((scope) => (
                    <li key={scope.label} className="flex items-start gap-2.5">
                        <svg className="mt-0.5 size-4 shrink-0 text-jade-400" viewBox="0 0 16 16" fill="none"><path d="m4 8.4 2.6 2.6L12 5.4" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        <p className="text-[13px]/5 text-zinc-300">
                            {scope.label}
                            <span className="text-zinc-500"> — {scope.detail}</span>
                        </p>
                    </li>
                ))}
            </ul>

            <div className="mt-6 flex flex-col gap-2">
                <UiButton className="w-full">Accept and join</UiButton>
                <UiButton variant="ghost" className="w-full">Decline</UiButton>
            </div>

            <p className="mt-4 text-center font-mono text-[11px] text-zinc-600">
                Expires 24 Aug ·{' '}
                <a href={to('sign-in')} target="_top" className="text-zinc-500 underline decoration-white/20 underline-offset-4 transition-colors duration-150 hover:text-cream">Use a different account</a>
            </p>
        </AuthShell>
    );
}
