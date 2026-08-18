const CLASSES = {
    quiet: 'border-white/8 bg-ink-950 text-zinc-300 hover:border-white/20 hover:text-cream',
    primary: 'border-jade-500/40 bg-jade-500/8 text-cream hover:border-jade-500/70',
    dead: 'border-white/6 bg-ink-950 text-zinc-600',
};

export function ErrorPagesRoute({ label, note, href = null, meta, kbd, tone = 'quiet' }) {
    const Tag = href === null ? 'div' : 'a';

    return (
        <Tag
            href={href ?? undefined}
            target={href ? '_top' : undefined}
            className={`group flex items-center gap-3 rounded-xl border px-3.5 py-3 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${CLASSES[tone] ?? CLASSES.quiet}`}
        >
            <span className="min-w-0 flex-1">
                <span className="flex flex-wrap items-baseline gap-x-2">
                    <span className="text-[13px]/5">{label}</span>
                    {kbd && <span className="rounded border border-white/10 px-1 font-mono text-[10px] text-zinc-600">{kbd}</span>}
                </span>

                {note && <span className="mt-1 block text-[11px]/5 text-zinc-500">{note}</span>}
            </span>

            {meta && <span className="shrink-0 font-mono text-[10px] text-zinc-700">{meta}</span>}

            {href && <svg className="size-3.5 shrink-0 text-zinc-700 transition-transform duration-150 group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M6 3.5 10.5 8 6 12.5" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>}
        </Tag>
    );
}
