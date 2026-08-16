import { useState } from 'react';

export function UiTreeSelect({
    options = {},
    placeholder = 'Select…',
    expanded = [],
    disabled = false,
    onChange = null,
    className = '',
    ...props
}) {
    const [value, setValue] = useState(null);
    const [open, setOpen] = useState(false);
    const [expandedBranches, setExpandedBranches] = useState(expanded);

    const toggleBranch = (branch) => {
        setExpandedBranches((current) =>
            current.includes(branch) ? current.filter((name) => name !== branch) : [...current, branch],
        );
    };

    const select = (branch, leaf) => {
        const next = `${branch} / ${leaf}`;

        setValue(next);
        onChange?.(next);
        setOpen(false);
    };

    const rootClasses = ['relative inline-block', disabled ? 'pointer-events-none opacity-40' : '', className]
        .filter(Boolean)
        .join(' ');

    return (
        <div className={rootClasses} {...props}>
            <button
                type="button"
                disabled={disabled}
                onClick={() => setOpen(!open)}
                className={`flex h-10 w-full cursor-pointer items-center justify-between gap-6 rounded-lg border bg-ink-950 px-3 text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${open ? 'border-jade-500' : 'border-white/10 hover:border-white/25'}`}
            >
                <span className={value !== null ? 'text-zinc-300' : 'text-zinc-600'}>{value ?? placeholder}</span>
                <svg className={`size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap ${open ? 'rotate-180' : ''}`} viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
            </button>
            {open && (
                <>
                    <div className="fixed inset-0 z-10" onClick={() => setOpen(false)}></div>
                    <div className="absolute top-full left-0 z-20 mt-2 w-full min-w-44 rounded-lg border border-white/10 bg-ink-900 py-1.5 shadow-lg shadow-black/40">
                        {Object.entries(options).map(([branch, leaves]) => (
                            <div key={branch}>
                                <button
                                    type="button"
                                    onClick={() => toggleBranch(branch)}
                                    className="flex w-full cursor-pointer items-center gap-1.5 px-2.5 py-1 text-sm text-zinc-300 transition-colors duration-150 hover:text-cream"
                                >
                                    <svg className={`size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap ${expandedBranches.includes(branch) ? 'rotate-90' : ''}`} viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                    {branch}
                                </button>
                                {expandedBranches.includes(branch) &&
                                    leaves.map((leaf) => (
                                        <button
                                            key={leaf}
                                            type="button"
                                            onClick={() => select(branch, leaf)}
                                            className={`flex w-full cursor-pointer items-center py-1 pr-2.5 pl-7 text-sm transition-colors duration-150 ${value === `${branch} / ${leaf}` ? 'text-jade-300' : 'text-zinc-400 hover:text-cream'}`}
                                        >
                                            {leaf}
                                        </button>
                                    ))}
                            </div>
                        ))}
                    </div>
                </>
            )}
        </div>
    );
}
