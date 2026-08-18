export function ErrorPagesMoved({ address, was, happened, now, href, when, hits }) {
    return (
        <div className="px-3.5 py-3">
            <div className="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                <span className="font-mono text-[11px] text-zinc-600 line-through decoration-white/20">{address}</span>
                {when && <span className="font-mono text-[10px] text-zinc-700">{when}</span>}
                {hits && <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{hits}</span>}
            </div>

            {was && <p className="mt-1.5 text-[13px]/5 text-cream">{was}</p>}
            {happened && <p className="mt-1 text-[11px]/5 text-zinc-500">{happened}</p>}

            {now && (
                <div className="mt-2 flex items-baseline gap-1.5">
                    <svg className="size-3 shrink-0 translate-y-0.5 text-jade-500/70" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M7 3l3 3-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>

                    {href ? (
                        <a href={href} target="_top" className="text-[12px]/5 text-jade-300 transition-colors duration-150 hover:text-jade-400">{now}</a>
                    ) : (
                        <span className="text-[12px]/5 text-zinc-400">{now}</span>
                    )}
                </div>
            )}
        </div>
    );
}
