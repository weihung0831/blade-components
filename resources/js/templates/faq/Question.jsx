import { useState } from 'react';

const pad = (value) => String(value).padStart(2, '0');

export function FaqQuestion({
    number = null,
    question,
    topic = null,
    helpful = null,
    votes = 0,
    updated = null,
    open = false,
    stale = false,
    footer = null,
    children,
}) {
    const [isOpen, setIsOpen] = useState(open);

    const tone = helpful === null
        ? 'text-zinc-600'
        : helpful >= 85 ? 'text-jade-300' : helpful >= 65 ? 'text-amber-300' : 'text-red-300';

    return (
        <details
            className="group/question relative border-b border-white/5"
            open={isOpen}
            onToggle={(event) => setIsOpen(event.currentTarget.open)}
        >
            <span aria-hidden="true" className={`absolute inset-y-0 left-0 w-0.5 bg-jade-400 transition-opacity duration-150 ${isOpen ? 'opacity-100' : 'opacity-0'}`}></span>

            <summary className="flex cursor-pointer list-none items-baseline gap-3 py-3.5 pr-4 pl-4 outline-none transition-colors duration-150 hover:bg-white/4 focus-visible:bg-white/4 [&::-webkit-details-marker]:hidden">
                {number !== null && <span className={`w-6 shrink-0 font-mono text-[11px] ${isOpen ? 'text-jade-400' : 'text-zinc-700'}`}>{pad(number)}</span>}

                <span className="min-w-0 flex-1">
                    <span className={`block text-[13px]/5 ${isOpen ? 'text-cream' : 'text-zinc-300'}`}>{question}</span>

                    <span className="mt-1.5 flex flex-wrap items-center gap-x-2.5 gap-y-1">
                        {topic && <span className="font-mono text-[10px] text-zinc-700">{topic}</span>}

                        {helpful !== null && (
                            <>
                                <span className={`font-mono text-[10px] ${tone}`}>{helpful}% said this helped</span>
                                <span className="font-mono text-[10px] text-zinc-700">of {votes}</span>
                            </>
                        )}

                        {stale && <span className="rounded border border-amber-400/30 px-1 font-mono text-[9px] text-amber-300/80">needs a rewrite</span>}
                    </span>
                </span>

                <span className="flex shrink-0 items-center gap-3">
                    {updated && <span className="hidden font-mono text-[10px] text-zinc-700 sm:block">{updated}</span>}

                    <svg className={`size-3.5 shrink-0 transition-transform duration-200 ${isOpen ? 'rotate-45 text-jade-400' : 'text-zinc-600'}`} viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M8 3.5v9M3.5 8h9" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                    </svg>
                </span>
            </summary>

            <div className={`pt-0.5 pr-4 pb-5 pl-4 ${number !== null ? 'sm:pl-13' : ''}`}>
                <div className="max-w-2xl space-y-3 text-[13px]/6 text-zinc-400">{children}</div>

                {footer && <div className="mt-4 max-w-2xl">{footer}</div>}
            </div>
        </details>
    );
}
