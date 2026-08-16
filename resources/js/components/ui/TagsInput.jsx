import { useRef, useState } from 'react';

export function UiTagsInput({ label = null, placeholder = 'Add a tag…', defaultTags = [], onChange = null, className = '', ...props }) {
    const [tags, setTags] = useState(defaultTags);
    const [draft, setDraft] = useState('');
    const field = useRef(null);

    const update = (next) => {
        setTags(next);
        onChange?.(next);
    };

    const onKeyDown = (event) => {
        if (event.key === 'Enter' || event.key === ',') {
            event.preventDefault();

            const value = draft.trim();

            if (value !== '' && !tags.includes(value)) {
                update([...tags, value]);
            }

            setDraft('');
        }

        if (event.key === 'Backspace' && draft === '') {
            update(tags.slice(0, -1));
        }
    };

    return (
        <div className={`w-64 ${className}`.trim()} {...props}>
            {label && <label className="mb-1.5 block text-xs text-zinc-500">{label}</label>}
            <div
                className="flex min-h-10 w-full cursor-text flex-wrap items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1.5 transition-colors duration-150 focus-within:border-jade-500"
                onClick={() => field.current?.focus()}
            >
                {tags.map((tag, index) => (
                    <span key={tag} className="flex items-center gap-1 rounded-md bg-jade-500/15 py-0.5 pr-1 pl-2 text-xs text-jade-300">
                        {tag}
                        <button
                            type="button"
                            aria-label={`Remove ${tag}`}
                            onClick={(event) => {
                                event.stopPropagation();
                                update(tags.filter((current, position) => position !== index));
                            }}
                            className="grid size-4 place-items-center rounded text-jade-500/70 transition-colors duration-150 outline-none hover:text-jade-300 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            <svg className="size-2.5" viewBox="0 0 16 16" fill="none"><path d="m4 4 8 8M12 4l-8 8" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round"/></svg>
                        </button>
                    </span>
                ))}
                <input
                    ref={field}
                    type="text"
                    placeholder={placeholder}
                    value={draft}
                    onChange={(event) => setDraft(event.target.value)}
                    onKeyDown={onKeyDown}
                    className="h-6 min-w-24 flex-1 bg-transparent text-sm text-zinc-300 outline-none placeholder:text-zinc-600"
                />
            </div>
        </div>
    );
}
