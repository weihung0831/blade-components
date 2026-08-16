const keyframes = `
@keyframes ui-column-chart-grow { from { transform: scaleY(0); } }
@keyframes ui-column-chart-fade { from { opacity: 0; } }
@media (prefers-reduced-motion: reduce) { [class*='ui-column-chart-'] { animation: none; } }
`;

export function UiAnimatedColumnChart({
    items = [],
    max = null,
    height = 'h-40',
    values = true,
    duration = 900,
    stagger = 120,
    className = '',
    ...props
}) {
    const ceiling = max ?? Math.max(1, ...items.map((item) => Number(item.value)));

    const percent = (item) => Math.min(100, Math.max(0, (Number(item.value) / ceiling) * 100));

    const timing = (index) => ({ animationDelay: `${index * stagger}ms`, '--ui-chart-duration': `${duration}ms` });

    return (
        <div className={`w-full ${className}`} {...props}>
            <style>{keyframes}</style>

            <div className={`flex items-end gap-2 ${height}`}>
                {items.map((item, index) => (
                    <div key={item.label} className="relative flex h-full flex-1 items-end">
                        <span
                            className={`w-full origin-bottom rounded-t-sm animate-[ui-column-chart-grow_var(--ui-chart-duration)_var(--ease-snap)_both] ${item.highlight ? 'bg-jade-500' : 'bg-jade-500/30'}`}
                            style={{ height: `${percent(item)}%`, ...timing(index) }}
                        />

                        {values && (
                            <span
                                className="absolute inset-x-0 text-center font-mono text-[10px] text-zinc-500 animate-[ui-column-chart-fade_var(--ui-chart-duration)_var(--ease-snap)_both]"
                                style={{ bottom: `calc(${percent(item)}% + 6px)`, ...timing(index) }}
                            >
                                {item.value}
                            </span>
                        )}
                    </div>
                ))}
            </div>

            <div className="mt-1.5 h-px bg-white/10" />

            <div className="mt-1.5 flex gap-2">
                {items.map((item) => (
                    <span key={item.label} className="flex-1 text-center font-mono text-[10px] text-zinc-600">
                        {item.label}
                    </span>
                ))}
            </div>
        </div>
    );
}
