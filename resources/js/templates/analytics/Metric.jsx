const ranges = ['7d', '28d', '90d'];

const show = {
    '7d': 'hidden group-data-[range=7d]/shell:block',
    '28d': 'hidden group-data-[range=28d]/shell:block',
    '90d': 'hidden group-data-[range=90d]/shell:block',
};

const tones = {
    up: 'text-jade-400',
    down: 'text-red-400',
    flat: 'text-zinc-600',
};

const line = (points) => {
    if (!points || points.length < 2) {
        return '';
    }

    const low = Math.min(...points);
    const span = Math.max(...points) - low || 1;

    return points
        .map((point, index) => `${((index / (points.length - 1)) * 100).toFixed(2)},${(26 - ((point - low) / span) * 22).toFixed(2)}`)
        .join(' ');
};

export function AnalyticsMetric({ label, values = {}, deltas = {}, trends = {}, spark = {}, hint = null }) {
    return (
        <div className="flex flex-col rounded-xl border border-white/10 bg-ink-800 p-4">
            <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{label}</p>

            <div className="mt-2.5 flex items-end justify-between gap-3">
                <div>
                    {ranges.map((range) => (
                        <div key={range} className={show[range]}>
                            <p className="text-2xl font-semibold tracking-tight text-cream">{values[range] ?? '—'}</p>
                            {deltas[range] && <p className={`mt-1 font-mono text-[11px] ${tones[trends[range] ?? 'up']}`}>{deltas[range]}</p>}
                        </div>
                    ))}
                </div>

                {Object.keys(spark).length > 0 && (
                    <svg className="h-7 w-20 shrink-0 text-jade-500" viewBox="0 0 100 28" preserveAspectRatio="none" fill="none" aria-hidden="true">
                        {ranges.map((range) => spark[range] && (
                            <polyline
                                key={range}
                                points={line(spark[range])}
                                className={show[range]}
                                stroke="currentColor"
                                strokeWidth="1.5"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                vectorEffect="non-scaling-stroke"
                            />
                        ))}
                    </svg>
                )}
            </div>

            {hint && <p className="mt-3 font-mono text-[10px] text-zinc-700">{hint}</p>}
        </div>
    );
}
