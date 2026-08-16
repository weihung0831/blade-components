import { useState } from 'react';

export function UiChip({ label = '', avatar = null, removable = false, onRemove = () => {}, className = '', ...props }) {
    const [removed, setRemoved] = useState(false);

    if (removed) {
        return null;
    }

    const remove = () => {
        setRemoved(true);
        onRemove();
    };

    const chipClasses = [
        'inline-flex items-center gap-1.5 rounded-full border border-white/10 bg-ink-800 py-1 text-xs',
        avatar !== null ? 'pl-1' : 'pl-2.5',
        removable ? 'pr-1.5' : 'pr-2.5',
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <span className={chipClasses} {...props}>
            {avatar !== null && (
                <span className="grid size-5 shrink-0 place-items-center rounded-full bg-jade-500 text-[9px] font-semibold text-ink-950">{avatar}</span>
            )}
            <span className="text-zinc-300">{label}</span>
            {removable && (
                <button
                    type="button"
                    onClick={remove}
                    className="grid size-4 cursor-pointer place-items-center rounded-full text-zinc-600 transition-colors duration-150 hover:bg-white/10 hover:text-cream"
                >
                    <svg className="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3l-6 6" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round"/></svg>
                </button>
            )}
        </span>
    );
}
