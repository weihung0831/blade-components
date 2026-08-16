const keyframes = `
@keyframes ui-bar-chart-grow { from { transform: scaleX(0); } }
@keyframes ui-bar-chart-fade { from { opacity: 0; } }
@media (prefers-reduced-motion: reduce) { [class*='ui-bar-chart-'] { animation: none; } }
`;

export function UiAnimatedBarChart({
    items = [],
    max = null,
    values = true,
    duration = 900,
    stagger = 120,
    labelWidth = 'w-16',
    className = '',
    ...props
}) {
    const ceiling = max ?? Math.max(1, ...items.map((item) => Number(item.value)));

    const percent = (item) => Math.min(100, Math.max(0, (Number(item.value) / ceiling) * 100));

    const timing = (index) => ({ animationDelay: `${index * stagger}ms`, '--ui-chart-duration': `${duration}ms` });

    return (
        <div className={`flex w-full flex-col gap-2.5 ${className}`} {...props}>
            <style>{keyframes}</style>

            {items.map((item, index) => (
                <div key={item.label} className="flex items-center gap-3">
                    <span className={`shrink-0 text-right font-mono text-[10px] text-zinc-600 ${labelWidth}`}>{item.label}</span>

                    <div className="relative h-2.5 flex-1">
                        <span
                            className={`block h-full origin-left rounded-r-sm animate-[ui-bar-chart-grow_var(--ui-chart-duration)_var(--ease-snap)_both] ${item.highlight ? 'bg-jade-500' : 'bg-jade-500/30'}`}
                            style={{ width: `${percent(item)}%`, ...timing(index) }}
                        />

                        {values && (
                            <span
                                className="absolute top-1/2 -translate-y-1/2 pl-2 font-mono text-[10px] text-zinc-500 animate-[ui-bar-chart-fade_var(--ui-chart-duration)_var(--ease-snap)_both]"
                                style={{ left: `${percent(item)}%`, ...timing(index) }}
                            >
                                {item.value}
                            </span>
                        )}
                    </div>
                </div>
            ))}
        </div>
    );
}
