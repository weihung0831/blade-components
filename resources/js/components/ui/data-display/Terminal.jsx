const frames = {
    window: 'border border-white/10',
    plain: 'border border-white/5',
};

export function UiTerminal({ lines = [], title = null, variant = 'window', cursor = false, className = '', ...props }) {
    const classes = [
        'overflow-hidden rounded-lg bg-ink-950 font-mono text-xs/6',
        frames[variant] ?? frames.window,
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <div className={classes} {...props}>
            {variant === 'window' && (
                <div className="flex items-center gap-1.5 border-b border-white/5 px-3.5 py-2.5">
                    <span className="size-2 rounded-full bg-white/10" />
                    <span className="size-2 rounded-full bg-white/10" />
                    <span className="size-2 rounded-full bg-white/10" />
                    {title !== null && <span className="ml-2 text-[11px] text-zinc-600">{title}</span>}
                </div>
            )}
            <div className="p-3.5">
                {lines.map((line, index) => {
                    if (line.type === 'command') {
                        return (
                            <p key={index}>
                                <span className="text-jade-400">$</span> <span className="text-zinc-300">{line.text}</span>
                            </p>
                        );
                    }

                    if (line.type === 'success') {
                        return (
                            <p key={index} className="text-zinc-500">
                                {line.text} <span className="text-jade-400">✓</span>
                            </p>
                        );
                    }

                    return (
                        <p key={index} className="text-zinc-500">
                            {line.text}
                        </p>
                    );
                })}
                {cursor && (
                    <p>
                        <span className="text-jade-400">$</span> <span className="ml-0.5 inline-block h-3.5 w-2 animate-pulse bg-jade-400 align-middle" />
                    </p>
                )}
            </div>
        </div>
    );
}
