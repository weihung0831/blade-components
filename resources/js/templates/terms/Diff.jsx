const TINTS = {
    '-': { row: 'bg-red-400/6', mark: 'text-red-400/80', text: 'text-zinc-500' },
    '+': { row: 'bg-jade-500/8', mark: 'text-jade-400', text: 'text-zinc-300' },
};

const VERDICTS = {
    'better for you': 'border-jade-500/40 bg-jade-500/10 text-jade-300',
    'better for us': 'border-amber-400/30 bg-amber-400/8 text-amber-300/90',
};

const skin = (mark) => TINTS[mark] ?? { row: '', mark: 'text-zinc-700', text: 'text-zinc-500' };

export function TermsDiff({ clause, title = null, lines = [], why = null, verdict = null }) {
    const added = lines.filter((line) => line.mark === '+').length;
    const removed = lines.filter((line) => line.mark === '-').length;

    return (
        <div className="overflow-hidden rounded-xl border border-white/8 bg-ink-900">
            <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1 border-b border-white/5 px-3.5 py-2.5">
                <span className="font-mono text-[11px] text-zinc-700">{clause}</span>
                {title && <span className="text-[13px] text-zinc-300">{title}</span>}

                <span className="ml-auto flex shrink-0 items-center gap-2 font-mono text-[10px]">
                    <span className="text-red-400/80">−{removed}</span>
                    <span className="text-jade-400">+{added}</span>
                </span>
            </div>

            <div className="divide-y divide-white/4">
                {lines.map((line, index) => (
                    <p key={index} className={`flex gap-3 px-3.5 py-2 ${skin(line.mark).row}`}>
                        <span className={`w-2 shrink-0 font-mono text-[11px] ${skin(line.mark).mark}`}>{line.mark === ' ' ? '' : line.mark}</span>
                        <span className={`font-mono text-[11px]/5 ${skin(line.mark).text}`}>{line.text}</span>
                    </p>
                ))}
            </div>

            {(why || verdict) && (
                <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1.5 border-t border-white/5 px-3.5 py-2.5">
                    {why && <span className="min-w-0 flex-1 text-[12px]/5 text-zinc-500">{why}</span>}
                    {verdict && (
                        <span className={`shrink-0 rounded border px-1.5 py-0.5 font-mono text-[10px] ${VERDICTS[verdict] ?? 'border-white/10 text-zinc-600'}`}>{verdict}</span>
                    )}
                </div>
            )}
        </div>
    );
}
