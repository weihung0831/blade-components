const colors = {
    jade: 'bg-jade-500',
    mint: 'bg-jade-300',
    zinc: 'bg-zinc-500',
};

const keyframes = `
@keyframes ui-meter-grow { from { transform: scaleX(0); } }
@keyframes ui-meter-fade { from { opacity: 0; translate: 0 4px; } }
@media (prefers-reduced-motion: reduce) {
    [class*='ui-meter-grow'], [class*='ui-meter-fade'] { animation: none; }
}`;

export function UiMeterGroup({
    segments = [],
    label = null,
    total = null,
    max = 100,
    unit = '%',
    animate = false,
    duration = 900,
    delay = 0,
    stagger = 90,
    className = '',
    ...props
}) {
    const colorClass = (segment) => colors[segment.color] ?? colors.jade;

    const width = (segment) => `${Math.round((segment.value / max) * 10000) / 100}%`;

    const display = (segment) => (unit === '%' ? `${segment.value}%` : `${segment.value} ${unit}`);

    const timing = (step) => (animate
        ? { animationDelay: `${delay + step * stagger}ms`, '--ui-meter-duration': `${duration}ms` }
        : undefined);

    const classes = ['w-full', className].filter(Boolean).join(' ');

    return (
        <div className={classes} {...props}>
            <style>{keyframes}</style>
            {(label !== null || total !== null) && (
                <div className="mb-2.5 flex items-baseline justify-between gap-4">
                    {label !== null && <p className="text-sm font-medium text-cream">{label}</p>}
                    {total !== null && <p className="font-mono text-xs text-zinc-500">{total}</p>}
                </div>
            )}
            <div
                className={`flex h-2 overflow-hidden rounded-full bg-ink-800 ${animate ? 'origin-left animate-[ui-meter-grow_var(--ui-meter-duration)_var(--ease-snap)_both]' : ''}`.trim()}
                style={timing(0)}
            >
                {segments.map((segment, index) => (
                    <span key={index} className={colorClass(segment)} style={{ width: width(segment) }} />
                ))}
            </div>
            <div className="mt-3 flex flex-col gap-1.5 text-xs">
                {segments.map((segment, index) => (
                    <span
                        key={index}
                        className={`flex items-center gap-2 text-zinc-400 ${animate ? 'animate-[ui-meter-fade_var(--ui-meter-duration)_var(--ease-snap)_both]' : ''}`.trim()}
                        style={timing(index + 1)}
                    >
                        <span className={`size-2 shrink-0 rounded-full ${colorClass(segment)}`} />
                        {segment.label}
                        <span className="ml-auto font-mono text-zinc-500">{display(segment)}</span>
                    </span>
                ))}
            </div>
        </div>
    );
}
