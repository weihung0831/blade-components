const PILLS = {
    open: { dot: 'bg-jade-400', text: 'text-jade-300', edge: 'border-jade-500/30 bg-jade-500/8', word: 'The bench is open' },
    soon: { dot: 'bg-jade-400/60', text: 'text-jade-300/90', edge: 'border-jade-500/25 bg-jade-500/5', word: 'Opening shortly' },
    shut: { dot: 'bg-amber-400', text: 'text-amber-300/90', edge: 'border-amber-400/25 bg-amber-400/8', word: 'Nobody is at the bench' },
};

const TICKS = [[0, '00'], [6, '06'], [12, '12'], [18, '18']];

const at = (hour) => `${(hour / 24 * 100).toFixed(3)}%`;

export function ContactHours({
    zone = 'Taipei',
    time = '04:12',
    cursor = 4.2,
    state = 'shut',
    days = 'Mon–Fri',
    windows = [[9.5, 18.5]],
    note = null,
}) {
    const pill = PILLS[state] ?? PILLS.shut;
    const band = state === 'open' ? 'bg-jade-500/55' : 'bg-white/14';

    return (
        <div className="flex flex-wrap items-center gap-x-5 gap-y-3">
            <span className={`flex shrink-0 items-center gap-2 rounded-lg border px-2.5 py-1.5 ${pill.edge}`}>
                <span className={`size-1.5 rounded-full ${pill.dot}`}></span>
                <span className={`text-[12px] ${pill.text}`}>{pill.word}</span>
                <span className="font-mono text-[11px] text-zinc-600">{time} {zone}</span>
            </span>

            <div className="min-w-[14rem] flex-1">
                <div className="relative h-1.5 rounded-full bg-white/6">
                    {windows.map(([from, to]) => (
                        <span
                            key={from}
                            className={`absolute inset-y-0 rounded-full ${band}`}
                            style={{ left: at(from), width: at(to - from) }}
                        ></span>
                    ))}

                    <span className="absolute -top-1.5 -bottom-1.5 w-px bg-cream" style={{ left: at(cursor) }}>
                        <span className="absolute -top-1 -left-[1.5px] size-1 rounded-full bg-cream"></span>
                    </span>
                </div>

                <div className="relative mt-1.5 h-3">
                    {TICKS.map(([hour, label]) => (
                        <span key={hour} className="absolute font-mono text-[9px] text-zinc-700" style={{ left: at(hour) }}>{label}</span>
                    ))}
                    <span className="absolute right-0 font-mono text-[9px] text-zinc-700">24</span>
                </div>
            </div>

            <span className="shrink-0 font-mono text-[11px] text-zinc-600">{note ?? days}</span>
        </div>
    );
}
