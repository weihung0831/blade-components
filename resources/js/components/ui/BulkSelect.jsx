import { useState } from 'react';

export function UiBulkSelect({ items = [], label = 'Name', actions = [], defaultSelected = [], className = '', ...props }) {
    const [selected, setSelected] = useState(defaultSelected);

    const normalized = items.map((item) => (typeof item === 'string' ? { label: item } : item));
    const allChecked = normalized.length > 0 && selected.length === normalized.length;
    const someChecked = selected.length > 0 && !allChecked;

    const toggleAll = () => {
        setSelected(allChecked ? [] : normalized.map((item) => item.label));
    };

    const toggleRow = (rowLabel) => {
        setSelected(selected.includes(rowLabel) ? selected.filter((value) => value !== rowLabel) : [...selected, rowLabel]);
    };

    const wrapperClasses = ['overflow-hidden rounded-xl border border-white/10 bg-ink-950', className].filter(Boolean).join(' ');

    return (
        <div className={wrapperClasses} {...props}>
            {selected.length > 0 && (
                <div className="flex items-center justify-between bg-jade-500/10 px-4 py-2 text-[13px]">
                    <span className="text-jade-300">{selected.length} selected</span>
                    <span className="flex gap-3 font-medium">
                        {actions.map((action) => (
                            <button
                                key={action.label}
                                type="button"
                                className={`cursor-pointer transition-colors duration-150 ${action.danger ? 'text-red-400 hover:text-red-300' : 'text-zinc-400 hover:text-cream'}`}
                            >
                                {action.label}
                            </button>
                        ))}
                    </span>
                </div>
            )}
            <label className="flex cursor-pointer items-center gap-3 bg-ink-800 px-4 py-2.5">
                <span className="relative grid size-4 shrink-0 place-items-center">
                    <input
                        type="checkbox"
                        checked={allChecked}
                        ref={(el) => {
                            if (el) {
                                el.indeterminate = someChecked;
                            }
                        }}
                        onChange={toggleAll}
                        className="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 indeterminate:border-jade-500 indeterminate:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    />
                    <svg className="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    <svg className="pointer-events-none absolute size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-indeterminate:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M3 6h6" stroke="currentColor" strokeWidth="2" strokeLinecap="round"/></svg>
                </span>
                <span className="font-mono text-[11px] tracking-wider text-zinc-500 uppercase">{label}</span>
            </label>
            {normalized.map((item) => (
                <label
                    key={item.label}
                    className="flex cursor-pointer items-center gap-3 border-t border-white/5 px-4 py-2.5 text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/3 has-[:checked]:bg-jade-500/8 has-[:checked]:text-zinc-200"
                >
                    <span className="relative grid size-4 shrink-0 place-items-center">
                        <input
                            type="checkbox"
                            checked={selected.includes(item.label)}
                            onChange={() => toggleRow(item.label)}
                            className="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        />
                        <svg className="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    </span>
                    <span className="flex-1 truncate">{item.label}</span>
                    {item.meta && <span className="font-mono text-xs text-zinc-600">{item.meta}</span>}
                </label>
            ))}
        </div>
    );
}
