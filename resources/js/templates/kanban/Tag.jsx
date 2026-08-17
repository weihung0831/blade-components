const TONES = {
    plain: 'border-white/10 text-zinc-400',
    batch: 'border-jade-500/40 bg-jade-500/10 text-jade-300',
    alert: 'border-red-400/40 bg-red-500/10 text-red-300',
    hold: 'border-amber-400/35 bg-amber-400/10 text-amber-300',
    quiet: 'border-transparent bg-white/5 text-zinc-600',
};

export function KanbanTag({ label = null, tone = 'plain', children = null }) {
    return (
        <span className={`inline-flex shrink-0 items-center gap-1 rounded-md border px-1.5 py-0.5 font-mono text-[10px] whitespace-nowrap ${TONES[tone] ?? TONES.plain}`}>
            {children ?? label}
        </span>
    );
}
