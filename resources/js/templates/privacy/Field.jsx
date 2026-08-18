const SOURCES = {
    you: { label: 'you typed it', class: 'text-zinc-500' },
    us: { label: 'we wrote it down', class: 'text-zinc-500' },
    law: { label: 'the law makes us', class: 'text-amber-300/80' },
};

const REMOVALS = {
    yes: { label: 'gone on request', dot: 'bg-jade-500', class: 'text-jade-400/90' },
    partly: { label: 'name comes off', dot: 'bg-white/25', class: 'text-zinc-500' },
    no: { label: 'pinned by law', dot: 'bg-amber-400/70', class: 'text-amber-300/80' },
};

export function PrivacyField({ name, source = 'you', why, keeps, removable = 'yes', note = null }) {
    const tag = SOURCES[source] ?? SOURCES.you;
    const removal = REMOVALS[removable] ?? REMOVALS.yes;

    return (
        <div className="flex flex-col gap-2 px-3.5 py-3 sm:flex-row sm:gap-5">
            <div className="w-full shrink-0 sm:w-48">
                <p className="text-[13px] text-cream">{name}</p>
                <p className={`mt-0.5 font-mono text-[10px] ${tag.class}`}>{tag.label}</p>
            </div>

            <div className="min-w-0 flex-1">
                <p className="text-[12px]/5 text-zinc-400">{why}</p>
                {note && <p className="mt-1.5 text-[11px]/5 text-zinc-600">{note}</p>}
            </div>

            <div className="flex shrink-0 items-baseline gap-4 sm:w-44 sm:flex-col sm:items-end sm:gap-1.5">
                <p className="font-mono text-[11px] text-zinc-400">{keeps}</p>
                <p className={`flex items-center gap-1.5 font-mono text-[10px] ${removal.class}`}>
                    <span className={`size-1.5 rounded-full ${removal.dot}`}></span>
                    {removal.label}
                </p>
            </div>
        </div>
    );
}
