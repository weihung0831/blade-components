import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';
import { OnboardingStepper } from './Stepper';

const LINKS = [
    { label: 'Setting up', screen: 'setup' },
    { label: 'Bringing it over', screen: 'import' },
    { label: 'What is left', screen: 'checklist' },
    { label: 'Where people stop', screen: 'dropout' },
];

const PLAN = [
    { key: 'shop', label: 'The shop', note: 'Name, address, what you sell in.', minutes: '2 min' },
    { key: 'region', label: 'Where it lives', note: 'Which datacentre holds your orders. No moving it later.', minutes: '1 min' },
    { key: 'catalog', label: 'The catalog', note: 'A CSV out of the old platform, or start empty.', minutes: '19 min', optional: true },
    { key: 'people', label: 'The others', note: 'Two seats come with the plan.', minutes: '3 min', optional: true },
    { key: 'payouts', label: 'Getting paid', note: 'A bank account before the first order ships.', minutes: '6 min' },
];

export function OnboardingShell({
    active = 'Setting up',
    step = 'region',
    skipped = [],
    interactive = false,
    rail = true,
    padded = true,
    onJump,
    toolbar = null,
    children,
}) {
    const found = PLAN.findIndex((entry) => entry.key === step);
    const at = found < 0 ? PLAN.length : found;

    const steps = PLAN.map((entry, index) => ({
        ...entry,
        state: skipped.includes(entry.key)
            ? 'skipped'
            : index < at ? 'done' : index === at ? 'current' : 'todo',
    }));

    const position = Math.min(at + 1, PLAN.length);

    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/onboarding/screens/setup" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M3.5 8.5 12 5l8.5 3.5v7L12 19l-8.5-3.5z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M12 12v7m0-7 8.5-3.5M12 12 3.5 8.5" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Kerouac Coffee</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">kerouac.nomadsupply.cc</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/onboarding/screens/${link.screen}`}
                                target="_top"
                                aria-current={link.label === active ? 'page' : undefined}
                                className={`rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                                    link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'
                                }`}
                            >{link.label}</a>
                        ))}
                    </nav>

                    <div className="ml-auto flex shrink-0 items-center gap-3">
                        <span className="hidden items-center gap-1.5 font-mono text-[11px] text-zinc-600 lg:flex">
                            <span className="size-1.5 rounded-full bg-jade-500/70"></span>
                            saved 40 seconds ago
                        </span>

                        <span className="font-mono text-[11px] text-zinc-500">step {position} of {PLAN.length}</span>

                        <a
                            href="/templates/onboarding/screens/checklist"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Leave it for now</a>
                    </div>
                </div>

                <div className="h-0.5 w-full bg-white/5">
                    <div className="h-full bg-jade-500 transition-[width] duration-300" style={{ width: `${Math.round((position / PLAN.length) * 100)}%` }}></div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="relative flex min-h-0 flex-1">
                {rail && (
                    <aside className="hidden w-64 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                        <div>
                            <p className="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The whole thing, up front</p>

                            <div className="mt-3 px-4">
                                <OnboardingStepper steps={steps} interactive={interactive} onJump={onJump} />
                            </div>

                            <p className="mt-2 border-t border-white/5 px-4 pt-3 text-[11px]/5 text-zinc-600">
                                31 minutes if you do all five. Most shops open in 12 because they skip the middle two and come back
                                to them in week three.
                            </p>
                        </div>

                        <div className="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                            <p className="font-mono text-[10px] text-zinc-600">Nothing here is a lock-in</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">
                                Close the tab whenever. Every field is saved as you leave it, and the shop stays private until you
                                say otherwise.
                            </p>
                            <a
                                href="/templates/onboarding/screens/dropout"
                                target="_top"
                                className="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >How far people actually get</a>
                        </div>
                    </aside>
                )}

                {padded ? (
                    <main data-ui-scroll-region className="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{children}</main>
                ) : (
                    <main className="flex min-h-0 flex-1 flex-col overflow-hidden">{children}</main>
                )}

                {padded && <UiScrollTop anchor="container" variant="progress" threshold={300} />}
            </div>
        </div>
    );
}
