const variants = {
    primary: 'bg-jade-500 text-ink-950 hover:bg-jade-400',
    secondary: 'border border-white/10 text-zinc-300 hover:border-white/25',
    ghost: 'text-zinc-400 hover:bg-white/5 hover:text-cream',
};

const itemClasses =
    '[&>a]:flex [&>a]:items-center [&>a]:gap-2.5 [&>a]:rounded-md [&>a]:px-3 [&>a]:py-1.5 [&>a]:text-sm [&>a]:text-zinc-300 [&>a:hover]:bg-white/5 [&>a:hover]:text-cream [&>button]:flex [&>button]:w-full [&>button]:items-center [&>button]:gap-2.5 [&>button]:rounded-md [&>button]:px-3 [&>button]:py-1.5 [&>button]:text-left [&>button]:text-sm [&>button]:text-zinc-300 [&>button:hover]:bg-white/5 [&>button:hover]:text-cream [&>hr]:my-1 [&>hr]:border-white/5';

export function UiDropdown({ align = 'left', variant = 'secondary', menu, className = '', children, ...props }) {
    return (
        <details className={`group/dropdown relative inline-block ${className}`.trim()} name="ui-dropdown" {...props}>
            <summary
                className={`inline-flex h-10 cursor-pointer list-none items-center gap-2 rounded-lg px-4 text-sm font-medium transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/dropdown:before:fixed group-open/dropdown:before:inset-0 group-open/dropdown:before:cursor-default group-open/dropdown:before:content-[''] ${variants[variant] ?? variants.secondary}`}
            >
                {children}
                <svg className="size-3.5 transition-transform duration-150 ease-snap group-open/dropdown:rotate-180" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
            </summary>
            <div
                role="menu"
                className={`absolute top-full z-10 mt-2 min-w-48 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40 ${align === 'right' ? 'right-0' : 'left-0'} ${itemClasses}`}
            >
                {menu}
            </div>
        </details>
    );
}
