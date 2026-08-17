const TONES = {
    tip: { line: 'bg-jade-500/60', label: 'text-jade-300', fallback: 'Worth knowing' },
    warn: { line: 'bg-amber-400/60', label: 'text-amber-300', fallback: 'Careful here' },
    stop: { line: 'bg-red-400/60', label: 'text-red-300', fallback: 'Do not' },
    quiet: { line: 'bg-white/15', label: 'text-zinc-500', fallback: 'Aside' },
};

export function FaqCallout({ tone = 'tip', label = null, className = '', children }) {
    const style = TONES[tone] ?? TONES.tip;

    return (
        <div className={`relative py-1 pl-4 ${className}`}>
            <span aria-hidden="true" className={`absolute inset-y-0 left-0 w-0.5 rounded-full ${style.line}`}></span>

            <p className={`font-mono text-[10px] tracking-wider uppercase ${style.label}`}>{label ?? style.fallback}</p>
            <div className="mt-1.5 space-y-2 text-[13px]/6 text-zinc-400">{children}</div>
        </div>
    );
}
