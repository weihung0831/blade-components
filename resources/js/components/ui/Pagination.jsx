const arrowClasses =
    'grid size-9 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70';
const disabledClasses = 'grid size-9 place-items-center rounded-lg border border-white/5 text-zinc-700';

const previousIcon = (
    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
);

const nextIcon = (
    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
);

function pageNumbers(pages, current, siblings) {
    const list = [];
    let previous = 0;

    for (let page = 1; page <= pages; page++) {
        if (page !== 1 && page !== pages && Math.abs(page - current) > siblings) {
            continue;
        }

        if (previous !== 0 && page - previous > 1) {
            list.push(null);
        }

        list.push(page);
        previous = page;
    }

    return list;
}

export function UiPagination({ pages = 1, current = 1, url = '#', variant = 'numbered', siblings = 1, className = '', ...props }) {
    const href = (page) => url.replace(':page', String(page));

    return (
        <nav aria-label="Pagination" className={`flex items-center gap-1.5 ${className}`.trim()} {...props}>
            {current > 1 ? (
                <a href={href(current - 1)} rel="prev" aria-label="Previous page" className={arrowClasses}>{previousIcon}</a>
            ) : (
                <span aria-disabled="true" className={disabledClasses}>{previousIcon}</span>
            )}

            {variant === 'simple' ? (
                <span className="px-3 font-mono text-xs text-zinc-500">
                    Page <span className="text-cream">{current}</span> of {pages}
                </span>
            ) : (
                pageNumbers(pages, current, siblings).map((page, index) =>
                    page === null ? (
                        <span key={`gap-${index}`} aria-hidden="true" className="grid size-9 place-items-center text-zinc-600">…</span>
                    ) : page === current ? (
                        <span key={page} aria-current="page" className="grid size-9 place-items-center rounded-lg bg-jade-500 text-sm font-medium text-ink-950">{page}</span>
                    ) : (
                        <a
                            key={page}
                            href={href(page)}
                            className="grid size-9 place-items-center rounded-lg border border-white/10 text-sm text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >{page}</a>
                    ),
                )
            )}

            {current < pages ? (
                <a href={href(current + 1)} rel="next" aria-label="Next page" className={arrowClasses}>{nextIcon}</a>
            ) : (
                <span aria-disabled="true" className={disabledClasses}>{nextIcon}</span>
            )}
        </nav>
    );
}
