export function TermsNotice({
    version,
    effective,
    announced = null,
    days = 28,
    window: notice = 45,
    elapsed = 17,
    lead = null,
    promise = null,
    actions = null,
    className = '',
}) {
    const ratio = `${Math.max(0, Math.min(100, (elapsed / Math.max(1, notice)) * 100)).toFixed(3)}%`;

    return (
        <div className={`rounded-xl border border-amber-400/25 bg-amber-400/5 p-4 ${className}`}>
            <div className="flex flex-wrap items-start gap-x-6 gap-y-3">
                <div className="min-w-0 flex-1">
                    <p className="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                        <span className="font-mono text-[13px] text-amber-300">{version}</span>
                        <span className="text-[13px] text-cream">takes effect on {effective}</span>
                    </p>

                    {lead && <p className="mt-1.5 max-w-xl text-[12px]/5 text-zinc-500">{lead}</p>}
                </div>

                <div className="flex shrink-0 items-baseline gap-2">
                    <span className="font-mono text-2xl text-cream">{days}</span>
                    <span className="font-mono text-[10px] text-zinc-600">days from today</span>
                </div>
            </div>

            <div className="mt-4">
                <div className="relative h-1.5 overflow-hidden rounded-full bg-white/6">
                    <span className="absolute inset-y-0 left-0 rounded-full bg-amber-400/50" style={{ width: ratio }}></span>
                    <span className="absolute -top-1 -bottom-1 w-px bg-cream" style={{ left: ratio }}></span>
                </div>

                <div className="mt-2 flex flex-wrap items-baseline gap-x-4 gap-y-1 font-mono text-[10px] text-zinc-700">
                    {announced && <span>announced {announced}</span>}
                    <span>{notice} days of notice, {elapsed} of them gone</span>
                    <span className="ml-auto">{effective}</span>
                </div>
            </div>

            {promise && <p className="mt-3 border-t border-amber-400/15 pt-3 text-[11px]/5 text-zinc-500">{promise}</p>}

            {actions && <div className="mt-3.5 flex flex-wrap gap-2">{actions}</div>}
        </div>
    );
}
