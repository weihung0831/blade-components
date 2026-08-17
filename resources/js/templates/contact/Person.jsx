export function ContactPerson({ name, initials = null, role = null, handles = null, hours = null, here = false }) {
    return (
        <div className="flex gap-3">
            <span
                className={`relative flex size-9 shrink-0 items-center justify-center rounded-lg border font-mono text-[11px] ${
                    here ? 'border-jade-500/40 bg-jade-500/10 text-jade-300' : 'border-white/10 bg-ink-900 text-zinc-500'
                }`}
            >
                {initials ?? name.slice(0, 2)}
                {here && <span className="absolute -top-0.5 -right-0.5 size-2 rounded-full border-2 border-ink-950 bg-jade-400"></span>}
            </span>

            <div className="min-w-0 flex-1">
                <p className="flex items-baseline gap-2">
                    <span className="text-[13px] text-zinc-300">{name}</span>
                    {role && <span className="truncate font-mono text-[10px] text-zinc-700">{role}</span>}
                </p>

                {handles && <p className="mt-1 text-[12px]/5 text-zinc-500">{handles}</p>}

                {hours && <p className={`mt-1 font-mono text-[10px] ${here ? 'text-jade-400/80' : 'text-zinc-700'}`}>{hours}</p>}
            </div>
        </div>
    );
}
