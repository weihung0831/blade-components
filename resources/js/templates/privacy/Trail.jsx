export function PrivacyTrail({ who, role, when, why, record, flagged = false }) {
    return (
        <li className={`flex gap-3 px-3.5 py-3 ${flagged ? 'bg-amber-400/5' : ''}`}>
            <span className={`mt-1.5 size-1.5 shrink-0 rounded-full ${flagged ? 'bg-amber-400/80' : 'bg-zinc-700'}`}></span>

            <span className="min-w-0 flex-1">
                <span className="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
                    <span className="text-[13px] text-zinc-300">{who}</span>
                    <span className="font-mono text-[10px] text-zinc-600">{role}</span>
                </span>
                <span className="mt-1 block text-[12px]/5 text-zinc-500">{why}</span>
            </span>

            <span className="flex w-32 shrink-0 flex-col items-end gap-1 sm:w-40">
                <span className="font-mono text-[10px] text-zinc-500">{when}</span>
                <span className="font-mono text-[10px] text-zinc-700">{record}</span>
            </span>
        </li>
    );
}
