const variants = {
    primary: {
        group: 'bg-jade-500 text-ink-950',
        button: 'hover:bg-jade-400',
        caret: 'border-l border-ink-950/15 hover:bg-jade-400',
    },
    secondary: {
        group: 'border border-white/10 text-zinc-300',
        button: 'hover:bg-white/5 hover:text-cream',
        caret: 'border-l border-white/10 hover:bg-white/5 hover:text-cream',
    },
};

const buttonBase =
    'outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70';

export function UiSplitButton({ variant = 'primary', disabled = false, className = '', children, ...props }) {
    const styles = variants[variant] ?? variants.primary;

    const groupClasses = [
        'inline-flex overflow-hidden rounded-lg',
        styles.group,
        disabled ? 'pointer-events-none opacity-40' : '',
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <div role="group" className={groupClasses} {...props}>
            <button type="button" disabled={disabled} className={`${buttonBase} h-10 px-5 text-sm font-medium ${styles.button}`}>
                {children}
            </button>
            <button
                type="button"
                disabled={disabled}
                aria-label="More options"
                className={`${buttonBase} grid h-10 w-9 place-items-center ${styles.caret}`}
            >
                <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
            </button>
        </div>
    );
}
