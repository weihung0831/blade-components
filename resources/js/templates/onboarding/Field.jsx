export function OnboardingField({ label, value = '', placeholder = '', why, hint, prefix, suffix, locked = false, optional = false }) {
    return (
        <label className="block">
            <span className="flex items-baseline gap-2">
                <span className="text-[12px] text-zinc-300">{label}</span>
                {optional && <span className="font-mono text-[10px] text-zinc-700">optional</span>}
                {locked && <span className="ml-auto font-mono text-[10px] text-amber-300/70">set for good</span>}
            </span>

            <span className={`mt-1.5 flex items-center gap-0 overflow-hidden rounded-lg border transition-colors duration-150 ${
                locked ? 'border-white/8 bg-ink-950/60' : 'border-white/10 bg-ink-950 focus-within:border-jade-500/60'
            }`}>
                {prefix && <span className="shrink-0 border-r border-white/8 px-2.5 py-2 font-mono text-[11px] text-zinc-600">{prefix}</span>}

                {locked ? (
                    <span className="min-w-0 flex-1 truncate px-3 py-2 font-mono text-[12px] text-zinc-500">{value}</span>
                ) : (
                    <input
                        type="text"
                        defaultValue={value}
                        placeholder={placeholder}
                        className="min-w-0 flex-1 bg-transparent px-3 py-2 text-[13px] text-cream placeholder:text-zinc-700 focus:outline-none"
                    />
                )}

                {suffix && <span className="shrink-0 border-l border-white/8 px-2.5 py-2 font-mono text-[11px] text-zinc-600">{suffix}</span>}
            </span>

            {why && <span className="mt-1.5 block text-[11px]/5 text-zinc-600">{why}</span>}
            {hint && <span className="mt-1 block font-mono text-[10px] text-jade-400/80">{hint}</span>}
        </label>
    );
}
