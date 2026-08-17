const HATCH = 'bg-white/5 bg-[repeating-linear-gradient(90deg,currentColor_0_1px,transparent_1px_5px)] text-white/18';

const spell = (minutes) => {
    const hours = Math.floor(minutes / 60);

    return `${hours > 0 ? `${hours} h ` : ''}${minutes % 60} m`;
};

export function ContactPromise({ sent = '02:41', due = '10:20', shut = 409, worked = 0, left = 47, lead = null }) {
    const total = Math.max(1, shut + worked + left);
    const span = (minutes) => `${(minutes / total * 100).toFixed(3)}%`;

    return (
        <div className="rounded-xl border border-white/8 bg-ink-900 p-4">
            <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                <span className="font-mono text-xl text-cream">{due}</span>
                <span className="text-[13px] text-zinc-400">{lead ?? 'is when a person should have got to it'}</span>
                <span className="ml-auto font-mono text-[11px] text-zinc-700">sent {sent}</span>
            </div>

            <div className="mt-3.5 flex h-1.5 overflow-hidden rounded-full bg-white/6">
                <span className={`shrink-0 ${HATCH}`} style={{ width: span(shut) }}></span>

                {worked > 0 && <span className="shrink-0 bg-jade-500/60" style={{ width: span(worked) }}></span>}
            </div>

            <div className="mt-3 flex flex-wrap gap-x-5 gap-y-2">
                <span className="flex items-center gap-2">
                    <span className={`h-1.5 w-5 rounded-full ${HATCH}`}></span>
                    <span className="font-mono text-[10px] text-zinc-600">{spell(shut)} of it, the bench is shut</span>
                </span>

                <span className="flex items-center gap-2">
                    <span className="h-1.5 w-5 rounded-full bg-jade-500/60"></span>
                    <span className="font-mono text-[10px] text-zinc-600">{spell(worked)} worked</span>
                </span>

                <span className="flex items-center gap-2">
                    <span className="h-1.5 w-5 rounded-full bg-white/10"></span>
                    <span className="font-mono text-[10px] text-zinc-600">{spell(left)} still owed to you</span>
                </span>
            </div>
        </div>
    );
}
