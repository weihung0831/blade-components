import { useEffect, useRef, useState } from 'react';

export function UiInplace({ defaultValue, mono = false, onChange = null, className = '', ...props }) {
    const [value, setValue] = useState(defaultValue);
    const [draft, setDraft] = useState('');
    const [editing, setEditing] = useState(false);
    const field = useRef(null);

    useEffect(() => {
        if (editing) {
            field.current?.focus();
            field.current?.select();
        }
    }, [editing]);

    const open = () => {
        setDraft(value);
        setEditing(true);
    };

    const close = (commit) => {
        if (commit && draft.trim() !== '') {
            setValue(draft.trim());
            onChange?.(draft.trim());
        }

        setEditing(false);
    };

    return (
        <div className={`inline-flex ${className}`.trim()} {...props}>
            {editing ? (
                <input
                    ref={field}
                    type="text"
                    value={draft}
                    onChange={(event) => setDraft(event.target.value)}
                    onKeyDown={(event) => {
                        if (event.key === 'Enter') {
                            close(true);
                        }

                        if (event.key === 'Escape') {
                            close(false);
                        }
                    }}
                    onBlur={() => close(true)}
                    className={`h-8 w-48 rounded-lg border border-white/10 bg-ink-950 px-2.5 text-[13px] text-zinc-300 outline-none focus:border-jade-500 ${mono ? 'font-mono' : ''}`.trim()}
                />
            ) : (
                <button
                    type="button"
                    onClick={open}
                    className={`group flex items-center gap-2 text-[13px] outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${mono ? 'font-mono' : ''}`.trim()}
                >
                    <span className="border-b border-dashed border-white/25 pb-0.5 text-zinc-300 transition-colors duration-150 group-hover:border-jade-400/60 group-hover:text-cream">{value}</span>
                    <svg className="size-3.5 text-zinc-600 transition-colors duration-150 group-hover:text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/></svg>
                </button>
            )}
        </div>
    );
}
