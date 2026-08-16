const itemClasses =
    'flex w-full items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';

const submenuClasses =
    'invisible absolute top-0 left-full z-10 ml-1 -translate-x-1 opacity-0 transition-[opacity,translate,visibility] duration-150 ease-snap group-hover/tier:visible group-hover/tier:translate-x-0 group-hover/tier:opacity-100 group-focus-within/tier:visible group-focus-within/tier:translate-x-0 group-focus-within/tier:opacity-100';

const tone = (entry) =>
    entry.danger
        ? 'text-red-400 hover:bg-red-500/10 [&:has(+ul:hover)]:bg-red-500/10'
        : 'text-zinc-300 hover:bg-white/5 hover:text-cream [&:has(+ul:hover)]:bg-white/5 [&:has(+ul:hover)]:text-cream';

export function UiTieredMenu({ items = [], className = '', ...props }) {
    return (
        <ul role="menu" className={`min-w-52 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40 ${className}`.trim()} {...props}>
            {items.map((entry, index) =>
                entry.separator ? (
                    <li key={index}><hr className="my-1 border-white/5" /></li>
                ) : (
                    <li key={index} className="group/tier relative" role="none">
                        {entry.href && !entry.items ? (
                            <a href={entry.href} role="menuitem" className={`${itemClasses} ${tone(entry)}`}>
                                <span>{entry.label}</span>
                                {entry.shortcut && <span className="font-mono text-[11px] text-zinc-600">{entry.shortcut}</span>}
                            </a>
                        ) : (
                            <button type="button" role="menuitem" aria-haspopup={entry.items ? 'true' : undefined} className={`${itemClasses} ${tone(entry)}`}>
                                <span>{entry.label}</span>
                                {entry.items ? (
                                    <svg className="size-3 text-zinc-500" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round" /></svg>
                                ) : entry.shortcut ? (
                                    <span className="font-mono text-[11px] text-zinc-600">{entry.shortcut}</span>
                                ) : null}
                            </button>
                        )}

                        {entry.items && <UiTieredMenu items={entry.items} className={submenuClasses} />}
                    </li>
                ),
            )}
        </ul>
    );
}
