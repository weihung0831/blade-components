export function ProductSpecRow({ label, value, note = null }) {
    return (
        <div className="flex flex-wrap items-baseline gap-x-4 gap-y-1 px-5 py-3">
            <span className="w-40 shrink-0 text-[13px] text-zinc-500">{label}</span>
            <span className="font-mono text-[13px] text-zinc-200">{value}</span>
            {note && <span className="ml-auto hidden font-mono text-[10px] text-zinc-600 sm:block">{note}</span>}
        </div>
    );
}
