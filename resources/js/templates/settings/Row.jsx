export function SettingsRow({ label, description = null, align = 'start', className = '', children }) {
    const classes = [
        'flex flex-col gap-2.5 py-4 sm:flex-row sm:gap-6',
        align === 'center' ? 'sm:items-center' : 'sm:items-start',
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <div className={classes}>
            <div className="sm:w-48 sm:shrink-0">
                <p className="text-[13px] text-zinc-300">{label}</p>
                {description && <p className="mt-1 text-[11px]/5 text-zinc-600">{description}</p>}
            </div>

            <div className="min-w-0 flex-1">{children}</div>
        </div>
    );
}
