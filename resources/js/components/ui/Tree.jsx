import { useState } from 'react';

export function UiTree({ nodes = [], depth = 0, className = '', ...props }) {
    const [openState, setOpenState] = useState(() => nodes.map((node) => Boolean(node.open)));

    const toggle = (index) => {
        setOpenState((current) => current.map((open, i) => (i === index ? !open : open)));
    };

    const rootClasses = [depth === 0 ? 'flex flex-col text-[13px]' : '', className].filter(Boolean).join(' ');

    return (
        <div className={rootClasses} {...props}>
            {nodes.map((node, index) =>
                node.children?.length ? (
                    <div key={node.label}>
                        <button
                            type="button"
                            onClick={() => toggle(index)}
                            className="flex w-full cursor-pointer items-center gap-1.5 rounded-md px-2 py-1 text-left text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream"
                        >
                            <svg className={`size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap ${openState[index] ? 'rotate-90' : ''}`} viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                            {node.label}
                        </button>
                        {openState[index] && (
                            <div className="ml-3.5 border-l border-white/10 pl-1.5">
                                <UiTree nodes={node.children} depth={depth + 1} />
                            </div>
                        )}
                    </div>
                ) : (
                    <div
                        key={node.label}
                        className={`flex items-center gap-1.5 rounded-md px-2 py-1 pl-6.5 transition-colors duration-150 ${node.active ? 'text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'}`}
                    >
                        {node.label}
                    </div>
                ),
            )}
        </div>
    );
}
