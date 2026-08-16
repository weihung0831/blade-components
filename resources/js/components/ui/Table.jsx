import { useState } from 'react';

const dots = {
    jade: 'bg-jade-500',
    zinc: 'bg-zinc-600',
};

const dotText = {
    jade: 'text-jade-400',
    zinc: 'text-zinc-500',
};

const isStatus = (cell) => cell !== null && typeof cell === 'object';

const isSortable = (column) => column.sortable ?? true;

const cellText = (cell) => String((isStatus(cell) ? cell.text : cell) ?? '');

export function UiTable({ columns = [], rows = [], striped = false, hover = false, className = '', ...props }) {
    const [sort, setSort] = useState({ key: null, dir: 'asc' });

    const toggleSort = (column) => {
        if (!isSortable(column)) {
            return;
        }

        setSort((current) =>
            current.key === column.key
                ? { key: column.key, dir: current.dir === 'asc' ? 'desc' : 'asc' }
                : { key: column.key, dir: 'asc' },
        );
    };

    const sortedRows =
        sort.key === null
            ? rows
            : [...rows].sort((a, b) => {
                  const x = cellText(a[sort.key]);
                  const y = cellText(b[sort.key]);
                  const nx = parseFloat(x.replace(/[$,]/g, ''));
                  const ny = parseFloat(y.replace(/[$,]/g, ''));
                  const order = Number.isNaN(nx) || Number.isNaN(ny) ? x.localeCompare(y) : nx - ny;

                  return sort.dir === 'asc' ? order : -order;
              });

    const wrapperClasses = ['overflow-x-auto rounded-xl border border-white/10 bg-ink-950', className].filter(Boolean).join(' ');

    return (
        <div className={wrapperClasses} {...props}>
            <table className="w-full text-left text-sm">
                <thead>
                    <tr className="bg-ink-800">
                        {columns.map((column) => (
                            <th
                                key={column.key}
                                data-dir={sort.key === column.key ? sort.dir : undefined}
                                onClick={() => toggleSort(column)}
                                className={[
                                    'px-4 py-2.5 font-mono text-[11px] font-normal tracking-wider text-zinc-500 uppercase',
                                    column.align === 'right' && 'text-right',
                                    isSortable(column) &&
                                        'group/th cursor-pointer transition-colors duration-150 select-none hover:text-zinc-300 data-[dir]:text-jade-400',
                                ]
                                    .filter(Boolean)
                                    .join(' ')}
                            >
                                {isSortable(column) ? (
                                    <span className="inline-flex items-center gap-1">
                                        {column.label}
                                        <svg className="size-3 shrink-0 opacity-0 transition-all duration-150 ease-snap group-hover/th:opacity-60 group-data-[dir]/th:opacity-100 group-data-[dir=desc]/th:rotate-180" viewBox="0 0 12 12" fill="none"><path d="m3 7.5 3-3 3 3" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                    </span>
                                ) : (
                                    column.label
                                )}
                            </th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {sortedRows.map((row, index) => (
                        <tr
                            key={index}
                            className={[
                                'border-t border-white/5',
                                striped && index % 2 === 1 && 'bg-white/3',
                                hover && 'transition-colors duration-150 hover:bg-white/5',
                            ]
                                .filter(Boolean)
                                .join(' ')}
                        >
                            {columns.map((column) => {
                                const cell = row[column.key];

                                return (
                                    <td
                                        key={column.key}
                                        className={['px-4 py-2.5 text-zinc-300', column.align === 'right' && 'text-right font-mono text-[13px]']
                                            .filter(Boolean)
                                            .join(' ')}
                                    >
                                        {isStatus(cell) ? (
                                            <span className={`inline-flex items-center gap-1.5 text-[13px] ${dotText[cell.dot] ?? dotText.zinc}`}>
                                                <span className={`size-1.5 rounded-full ${dots[cell.dot] ?? dots.zinc}`} />
                                                {cell.text}
                                            </span>
                                        ) : (
                                            cell
                                        )}
                                    </td>
                                );
                            })}
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
