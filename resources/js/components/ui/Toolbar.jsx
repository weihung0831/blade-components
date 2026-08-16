export function UiToolbar({ start = null, center = null, end = null, className = '', ...props }) {
    const classes = ['flex items-center justify-between gap-2 rounded-xl border border-white/10 bg-ink-800 p-1.5', className].filter(Boolean).join(' ');

    return (
        <div className={classes} role="toolbar" {...props}>
            {start && <div className="flex items-center gap-1">{start}</div>}
            {center && <div className="flex items-center gap-1">{center}</div>}
            {end && <div className="flex items-center gap-1.5">{end}</div>}
        </div>
    );
}
