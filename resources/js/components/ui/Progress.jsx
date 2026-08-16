const sizes = {
    sm: 'h-1',
    md: 'h-1.5',
    lg: 'h-2.5',
};

export function UiProgress({
    value = 0,
    max = 100,
    label = null,
    indeterminate = false,
    size = 'md',
    className = '',
    ...props
}) {
    const percent = max > 0 ? Math.min(100, Math.max(0, (value / max) * 100)) : 0;

    return (
        <div className={`w-full ${className}`.trim()} {...props}>
            <style>{'@keyframes ui-progress-slide { from { translate: -150% 0; } to { translate: 400% 0; } }'}</style>
            {label && (
                <div className="mb-2 flex items-baseline justify-between gap-4">
                    <span className="text-xs text-zinc-500">{label}</span>
                    {!indeterminate && <span className="font-mono text-xs text-jade-400">{Math.round(percent)}%</span>}
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
                    <div className="h-full rounded-full bg-jade-500 transition-[width] duration-500 ease-snap" style={{ width: `${percent}%` }} />
                )}
            </div>
        </div>
    );
}
