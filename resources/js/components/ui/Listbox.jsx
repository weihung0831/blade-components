import { useState } from 'react';

export function UiListbox({ options = [], multiple = false, defaultSelected = null, onChange = null, className = '', ...props }) {
    const [selected, setSelected] = useState(defaultSelected ?? (multiple ? [] : null));

    const isSelected = (option) => (multiple ? selected.includes(option) : selected === option);

    const toggle = (option) => {
        const next = multiple
            ? selected.includes(option)
                ? selected.filter((value) => value !== option)
                : [...selected, option]
            : option;

        setSelected(next);
        onChange?.(next);
    };

    return (
        <div
            role="listbox"
            aria-multiselectable={multiple || undefined}
            className={['w-full rounded-lg border border-white/10 bg-ink-950 p-1', className].filter(Boolean).join(' ')}
            {...props}
        >
            {options.map((option) => (
                <button
                    key={option}
                    type="button"
                    role="option"
                    aria-selected={isSelected(option)}
                    onClick={() => toggle(option)}
                    className={`flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm transition-colors duration-150 ${isSelected(option) ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'}`}
                >
                    {option}
                    <svg className={`size-3.5 shrink-0 transition-opacity duration-150 ${isSelected(option) ? 'opacity-100' : 'opacity-0'}`} viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </button>
            ))}
        </div>
    );
}
