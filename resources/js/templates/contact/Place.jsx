import { Fragment } from 'react';

export function ContactPlace({ name, tag = null, lines = [], hours = [], travel = [], note = null, map = false, mapLabel = 'map of the lane', children = null }) {
    return (
        <div className="overflow-hidden rounded-xl border border-white/8 bg-ink-900">
            {map && (
                <div className="border-b border-white/5 bg-ink-950 p-3">
                    <div className="flex aspect-2/1 items-center justify-center rounded-lg border border-dashed border-white/12">
                        <span className="font-mono text-[10px] text-zinc-700">{mapLabel}</span>
                    </div>
                </div>
            )}

            <div className="p-4">
                <div className="flex items-baseline gap-2">
                    <p className="text-[13px] font-medium text-cream">{name}</p>
                    {tag && <span className="ml-auto rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">{tag}</span>}
                </div>

                {lines.length > 0 && (
                    <p className="mt-2 text-[12px]/5 text-zinc-400">
                        {lines.map((line, index) => (
                            <Fragment key={line}>
                                {line}
                                {index < lines.length - 1 && <br />}
                            </Fragment>
                        ))}
                    </p>
                )}

                {hours.length > 0 && (
                    <div className="mt-3.5 border-t border-white/5 pt-3">
                        {hours.map((entry) => (
                            <div key={entry.when} className="flex items-baseline gap-3 py-1">
                                <span className="w-20 shrink-0 font-mono text-[11px] text-zinc-500">{entry.when}</span>
                                <span className="text-[12px]/5 text-zinc-400">{entry.what}</span>
                            </div>
                        ))}
                    </div>
                )}

                {travel.length > 0 && (
                    <div className="mt-3.5 border-t border-white/5 pt-3">
                        {travel.map((entry) => (
                            <div key={entry.mode} className="flex gap-3 py-1">
                                <span className="w-20 shrink-0 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{entry.mode}</span>
                                <span className="text-[12px]/5 text-zinc-500">{entry.detail}</span>
                            </div>
                        ))}
                    </div>
                )}

                {note && <p className="mt-3.5 border-t border-white/5 pt-3 text-[12px]/5 text-zinc-500">{note}</p>}

                {children}
            </div>
        </div>
    );
}
