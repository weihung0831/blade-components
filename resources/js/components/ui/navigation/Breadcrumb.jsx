export function UiBreadcrumb({ items = [], separator = 'chevron', home = null, className = '', ...props }) {
    return (
        <nav aria-label="Breadcrumb" className={`flex ${className}`.trim()} {...props}>
            <ol className="flex flex-wrap items-center gap-2 text-sm">
                {home && (
                    <li>
                        <a
                            href={home}
                            aria-label="Home"
                            className="grid size-5 place-items-center rounded text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M2.5 7 8 2.5 13.5 7v6a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V7Z" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round" /></svg>
                        </a>
                    </li>
                )}

                {items.map((item, index) => (
                    <li key={item.label} className="flex items-center gap-2">
                        {(home || index > 0) && (
                            <span aria-hidden="true" className="text-zinc-700 select-none">
                                {separator === 'slash' ? (
                                    <span className="text-xs">/</span>
                                ) : (
                                    <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round" /></svg>
                                )}
                            </span>
                        )}

                        {index === items.length - 1 ? (
                            <span aria-current="page" className="font-medium text-cream">{item.label}</span>
                        ) : item.href ? (
                            <a
                                href={item.href}
                                className="rounded text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            >{item.label}</a>
                        ) : (
                            <span className="text-zinc-600">{item.label}</span>
                        )}
                    </li>
                ))}
            </ol>
        </nav>
    );
}
