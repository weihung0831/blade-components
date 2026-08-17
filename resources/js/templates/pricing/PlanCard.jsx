import { UiButton } from '../../components/ui/actions/Button';
import { UiSeparator } from '../../components/ui/data-display/Separator';

export function PricingPlanCard({
    name,
    tagline,
    monthly,
    annual = null,
    period = '/ mo',
    annualNote = null,
    unit = null,
    cta = 'Start a trial',
    ctaVariant = 'secondary',
    badge = null,
    features = [],
    meta = null,
    featured = false,
}) {
    return (
        <article className={`relative flex flex-col rounded-2xl border p-6 ${featured ? 'border-jade-500/40 bg-jade-500/6 shadow-xl shadow-jade-950/20' : 'border-white/8 bg-ink-900'}`}>
            {badge && (
                <span className={`absolute -top-2.5 right-6 rounded-full px-2.5 py-0.5 font-mono text-[10px] tracking-wider uppercase ${featured ? 'bg-jade-500 text-ink-950' : 'border border-white/10 bg-ink-950 text-zinc-500'}`}>
                    {badge}
                </span>
            )}

            <h3 className={`text-lg font-semibold tracking-tight ${featured ? 'text-jade-300' : 'text-cream'}`}>{name}</h3>
            <p className="mt-1.5 min-h-12 text-[13px]/6 text-zinc-500">{tagline}</p>

            <div className="mt-6 flex items-baseline gap-1.5">
                <span className="text-3xl font-semibold tracking-tight text-cream">
                    <span className={annual !== null ? 'group-data-[cycle=annual]/shell:hidden' : undefined}>{monthly}</span>
                    {annual !== null && <span className="hidden group-data-[cycle=annual]/shell:inline">{annual}</span>}
                </span>
                {period && <span className="font-mono text-xs text-zinc-600">{period}</span>}
            </div>

            <p className="mt-2 min-h-8 font-mono text-[11px]/5 text-zinc-600">
                {unit && <span className="block text-zinc-500">{unit}</span>}
                {annualNote && <span className="hidden group-data-[cycle=annual]/shell:block">{annualNote}</span>}
            </p>

            <UiButton variant={ctaVariant} className="mt-5 w-full">{cta}</UiButton>

            <UiSeparator className="my-6" />

            <ul className="flex flex-col gap-2.5">
                {features.map((feature) => (
                    <li key={feature.label} className="flex items-start gap-2.5">
                        <svg className={`mt-1 size-3 shrink-0 ${featured ? 'text-jade-400' : 'text-zinc-600'}`} viewBox="0 0 12 12" fill="none">
                            <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round"/>
                        </svg>
                        <span className="text-[13px]/5 text-zinc-400">
                            {feature.label}
                            {feature.meta && <span className="ml-1 font-mono text-[11px] text-zinc-600">{feature.meta}</span>}
                        </span>
                    </li>
                ))}
            </ul>

            {meta && (
                <>
                    <div className="grow" />
                    <p className="mt-6 border-t border-white/5 pt-4 font-mono text-[10px]/5 text-zinc-600">{meta}</p>
                </>
            )}
        </article>
    );
}
