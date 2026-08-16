import { UiNumberTicker } from '../../components/ui/NumberTicker';

const tones = {
    up: 'text-jade-400',
    down: 'text-red-400',
    flat: 'text-zinc-500',
};

const arrows = {
    up: 'M8 12.5v-9M4 7l4-3.5L12 7',
    down: 'M8 3.5v9M4 9l4 3.5L12 9',
    flat: 'M3.5 8h9',
};

export function DashboardStat({
    label = '',
    value = 0,
    decimals = 0,
    prefix = null,
    suffix = null,
    delta = null,
    trend = 'up',
    hint = null,
}) {
    return (
        <div className="rounded-xl border border-white/10 bg-ink-800 p-4 transition-colors duration-200 hover:border-white/20">
            <p className="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{label}</p>

            <p className="mt-2.5 text-2xl font-semibold tracking-tight text-cream">
                <UiNumberTicker value={value} decimals={decimals} prefix={prefix} suffix={suffix} />
            </p>

            <div className="mt-2 flex items-center gap-2">
                {delta && (
                    <span className={`inline-flex items-center gap-1 font-mono text-[11px] ${tones[trend] ?? tones.flat}`}>
                        <svg className="size-3" viewBox="0 0 16 16" fill="none"><path d={arrows[trend] ?? arrows.flat} stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        {delta}
                    </span>
                )}
                {hint && <span className="truncate text-[11px] text-zinc-600">{hint}</span>}
            </div>
        </div>
    );
}
