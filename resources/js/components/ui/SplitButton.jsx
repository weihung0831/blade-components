const variants = {
    primary: {
        main: 'rounded-l-lg bg-jade-500 text-ink-950 hover:bg-jade-400',
        caret: 'rounded-r-lg border-l border-ink-950/15 bg-jade-500 text-ink-950 hover:bg-jade-400',
    },
    secondary: {
        main: 'rounded-l-lg border border-r-0 border-white/10 text-zinc-300 hover:bg-white/5 hover:text-cream',
        caret: 'rounded-r-lg border border-white/10 text-zinc-300 hover:bg-white/5 hover:text-cream',
    },
};

const buttonBase =
    'outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70';

const menuClasses =
    'absolute top-full right-0 z-10 mt-2 min-w-44 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40 [&>a]:block [&>a]:rounded-md [&>a]:px-3 [&>a]:py-1.5 [&>a]:text-sm [&>a]:text-zinc-300 [&>a:hover]:bg-white/5 [&>a:hover]:text-cream [&>button]:block [&>button]:w-full [&>button]:rounded-md [&>button]:px-3 [&>button]:py-1.5 [&>button]:text-left [&>button]:text-sm [&>button]:text-zinc-300 [&>button:hover]:bg-white/5 [&>button:hover]:text-cream';

export function UiSplitButton({ variant = 'primary', disabled = false, menu = null, className = '', children, ...props }) {
    const styles = variants[variant] ?? variants.primary;

    const groupClasses = ['relative inline-flex', disabled ? 'pointer-events-none opacity-40' : '', className]
        .filter(Boolean)
        .join(' ');

    return (
        <div role="group" className={groupClasses} {...props}>
            <button type="button" disabled={disabled} className={`${buttonBase} h-10 px-5 text-sm font-medium ${styles.main}`}>
                {children}
            </button>
            <details className="group/menu" name="ui-split-button-menu">
                <summary
                    aria-label="More options"
                    className={`${buttonBase} grid h-10 w-9 cursor-pointer list-none place-items-center [&::-webkit-details-marker]:hidden group-open/menu:before:fixed group-open/menu:before:inset-0 group-open/menu:before:cursor-default group-open/menu:before:content-[''] ${styles.caret}`}
                >
                    <svg className="size-3.5 transition-transform duration-150 ease-snap group-open/menu:rotate-180" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </summary>
                {menu && (
                    <div role="menu" className={menuClasses}>
                        {menu}
                    </div>
                )}
            </details>
        </div>
    );
}
