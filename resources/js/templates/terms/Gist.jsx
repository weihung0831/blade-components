const LABELS = { us: 'ours', you: 'yours', both: 'even' };

const LEFT = { us: 'bg-amber-400/70', both: 'bg-white/15', you: 'bg-white/8' };
const RIGHT = { you: 'bg-jade-500', both: 'bg-white/15', us: 'bg-white/8' };
const TONE = { us: 'text-amber-300/80', you: 'text-jade-400/90', both: 'text-zinc-700' };

export function TermsGist({ number, title, says, means = null, favours = 'both', bites = false, href = null }) {
    return (
        <a
            href={href ?? `/templates/terms/screens/document#clause-${number}`}
            target="_top"
            className="group/gist flex gap-3 px-3 py-3 outline-none transition-colors duration-150 hover:bg-white/3 focus-visible:ring-2 focus-visible:ring-jade-500/70 sm:gap-5"
        >
            <span className="w-6 shrink-0 font-mono text-[11px] text-zinc-700">{number}</span>

            <span className="min-w-0 flex-1">
                <span className="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                    <span className="text-[13px] text-zinc-300 group-hover/gist:text-cream">{title}</span>
                    {bites && <span className="font-mono text-[10px] text-amber-300/80">catches people out</span>}
                </span>

                <span className="mt-1 block text-[12px]/5 text-zinc-500">{says}</span>
                {means && <span className="mt-1.5 block text-[11px]/5 text-zinc-600">{means}</span>}
            </span>

            <span className="flex w-20 shrink-0 flex-col items-end gap-1.5 pt-1">
                <span className="flex w-14 gap-px">
                    <span className={`h-1 flex-1 rounded-l-full ${LEFT[favours]}`}></span>
                    <span className={`h-1 flex-1 rounded-r-full ${RIGHT[favours]}`}></span>
                </span>
                <span className={`font-mono text-[10px] ${TONE[favours]}`}>{LABELS[favours] ?? 'even'}</span>
            </span>
        </a>
    );
}
