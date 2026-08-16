const sizes = {
    sm: 'h-5 min-w-5 px-1 text-[10px]',
    md: 'h-6 min-w-6 px-1.5 text-[11px]',
};

export function UiKbd({ size = 'md', className = '', children, ...props }) {
    const kbdClasses = [
        'inline-grid place-items-center rounded-md border border-white/10 border-b-white/20 bg-ink-800 font-mono text-zinc-300',
        sizes[size] ?? sizes.md,
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <kbd className={kbdClasses} {...props}>
            {children}
        </kbd>
    );
}
