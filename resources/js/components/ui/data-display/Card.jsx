const variants = {
    outline: 'border border-white/10 bg-ink-800',
    elevated: 'border border-white/5 bg-ink-800 shadow-lg shadow-black/40',
    interactive: 'cursor-pointer border border-white/10 bg-ink-800 transition duration-200 ease-snap hover:-translate-y-0.5 hover:border-white/25',
};

export function UiCard({ variant = 'outline', header = null, footer = null, className = '', children, ...props }) {
    const classes = ['overflow-hidden rounded-xl', variants[variant] ?? variants.outline, className].filter(Boolean).join(' ');

    return (
        <div className={classes} {...props}>
            {header && <div className="border-b border-white/5 px-4 py-3">{header}</div>}
            <div className="p-4">{children}</div>
            {footer && <div className="border-t border-white/5 px-4 py-3">{footer}</div>}
        </div>
    );
}
