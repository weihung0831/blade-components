const TONES = {
    quiet: 'bg-white/15',
    ours: 'bg-jade-500',
    warn: 'bg-amber-400/70',
    bad: 'bg-red-400/60',
};

export function LandingBar({ label, value = 0, max = 100, display = null, note = null, tone = 'quiet', marker = null }) {
    const width = max > 0 ? Math.min(100, (value / max) * 100) : 0;
    const fill = TONES[tone] ?? TONES.quiet;

    return (
        <div className="flex flex-col gap-1.5">
            <div className="flex items-baseline gap-3">
                <span className={`min-w-0 flex-1 truncate text-[12px] ${tone === 'ours' ? 'text-cream' : 'text-zinc-400'}`}>{label}</span>
                <span className="shrink-0 font-mono text-[11px] tabular-nums text-zinc-500">{display ?? value}</span>
            </div>

            <div className="relative h-1.5 overflow-hidden rounded-full bg-white/6">
                <div className={`h-full rounded-full transition-[width] duration-300 ease-snap ${fill}`} style={{ width: `${width}%` }}></div>

                {marker !== null && <span className="absolute inset-y-0 w-px bg-cream/40" style={{ left: `${Math.min(100, (marker / Math.max(max, 1)) * 100)}%` }}></span>}
            </div>

            {note && <p className="text-[11px]/5 text-zinc-600">{note}</p>}
        </div>
    );
}
