import { useState } from 'react';

const control =
    'grid size-6 cursor-pointer place-items-center rounded-md border border-white/10 text-zinc-400 transition-colors duration-150 hover:border-white/25 hover:text-cream';

export function UiPickList({
    available = [],
    selected = [],
    availableLabel = null,
    selectedLabel = null,
    all = false,
    className = '',
    ...props
}) {
    const [source, setSource] = useState(available);
    const [target, setTarget] = useState(selected);
    const [picked, setPicked] = useState([]);

    const key = (side, entry) => `${side}:${entry}`;

    const toggle = (side, entry) => {
        setPicked((current) =>
            current.includes(key(side, entry))
                ? current.filter((name) => name !== key(side, entry))
                : [...current, key(side, entry)],
        );
    };

    const move = (fromSide, onlyPicked) => {
        const [from, setFrom, setTo] = fromSide === 'source' ? [source, setSource, setTarget] : [target, setTarget, setSource];
        const moving = from.filter((entry) => !onlyPicked || picked.includes(key(fromSide, entry)));

        setFrom(from.filter((entry) => !moving.includes(entry)));
        setTo((current) => [...current, ...moving]);
        setPicked((current) => current.filter((name) => !name.startsWith(`${fromSide}:`)));
    };

    const renderList = (side, entries) => (
        <div className="min-h-24 w-36 rounded-lg border border-white/10 bg-ink-950 p-1">
            {entries.map((entry) => (
                <button
                    key={entry}
                    type="button"
                    onClick={() => toggle(side, entry)}
                    className={`block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left transition-colors duration-150 ${picked.includes(key(side, entry)) ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:text-cream'}`}
                >
                    {entry}
                </button>
            ))}
        </div>
    );

    const rootClasses = ['flex items-center gap-2 text-[13px]', className].filter(Boolean).join(' ');

    return (
        <div className={rootClasses} {...props}>
            <div className="flex flex-col gap-1.5">
                {availableLabel && <span className="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{availableLabel}</span>}
                {renderList('source', source)}
            </div>
            <div className="flex flex-col gap-1.5">
                <button type="button" onClick={() => move('source', true)} className={control}>
                    <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </button>
                <button type="button" onClick={() => move('target', true)} className={control}>
                    <svg className="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </button>
                {all && (
                    <>
                        <button type="button" onClick={() => move('source', false)} className={control}>
                            <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 3 5.5 6l-3 3M6.5 3 9.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        </button>
                        <button type="button" onClick={() => move('target', false)} className={control}>
                            <svg className="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M2.5 3 5.5 6l-3 3M6.5 3 9.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        </button>
                    </>
                )}
            </div>
            <div className="flex flex-col gap-1.5">
                {selectedLabel && <span className="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{selectedLabel}</span>}
                {renderList('target', target)}
            </div>
        </div>
    );
}
