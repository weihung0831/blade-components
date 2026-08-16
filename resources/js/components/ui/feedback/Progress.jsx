const sizes = {
    sm: 'h-1',
    md: 'h-1.5',
    lg: 'h-2.5',
};

const keyframes = `
@keyframes ui-progress-slide { from { translate: -150% 0; } to { translate: 400% 0; } }
@keyframes ui-progress-grow { from { transform: scaleX(0); } }
@keyframes ui-progress-fade { from { opacity: 0; } }
@media (prefers-reduced-motion: reduce) {
    [class*='ui-progress-grow'], [class*='ui-progress-fade'] { animation: none; }
}`;

export function UiProgress({
    value = 0,
    max = 100,
    label = null,
    indeterminate = false,
    size = 'md',
    animate = false,
    duration = 900,
    delay = 0,
    className = '',
    ...props
}) {
    const percent = max > 0 ? Math.min(100, Math.max(0, (value / max) * 100)) : 0;
    const timing = animate ? { animationDelay: `${delay}ms`, '--ui-progress-duration': `${duration}ms` } : {};

    return (
        <div className={`w-full ${className}`.trim()} {...props}>
            <style>{keyframes}</style>
            {label && (
                <div className="mb-2 flex items-baseline justify-between gap-4">
                    <span className="text-xs text-zinc-500">{label}</span>
                    {!indeterminate && (
                        <span
                            className={`font-mono text-xs text-jade-400 ${animate ? 'animate-[ui-progress-fade_var(--ui-progress-duration)_var(--ease-snap)_both]' : ''}`.trim()}
                            style={timing}
                        >
                            {Math.round(percent)}%
                        </span>
                    )}
                </div>
            )}
            <div
                role="progressbar"
                aria-valuemin={0}
                aria-valuemax={max}
                aria-valuenow={indeterminate ? undefined : value}
                aria-label={label ?? undefined}
                className={`overflow-hidden rounded-full bg-ink-800 ${sizes[size] ?? sizes.md}`}
            >
                {indeterminate ? (
                    <div className="h-full w-1/3 rounded-full bg-jade-500 animate-[ui-progress-slide_1.4s_ease-in-out_infinite]" />
                ) : (
                    <div
                        className={`h-full rounded-full bg-jade-500 ${animate ? 'origin-left animate-[ui-progress-grow_var(--ui-progress-duration)_var(--ease-snap)_both]' : 'transition-[width] duration-500 ease-snap'}`}
                        style={{ width: `${percent}%`, ...timing }}
                    />
                )}
            </div>
        </div>
    );
}
