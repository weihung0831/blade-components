const TONES = {
    quiet: { code: 'text-white/12', rule: 'bg-white/10', stamp: 'text-zinc-600' },
    fault: { code: 'text-red-400/25', rule: 'bg-red-400/40', stamp: 'text-red-400' },
    held: { code: 'text-amber-400/25', rule: 'bg-amber-400/40', stamp: 'text-amber-300' },
    off: { code: 'text-jade-500/25', rule: 'bg-jade-500/40', stamp: 'text-jade-300' },
};

export function ErrorPagesCode({ code = '404', headline, sentence, tone = 'quiet', stamp, lines = [], children }) {
    const mark = TONES[tone] ?? TONES.quiet;

    return (
        <div data-code={code} className="flex gap-5 sm:gap-7">
            <div className="flex shrink-0 flex-col items-center">
                <span className={`font-mono text-[44px] leading-none font-bold tracking-tighter tabular-nums sm:text-[64px] ${mark.code}`}>{code}</span>
                <span className={`mt-3 w-px flex-1 ${mark.rule}`}></span>
            </div>

            <div className="min-w-0 flex-1 pt-1">
                {stamp && <p className={`font-mono text-[10px] tracking-wider uppercase ${mark.stamp}`}>{stamp}</p>}

                <h1 className="mt-1.5 text-xl font-semibold tracking-tight text-balance text-cream sm:text-2xl">{headline}</h1>

                {sentence && <p className="mt-2.5 max-w-xl text-[13px]/6 text-zinc-400">{sentence}</p>}

                {lines.length > 0 && (
                    <dl className="mt-4 grid max-w-lg grid-cols-[auto_minmax(0,1fr)] gap-x-4 gap-y-1.5 border-l border-white/8 pl-3.5">
                        {lines.map((line) => (
                            <div key={line.label} className="contents">
                                <dt className="font-mono text-[10px] text-zinc-700">{line.label}</dt>
                                <dd className="font-mono text-[11px] break-all text-zinc-500">{line.value}</dd>
                            </div>
                        ))}
                    </dl>
                )}

                {children}
            </div>
        </div>
    );
}
