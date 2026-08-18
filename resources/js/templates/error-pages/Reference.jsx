import { useState } from 'react';

export function ErrorPagesReference({ id, when, region, build, note, tone = 'quiet' }) {
    const [label, setLabel] = useState('copy all four');

    const rows = [
        { label: 'reference', value: id },
        { label: 'happened', value: when },
        ...(region ? [{ label: 'served from', value: region }] : []),
        ...(build ? [{ label: 'running', value: build }] : []),
    ];

    const copy = () => {
        navigator.clipboard?.writeText(rows.map((row) => `${row.label}: ${row.value}`).join('  '));
        setLabel('on your clipboard');
        setTimeout(() => setLabel('copy all four'), 1600);
    };

    return (
        <div className={`overflow-hidden rounded-xl border bg-ink-900 ${tone === 'fault' ? 'border-red-400/25' : 'border-white/8'}`}>
            <div className="flex items-center gap-3 border-b border-white/5 px-3.5 py-2">
                <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What to quote</p>

                <button
                    type="button"
                    onClick={copy}
                    className="ml-auto inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2 py-1 font-mono text-[10px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    <svg className="size-3" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="8" height="8" rx="1.5" stroke="currentColor" strokeWidth="1.3"/><path d="M10.5 5.5v-1a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h1" stroke="currentColor" strokeWidth="1.3"/></svg>
                    {label}
                </button>
            </div>

            <dl className="divide-y divide-white/5">
                {rows.map((row) => (
                    <div key={row.label} className="flex items-baseline gap-3 px-3.5 py-2">
                        <dt className="w-24 shrink-0 font-mono text-[10px] text-zinc-700">{row.label}</dt>
                        <dd className="min-w-0 flex-1 font-mono text-[11px] break-all text-zinc-300">{row.value}</dd>
                    </div>
                ))}
            </dl>

            {note && <p className="border-t border-white/5 px-3.5 py-2.5 text-[11px]/5 text-zinc-600">{note}</p>}
        </div>
    );
}
