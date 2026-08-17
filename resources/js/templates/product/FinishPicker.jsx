const finishes = [
    { key: 'graphite', label: 'Graphite', swatch: 'bg-finish-graphite', note: '12 left' },
    { key: 'cream', label: 'Cream', swatch: 'bg-finish-cream', note: '4 left' },
    { key: 'jade', label: 'Jade', swatch: 'bg-finish-jade', note: '+$120' },
];

export function ProductFinishPicker({ value = 'graphite', onChange, detailed = false, className = '' }) {
    if (detailed) {
        return (
            <div className={`grid gap-2 sm:grid-cols-3 ${className}`} role="group" aria-label="Finish">
                {finishes.map((item) => (
                    <button
                        key={item.key}
                        type="button"
                        onClick={() => onChange?.(item.key)}
                        className={`flex items-center gap-2.5 rounded-xl border bg-ink-900 px-3 py-2.5 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${value === item.key ? 'border-jade-500/50 bg-jade-500/6' : 'border-white/8 hover:border-white/20'}`}
                    >
                        <span className={`size-5 shrink-0 rounded-full ring-1 ring-white/15 ${item.swatch}`}></span>
                        <span className="min-w-0">
                            <span className="block truncate text-[13px] text-zinc-300">{item.label}</span>
                            <span className="block truncate font-mono text-[10px] text-zinc-600">{item.note}</span>
                        </span>
                    </button>
                ))}
            </div>
        );
    }

    return (
        <div className={`flex items-center gap-1.5 ${className}`} role="group" aria-label="Finish">
            {finishes.map((item) => (
                <button
                    key={item.key}
                    type="button"
                    aria-label={item.label}
                    onClick={() => onChange?.(item.key)}
                    className={`rounded-full p-0.5 ring-1 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${value === item.key ? 'ring-jade-400' : 'ring-white/12 hover:ring-white/35'}`}
                >
                    <span className={`block size-4 rounded-full ${item.swatch}`}></span>
                </button>
            ))}
        </div>
    );
}
