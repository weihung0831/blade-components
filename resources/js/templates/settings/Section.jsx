const tones = {
    default: 'border-white/10 bg-ink-800',
    danger: 'border-red-400/25 bg-ink-800',
};

export function SettingsSection({ heading, description = null, flush = false, tone = 'default', actions = null, footer = null, className = '', children }) {
    const classes = ['overflow-hidden rounded-xl border', tones[tone] ?? tones.default, className].filter(Boolean).join(' ');

    return (
        <section className={classes}>
            <div className="flex flex-wrap items-start justify-between gap-3 border-b border-white/5 px-5 py-3.5">
                <div>
                    <h2 className={`text-sm font-medium ${tone === 'danger' ? 'text-red-400' : 'text-cream'}`}>{heading}</h2>
                    {description && <p className="mt-1 max-w-md text-xs/5 text-zinc-500">{description}</p>}
                </div>
                {actions && <div className="flex shrink-0 items-center gap-2">{actions}</div>}
            </div>

            {flush ? children : <div className="divide-y divide-white/5 px-5">{children}</div>}

            {footer && <div className="flex flex-wrap items-center justify-between gap-3 border-t border-white/5 bg-ink-950/40 px-5 py-3">{footer}</div>}
        </section>
    );
}
