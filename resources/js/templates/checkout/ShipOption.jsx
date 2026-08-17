const money = (value) => (value === 0 ? 'free' : '$' + value.toLocaleString('en-US'));

export function CheckoutShipOption({ value, label, detail = null, price = 0, eta, note = null, checked = false, onSelect = null }) {
    return (
        <label className="flex cursor-pointer items-start gap-3 rounded-xl border border-white/10 bg-ink-950 p-4 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
            <span className="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                <input
                    type="radio"
                    name="ship"
                    value={value}
                    checked={checked}
                    onChange={() => onSelect?.(value)}
                    className="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                />
                <span className="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100" />
            </span>

            <span className="flex min-w-0 flex-1 flex-col gap-1">
                <span className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                    <span className="text-[13px]/5 text-zinc-200">{label}</span>
                    <span className={`shrink-0 font-mono text-[13px] ${price === 0 ? 'text-jade-400' : 'text-zinc-300'}`}>{money(price)}</span>
                </span>

                {detail && <span className="text-xs/5 text-zinc-500">{detail}</span>}

                <span className="font-mono text-[10px] text-zinc-600">{eta}</span>

                {note && <span className="font-mono text-[10px] text-amber-400/80">{note}</span>}
            </span>
        </label>
    );
}
