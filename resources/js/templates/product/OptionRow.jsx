export function ProductOptionRow({ label, detail = null, price = 0, checked = false, included = false, lead = null, onChange }) {
    return (
        <label className={`flex cursor-pointer items-start gap-3 px-5 py-3.5 transition-colors duration-150 ${checked || included ? 'bg-jade-500/6' : ''} ${included ? 'cursor-default opacity-60' : ''}`}>
            <span className="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                <input
                    type="checkbox"
                    checked={included || checked}
                    disabled={included}
                    onChange={(event) => onChange?.(event.target.checked)}
                    className="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70 disabled:cursor-default"
                />
                <svg className="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
            </span>

            <span className="min-w-0 flex-1">
                <span className="block text-[13px] text-zinc-200">{label}</span>
                {detail && <span className="mt-0.5 block text-[12px]/5 text-zinc-500">{detail}</span>}
                {lead && <span className="mt-1 block font-mono text-[10px] text-zinc-600">{lead}</span>}
            </span>

            <span className="shrink-0 text-right">
                <span className="block font-mono text-[13px] text-zinc-300">{included ? 'included' : `+$${price.toLocaleString('en-US')}`}</span>
            </span>
        </label>
    );
}
