const base =
    'inline-flex items-center gap-1 font-medium underline-offset-4 outline-none transition-colors duration-150 hover:underline focus-visible:rounded-sm focus-visible:ring-2 focus-visible:ring-jade-500/70';

const variants = {
    default: 'text-jade-400 hover:text-jade-300',
    muted: 'text-zinc-400 hover:text-cream',
    underline: 'text-cream underline decoration-jade-500/60 hover:decoration-jade-400',
};

export function UiLink({ variant = 'default', external = false, className = '', children, ...props }) {
    const classes = [base, variants[variant] ?? variants.default, className].filter(Boolean).join(' ');

    return (
        <a
            className={classes}
            target={external ? '_blank' : undefined}
            rel={external ? 'noopener' : undefined}
            {...props}
        >
            {children}
            {external && (
                <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M6.5 3H13v6.5M13 3 6.75 9.25M11 9.5V12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h2.5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
            )}
        </a>
    );
}
