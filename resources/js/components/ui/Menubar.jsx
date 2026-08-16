const itemClasses =
    'flex w-full items-center justify-between gap-8 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';

const tone = (entry) =>
    entry.danger ? 'text-red-400 hover:bg-red-500/10' : 'text-zinc-300 hover:bg-white/5 hover:text-cream';

export function UiMenubar({ menus = [], brand = null, end = null, className = '', ...props }) {
    return (
        <div role="menubar" className={`flex items-center gap-1 rounded-xl border border-white/10 bg-ink-800 px-2 py-1.5 ${className}`.trim()} {...props}>
            {brand && <div className="mr-1 flex items-center">{brand}</div>}

            {menus.map((menu) => (
                <details key={menu.label} className="group/menu relative" name="ui-menubar">
                    <summary
                        className={`cursor-pointer list-none rounded-md px-2.5 py-1 text-sm text-zinc-400 transition-colors duration-150 outline-none select-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/menu:bg-white/8 group-open/menu:text-cream group-open/menu:before:fixed group-open/menu:before:inset-0 group-open/menu:before:cursor-default group-open/menu:before:content-['']`}
                    >
                        {menu.label}
                    </summary>
                    <div role="menu" className="absolute top-full left-0 z-10 mt-1.5 min-w-52 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
                        {(menu.items ?? []).map((entry, index) =>
                            entry.separator ? (
                                <hr key={index} className="my-1 border-white/5" />
                            ) : entry.href ? (
                                <a key={index} href={entry.href} role="menuitem" className={`${itemClasses} ${tone(entry)}`}>
                                    <span>{entry.label}</span>
                                    {entry.shortcut && <span className="font-mono text-[11px] text-zinc-600">{entry.shortcut}</span>}
                                </a>
                            ) : (
                                <button key={index} type="button" role="menuitem" className={`${itemClasses} ${tone(entry)}`}>
                                    <span>{entry.label}</span>
                                    {entry.shortcut && <span className="font-mono text-[11px] text-zinc-600">{entry.shortcut}</span>}
                                </button>
                            ),
                        )}
                    </div>
                </details>
            ))}

            {end && <div className="ml-auto flex items-center gap-2 pl-2">{end}</div>}
        </div>
    );
}
