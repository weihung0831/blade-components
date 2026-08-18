export function LandingQuote({ body, name, role, machine, since }) {
    const initials = name.split(' ').slice(0, 2).map((part) => part.charAt(0)).join('');

    return (
        <figure className="flex flex-col rounded-2xl border border-white/8 bg-ink-950 p-4">
            <blockquote className="text-[13px]/6 text-zinc-300">{body}</blockquote>

            <figcaption className="mt-4 flex items-center gap-3 border-t border-white/5 pt-3">
                <span className="flex size-7 shrink-0 items-center justify-center rounded-full border border-white/10 bg-ink-900 font-mono text-[10px] text-zinc-500">{initials}</span>

                <span className="min-w-0 flex-1">
                    <span className="block truncate text-[12px] text-cream">{name}</span>
                    {role && <span className="block truncate text-[11px] text-zinc-600">{role}</span>}
                </span>

                <span className="shrink-0 text-right">
                    {machine && <span className="block font-mono text-[10px] text-zinc-600">{machine}</span>}
                    {since && <span className="block font-mono text-[10px] text-zinc-700">{since}</span>}
                </span>
            </figcaption>
        </figure>
    );
}
