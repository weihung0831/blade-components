import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const steps = [
    { label: 'Cart', screen: 'cart', note: 'one box' },
    { label: 'Delivery', screen: 'delivery', note: 'address' },
    { label: 'Payment', screen: 'payment', note: 'card' },
    { label: 'Done', screen: 'confirmation', note: 'receipt' },
];

const markerClasses = (number, current) => {
    if (number < current) {
        return 'bg-jade-500 text-ink-950';
    }

    return number === current ? 'border border-jade-500 text-jade-400' : 'border border-white/15 text-zinc-600';
};

const labelClasses = (number, current) => {
    if (number < current) {
        return 'text-zinc-400';
    }

    return number === current ? 'text-cream' : 'text-zinc-600';
};

export function CheckoutShell({ active = 'Cart', ship = 'standard', children }) {
    const index = steps.findIndex((step) => step.label === active);
    const current = index === -1 ? 1 : index + 1;

    return (
        <div className="group/shell flex h-full w-full flex-col overflow-hidden bg-ink-950" data-ship={ship}>
            <div className="relative flex min-h-0 flex-1">
                <div data-ui-scroll-region className="flex min-w-0 flex-1 flex-col overflow-y-auto">
                    <header className="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-4 border-b border-white/5 bg-ink-950/85 px-5 backdrop-blur sm:px-8">
                        <a href="/templates/product/screens/overview" target="_top" className="flex shrink-0 items-center gap-2.5">
                            <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                                <path d="M7 4h10l-1.5 5.5a4.5 4.5 0 0 1-7 0L7 4Z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                                <path d="M12 13v7M8.5 20h7" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                            </svg>
                            <span className="text-sm font-medium tracking-tight text-cream">NOMAD Supply</span>
                        </a>

                        <span className="hidden items-center gap-1.5 font-mono text-[10px] text-zinc-600 sm:inline-flex">
                            <svg className="size-3 text-jade-400" viewBox="0 0 16 16" fill="none">
                                <rect x="3.5" y="7" width="9" height="6" rx="1.5" stroke="currentColor" strokeWidth="1.3"/>
                                <path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="currentColor" strokeWidth="1.3"/>
                            </svg>
                            encrypted · 3-D Secure
                        </span>

                        <div className="ml-auto flex shrink-0 items-center gap-4">
                            <span className="hidden font-mono text-[10px] text-zinc-600 lg:block">cart held until 14:52</span>

                            <a href="/templates/product/screens/configure" target="_top" className="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">Keep shopping</a>
                        </div>
                    </header>

                    <div className="sticky top-14 z-20 border-b border-white/5 bg-ink-950/85 backdrop-blur">
                        <div className="mx-auto w-full max-w-6xl px-5 sm:px-8">
                            <ol className="flex items-stretch gap-1 overflow-x-auto py-2.5">
                                {steps.map((step, index) => (
                                    <li key={step.label} className="flex shrink-0 items-center gap-1">
                                        <a
                                            href={`/templates/checkout/screens/${step.screen}`}
                                            target="_top"
                                            aria-current={index + 1 === current ? 'step' : undefined}
                                            className={`flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${index + 1 === current ? 'bg-white/8' : 'hover:bg-white/5'}`}
                                        >
                                            <span className={`grid size-6 shrink-0 place-items-center rounded-full font-mono text-[11px] ${markerClasses(index + 1, current)}`}>
                                                {index + 1 < current ? (
                                                    <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                                ) : (
                                                    index + 1
                                                )}
                                            </span>

                                            <span className="flex flex-col">
                                                <span className={`text-[13px]/4 ${labelClasses(index + 1, current)}`}>{step.label}</span>
                                                <span className="font-mono text-[10px] text-zinc-600">{step.note}</span>
                                            </span>
                                        </a>

                                        {index < steps.length - 1 && (
                                            <span aria-hidden="true" className={`h-px w-5 shrink-0 ${index + 1 < current ? 'bg-jade-500/50' : 'bg-white/10'}`} />
                                        )}
                                    </li>
                                ))}
                            </ol>
                        </div>
                    </div>

                    <main className="mx-auto w-full max-w-6xl grow px-5 py-8 sm:px-8">{children}</main>

                    <footer className="border-t border-white/5 bg-ink-900/50">
                        <div className="mx-auto flex w-full max-w-6xl flex-wrap items-center gap-x-5 gap-y-3 px-5 py-6 font-mono text-[10px] text-zinc-600 sm:px-8">
                            <span>© 2026 NOMAD Supply Co. · tax ID 24681357</span>
                            <a href="#" className="transition-colors duration-150 hover:text-cream">Returns</a>
                            <a href="#" className="transition-colors duration-150 hover:text-cream">Privacy</a>
                            <a href="#" className="transition-colors duration-150 hover:text-cream">Reach a person</a>
                            <span className="ml-auto inline-flex items-center gap-1.5">
                                <span className="size-1.5 rounded-full bg-jade-400" />
                                payments settling normally
                            </span>
                        </div>
                    </footer>
                </div>

                <UiScrollTop anchor="container" variant="progress" threshold={300} />
            </div>
        </div>
    );
}
