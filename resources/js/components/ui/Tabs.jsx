const lists = {
    line: 'flex items-center gap-6 border-b border-white/8',
    pill: 'inline-flex items-center gap-1 rounded-lg border border-white/10 bg-ink-950 p-1',
};

const tabs = {
    line: '-mb-px border-b-2 border-transparent pb-2.5 text-zinc-500 hover:text-zinc-300 data-active:border-jade-500 data-active:text-cream',
    pill: 'rounded-md px-3 py-1.5 text-zinc-500 hover:text-zinc-300 data-active:bg-white/10 data-active:text-cream',
};

export function UiTabs({ items = [], active, onActiveChange, panels = {}, variant = 'line', className = '', ...props }) {
    const current = active ?? items[0]?.value;

    return (
        <div className={className} {...props}>
            <div role="tablist" className={lists[variant] ?? lists.line}>
                {items.map((item) => (
                    <button
                        key={item.value}
                        type="button"
                        role="tab"
                        aria-selected={item.value === current}
                        data-active={item.value === current ? '' : undefined}
                        className={`inline-flex cursor-pointer items-center gap-2 text-sm font-medium transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${tabs[variant] ?? tabs.line}`}
                        onClick={() => onActiveChange?.(item.value)}
                    >
                        {item.label}
                        {item.badge && <span className="rounded-full bg-white/8 px-1.5 font-mono text-[10px] text-zinc-400">{item.badge}</span>}
                    </button>
                ))}
            </div>
            {panels[current]}
        </div>
    );
}
