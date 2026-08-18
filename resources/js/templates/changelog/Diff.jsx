const MARKS = {
    gone: { sign: '-', className: 'bg-red-400/6 text-red-400/90', signClass: 'text-red-400/70' },
    new: { sign: '+', className: 'bg-jade-500/8 text-jade-300', signClass: 'text-jade-400/70' },
    same: { sign: ' ', className: 'text-zinc-500', signClass: 'text-zinc-700' },
};

export function ChangelogDiff({ state = 'same', text, note }) {
    const mark = MARKS[state] ?? MARKS.same;

    return (
        <div data-diff={state} className={`flex items-baseline gap-2 px-3 py-1 ${mark.className}`}>
            <span className={`w-2 shrink-0 font-mono text-[11px] ${mark.signClass}`}>{mark.sign}</span>
            <code className="min-w-0 flex-1 font-mono text-[11px]/5 break-all whitespace-pre-wrap">{text}</code>

            {note && <span className="hidden shrink-0 font-mono text-[10px] text-zinc-700 sm:block">{note}</span>}
        </div>
    );
}
