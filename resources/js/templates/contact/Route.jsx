export function ContactRoute({
    name,
    lead = null,
    person = null,
    reply = null,
    window = null,
    open = false,
    bring = [],
    active = false,
    href = '/templates/contact/screens/write',
}) {
    return (
        <a
            href={href}
            target="_top"
            className={`group/route flex flex-col rounded-xl border bg-ink-900 p-4 outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                active ? 'border-jade-500/60 bg-jade-500/8' : 'border-white/8 hover:border-white/15'
            }`}
        >
            <span className="flex items-baseline gap-2">
                <span className={`text-[13px] font-medium group-hover/route:text-cream ${active ? 'text-cream' : 'text-zinc-300'}`}>{name}</span>

                <span className="ml-auto flex shrink-0 items-center gap-1.5">
                    <span className={`size-1.5 rounded-full ${open ? 'bg-jade-400' : 'bg-amber-400/70'}`}></span>
                    <span className={`font-mono text-[10px] ${open ? 'text-jade-400/90' : 'text-zinc-700'}`}>{open ? 'reading now' : 'asleep'}</span>
                </span>
            </span>

            {lead && <span className="mt-1.5 text-[12px]/5 text-zinc-500">{lead}</span>}

            <span className="mt-3.5 flex items-end gap-3 border-t border-white/5 pt-3">
                <span className="flex flex-col">
                    <span className="font-mono text-base text-cream">{reply}</span>
                    <span className="mt-0.5 font-mono text-[10px] text-zinc-700">median first reply</span>
                </span>

                <span className="ml-auto flex flex-col text-right">
                    {person && <span className="text-[12px] text-zinc-400">{person}</span>}
                    {window && <span className="mt-0.5 font-mono text-[10px] text-zinc-700">{window}</span>}
                </span>
            </span>

            {bring.length > 0 && (
                <span className="mt-3 flex flex-wrap items-center gap-1.5">
                    <span className="font-mono text-[10px] text-zinc-700">have ready</span>
                    {bring.map((item) => (
                        <span key={item} className="rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500">{item}</span>
                    ))}
                </span>
            )}
        </a>
    );
}
