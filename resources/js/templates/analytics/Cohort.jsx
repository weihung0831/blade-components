const fill = (value) => (0.1 + (value / 100) * 0.52).toFixed(3);

export function AnalyticsCohort({ columns = [], rows = [], className = '' }) {
    return (
        <div className={`overflow-x-auto ${className}`}>
            <table className="w-full min-w-2xl border-separate border-spacing-0 text-left">
                <thead>
                    <tr>
                        <th scope="col" className="sticky left-0 z-10 bg-ink-800 pr-3 pb-2 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Cohort</th>
                        <th scope="col" className="pr-3 pb-2 text-right font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Users</th>
                        {columns.map((column) => (
                            <th key={column} scope="col" className="pb-2 text-center font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{column}</th>
                        ))}
                    </tr>
                </thead>

                <tbody>
                    {rows.map((row) => (
                        <tr key={row.label}>
                            <th scope="row" className="sticky left-0 z-10 bg-ink-800 py-0.5 pr-3 text-[13px] font-normal whitespace-nowrap text-zinc-300">{row.label}</th>
                            <td className="py-0.5 pr-3 text-right font-mono text-[11px] text-zinc-500">{row.size}</td>

                            {row.values.map((value, index) => (
                                <td key={index} className="p-0.5">
                                    {value === null ? (
                                        <div className="h-9 rounded-md border border-dashed border-white/8" />
                                    ) : (
                                        <div className="relative grid h-9 place-items-center overflow-hidden rounded-md bg-ink-950">
                                            <span aria-hidden="true" className="absolute inset-0 bg-jade-500" style={{ opacity: fill(value) }} />
                                            <span className="relative font-mono text-[11px] text-cream">{value}%</span>
                                        </div>
                                    )}
                                </td>
                            ))}
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
