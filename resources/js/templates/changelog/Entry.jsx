const KINDS = {
    added: { label: 'added', className: 'border-jade-500/40 text-jade-300' },
    changed: { label: 'changed', className: 'border-white/15 text-zinc-300' },
    fixed: { label: 'fixed', className: 'border-white/10 text-zinc-500' },
    removed: { label: 'removed', className: 'border-amber-400/40 text-amber-300' },
    broke: { label: 'we broke it', className: 'border-red-400/40 text-red-400' },
};

export function ChangelogEntry({ kind = 'changed', title, note, who, breaking = false, issue }) {
    const tag = KINDS[kind] ?? KINDS.changed;

    return (
        <div data-kind={kind} data-breaking={breaking ? 'yes' : 'no'} className="flex items-start gap-3 px-3.5 py-3">
            <span className={`mt-px w-24 shrink-0 rounded border px-1.5 py-0.5 text-center font-mono text-[10px] ${tag.className}`}>{tag.label}</span>

            <span className="min-w-0 flex-1">
                <span className="flex flex-wrap items-baseline gap-x-2 gap-y-1">
                    <span className="text-[13px]/5 text-cream">{title}</span>

                    {breaking && <span className="shrink-0 rounded bg-amber-400/12 px-1.5 py-0.5 font-mono text-[10px] text-amber-300">you may have to do something</span>}
                    {issue && <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{issue}</span>}
                </span>

                {note && <span className="mt-1 block text-[11px]/5 text-zinc-500">{note}</span>}

                {who && (
                    <span className="mt-1.5 flex items-baseline gap-1.5 font-mono text-[10px] text-zinc-700">
                        <span className="mt-1.5 h-px w-3 shrink-0 bg-zinc-700"></span>
                        {who}
                    </span>
                )}
            </span>
        </div>
    );
}
