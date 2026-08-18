const TONES = {
    issued: 'border-zinc-600 text-zinc-500',
    paid: 'border-jade-500/70 text-jade-300',
    overdue: 'border-red-400/70 text-red-400',
    draft: 'border-amber-400/60 text-amber-300',
    void: 'border-white/15 text-zinc-700',
};

const TILTS = {
    left: '-rotate-6',
    right: 'rotate-3',
    none: 'rotate-0',
};

export function InvoiceStamp({ label, tone = 'issued', note, tilt = 'left', className = '' }) {
    return (
        <span className={`inline-flex flex-col items-center gap-1 rounded-lg border-2 border-dashed px-3 py-1.5 select-none ${TONES[tone] ?? TONES.issued} ${TILTS[tilt] ?? TILTS.left} ${className}`}>
            <span className="font-mono text-[13px] font-bold tracking-[0.18em] uppercase">{label}</span>
            {note && <span className="font-mono text-[9px] tracking-wider opacity-80">{note}</span>}
        </span>
    );
}
