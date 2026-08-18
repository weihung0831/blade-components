const CONTROLS = {
    required: { label: 'cannot be switched off', class: 'border-amber-400/25 bg-amber-400/8 text-amber-300/90' },
    partly: { label: 'avoidable', class: 'border-white/12 bg-white/5 text-zinc-400' },
    optional: { label: 'off unless you say yes', class: 'border-jade-500/30 bg-jade-500/8 text-jade-300' },
};

export function PrivacyHolder({ name, role, country, basis, control = 'required', gets = [], note = null, since = null }) {
    const tag = CONTROLS[control] ?? CONTROLS.required;

    return (
        <article className="flex flex-col gap-3 rounded-xl border border-white/8 bg-ink-900 p-4 sm:flex-row sm:gap-5">
            <div className="w-full shrink-0 sm:w-52">
                <p className="text-[13px] text-cream">{name}</p>
                <p className="mt-0.5 text-[11px]/5 text-zinc-500">{role}</p>
                <p className="mt-1.5 flex items-center gap-1.5 font-mono text-[10px] text-zinc-600">
                    <span className="size-1 rounded-full bg-zinc-700"></span>
                    {country}
                </p>
            </div>

            <div className="min-w-0 flex-1">
                <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Handed over</p>
                <div className="mt-1.5 flex flex-wrap gap-1">
                    {gets.map((item) => (
                        <span key={item} className="rounded border border-white/8 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400">{item}</span>
                    ))}
                </div>

                {note && <p className="mt-2.5 text-[11px]/5 text-zinc-500">{note}</p>}
            </div>

            <div className="flex shrink-0 flex-row items-center gap-3 sm:w-40 sm:flex-col sm:items-end sm:gap-2">
                <span className={`rounded border px-1.5 py-0.5 text-center font-mono text-[10px] ${tag.class}`}>{tag.label}</span>
                <span className="font-mono text-[10px] text-zinc-600">{basis}</span>
                {since && <span className="font-mono text-[10px] text-zinc-700">since {since}</span>}
            </div>
        </article>
    );
}
