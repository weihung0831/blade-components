export function BlogTopicPill({ value, label, count = null, name = 'topic', checked = false, onSelect = null }) {
    return (
        <label className="inline-flex cursor-pointer items-center gap-2 rounded-full border border-white/10 bg-ink-900 px-3 py-1.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/10">
            <input
                type="radio"
                name={name}
                value={value}
                checked={checked}
                onChange={() => onSelect?.(value)}
                className="peer sr-only"
            />

            <span className="text-[13px] text-zinc-400 peer-checked:text-jade-300">{label}</span>

            {count !== null && <span className="font-mono text-[10px] text-zinc-600 peer-checked:text-jade-400/70">{count}</span>}
        </label>
    );
}
