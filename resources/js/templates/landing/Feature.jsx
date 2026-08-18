const TONES = {
    quiet: { card: 'border-white/8 bg-ink-950', mark: 'text-zinc-600 border-white/10' },
    primary: { card: 'border-jade-500/30 bg-jade-500/5', mark: 'text-jade-300 border-jade-500/40' },
    caveat: { card: 'border-amber-400/25 bg-amber-400/4', mark: 'text-amber-300 border-amber-400/40' },
};

export function LandingFeature({ mark, title, body, meta, tone = 'quiet', children }) {
    const skin = TONES[tone] ?? TONES.quiet;

    return (
        <div className={`flex flex-col rounded-2xl border p-4 transition-colors duration-150 ${skin.card}`}>
            {mark && <span className={`inline-flex w-fit items-center rounded-lg border px-1.5 py-0.5 font-mono text-[10px] tracking-wider uppercase ${skin.mark}`}>{mark}</span>}

            <h3 className="mt-3 text-[14px]/6 font-medium tracking-tight text-cream">{title}</h3>

            {body && <p className="mt-1.5 text-[12px]/5 text-zinc-500">{body}</p>}

            {children}

            {meta && <p className="mt-3 border-t border-white/5 pt-2.5 font-mono text-[10px] text-zinc-700">{meta}</p>}
        </div>
    );
}
