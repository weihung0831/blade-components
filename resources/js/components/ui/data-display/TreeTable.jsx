import { Fragment, useState } from 'react';

export function UiTreeTable({ columns = [], rows = [], depth = 0, className = '', ...props }) {
    const [openState, setOpenState] = useState(() => rows.map((row) => Boolean(row.open)));

    const toggle = (index) => {
        setOpenState((current) => current.map((open, i) => (i === index ? !open : open)));
    };

    if (depth === 0) {
        const rootClasses = ['w-full overflow-hidden rounded-lg border border-white/10 bg-ink-950 text-[13px]', className]
            .filter(Boolean)
            .join(' ');

        return (
            <div className={rootClasses} {...props}>
                <div className="flex items-center gap-4 bg-ink-800 px-3 py-1.5 font-mono text-[10px] tracking-wider text-zinc-500 uppercase">
                    {columns.map((column, index) => (
                        <span key={column} className={index === 0 ? 'flex-1' : 'w-20 text-right'}>
                            {column}
                        </span>
                    ))}
                </div>
                <UiTreeTable rows={rows} depth={1} />
            </div>
        );
    }

    return rows.map((row, index) =>
        row.children?.length ? (
            <Fragment key={row.cells[0]}>
                <button
                    type="button"
                    onClick={() => toggle(index)}
                    className="flex w-full cursor-pointer items-center gap-4 border-t border-white/5 px-3 py-1.5 transition-colors duration-150 hover:bg-white/5"
                >
                    <span className="flex flex-1 items-center gap-1.5 text-zinc-300" style={{ paddingLeft: `${(depth - 1) * 16}px` }}>
                        <svg className={`size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap ${openState[index] ? 'rotate-90' : ''}`} viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        {row.cells[0]}
                    </span>
                    {row.cells.slice(1).map((cell) => (
                        <span key={cell} className="w-20 text-right font-mono text-[10px] text-zinc-500">
                            {cell}
                        </span>
                    ))}
                </button>
                {openState[index] && <UiTreeTable rows={row.children} depth={depth + 1} />}
            </Fragment>
        ) : (
            <div key={row.cells[0]} className="flex items-center gap-4 border-t border-white/5 px-3 py-1.5">
                <span className="flex-1 text-zinc-400" style={{ paddingLeft: `${(depth - 1) * 16}px` }}>
                    {row.cells[0]}
                </span>
                {row.cells.slice(1).map((cell) => (
                    <span key={cell} className="w-20 text-right font-mono text-[10px] text-zinc-500">
                        {cell}
                    </span>
                ))}
            </div>
        ),
    );
}
