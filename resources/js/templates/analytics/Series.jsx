const ranges = ['7d', '28d', '90d'];

const show = {
    '7d': 'hidden group-data-[range=7d]/shell:block',
    '28d': 'hidden group-data-[range=28d]/shell:block',
    '90d': 'hidden group-data-[range=90d]/shell:block',
};

const flex = {
    '7d': 'hidden group-data-[range=7d]/shell:flex',
    '28d': 'hidden group-data-[range=28d]/shell:flex',
    '90d': 'hidden group-data-[range=90d]/shell:flex',
};

const path = (points, close = false) => {
    if (!points || points.length < 2) {
        return '';
    }

    const steps = points.map((point, index) => `${((index / (points.length - 1)) * 100).toFixed(2)} ${(100 - point).toFixed(2)}`);
    const line = `M${steps.join(' L')}`;

    return close ? `${line} L100 100 L0 100 Z` : line;
};

export function AnalyticsSeries({ series = [], axis = {}, scale = {}, height = 'h-64' }) {
    return (
        <div>
            <div className="flex gap-3">
                <div className="flex w-9 shrink-0 flex-col justify-between py-px text-right font-mono text-[10px] text-zinc-700">
                    {ranges.map((range) => scale[range] && (
                        <div key={range} className={`${flex[range]} h-full flex-col justify-between`}>
                            {scale[range].map((tick) => <span key={tick}>{tick}</span>)}
                        </div>
                    ))}
                </div>

                <div className={`relative min-w-0 flex-1 ${height}`}>
                    <div aria-hidden="true" className="absolute inset-0 flex flex-col justify-between">
                        {[0, 1, 2, 3].map((index) => <span key={index} className="h-px w-full bg-white/6" />)}
                    </div>

                    <svg className="relative h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
                        {series.map((line, lineIndex) => ranges.map((range) => line.points[range] && (
                            <g key={`${lineIndex}-${range}`}>
                                {line.area && (
                                    <path d={path(line.points[range], true)} className={`${show[range]} text-jade-500`} fill="currentColor" opacity="0.1" />
                                )}

                                <path
                                    d={path(line.points[range])}
                                    className={`${show[range]} ${line.muted ? 'text-zinc-500' : 'text-jade-500'}`}
                                    stroke="currentColor"
                                    strokeWidth="1.75"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    vectorEffect="non-scaling-stroke"
                                    strokeDasharray={line.dashed ? '4 3' : undefined}
                                />
                            </g>
                        )))}
                    </svg>
                </div>
            </div>

            <div className="mt-2 flex gap-3">
                <span className="w-9 shrink-0" />
                <div className="min-w-0 flex-1">
                    {ranges.map((range) => axis[range] && (
                        <div key={range} className={`${flex[range]} justify-between font-mono text-[10px] text-zinc-700`}>
                            {axis[range].map((tick) => <span key={tick}>{tick}</span>)}
                        </div>
                    ))}
                </div>
            </div>

            {series.length > 0 && (
                <div className="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 font-mono text-[11px] text-zinc-500">
                    {series.map((line) => (
                        <span key={line.label} className="inline-flex items-center gap-2">
                            <span className={`h-0.5 w-4 rounded-full ${line.muted ? 'bg-zinc-500' : 'bg-jade-500'}`} />
                            {line.label}
                        </span>
                    ))}
                </div>
            )}
        </div>
    );
}
