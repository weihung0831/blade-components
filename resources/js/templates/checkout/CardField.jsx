const BRANDS = [
    { name: 'visa', test: /^4/ },
    { name: 'mastercard', test: /^5[1-5]/ },
    { name: 'jcb', test: /^35/ },
    { name: 'amex', test: /^3[47]/ },
    { name: 'unionpay', test: /^62/ },
];

export function CheckoutCardField({ label = 'Card number', hint = null, value = '', onChange = null }) {
    const digits = value.replace(/\D/g, '').slice(0, 19);
    const brand = BRANDS.find((candidate) => candidate.test.test(digits))?.name ?? null;

    const handle = (event) => {
        const raw = event.target.value.replace(/\D/g, '').slice(0, 19);

        onChange?.(raw.replace(/(.{4})/g, '$1 ').trim());
    };

    return (
        <div>
            <label className="mb-1.5 block text-[13px] text-zinc-400">{label}</label>

            <div className="relative">
                <input
                    type="text"
                    inputMode="numeric"
                    autoComplete="cc-number"
                    placeholder="4571 0000 0000 0000"
                    maxLength={23}
                    aria-label={label}
                    value={value}
                    onChange={handle}
                    className="block h-10 w-full rounded-lg border border-white/10 bg-ink-950 pr-20 pl-3 font-mono text-sm tracking-wider text-zinc-200 transition-colors duration-150 outline-none placeholder:tracking-wider placeholder:text-zinc-700 hover:border-white/20 focus:border-jade-500"
                />

                <span
                    className={`absolute top-1/2 right-3 -translate-y-1/2 rounded border px-1.5 py-0.5 font-mono text-[10px] tracking-wider uppercase ${brand ? 'border-jade-500/40 text-jade-400' : 'border-white/10 text-zinc-500'}`}
                >
                    {brand ?? 'card'}
                </span>
            </div>

            {hint && <p className="mt-1.5 text-xs text-zinc-500">{hint}</p>}
        </div>
    );
}
