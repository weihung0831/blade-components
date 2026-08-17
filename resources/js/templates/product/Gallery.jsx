import { useState } from 'react';

const shots = [
    { key: 'front', label: 'Front', meta: '01', caption: 'front view' },
    { key: 'burrs', label: 'Burr set', meta: '02', caption: '83 mm burr set' },
    { key: 'dial', label: 'Dial', meta: '03', caption: 'grind dial at 042' },
    { key: 'box', label: 'In the box', meta: '04', caption: 'what ships in the box' },
];

export function ProductGallery() {
    const [shot, setShot] = useState('front');

    return (
        <div className="group/gallery flex flex-col gap-3" data-shot={shot}>
            <div className="dot-grid relative aspect-square overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <span aria-hidden="true" className="pointer-events-none absolute -top-16 left-1/2 size-72 -translate-x-1/2 rounded-full bg-jade-500/8 blur-3xl"></span>

                <span className="absolute top-4 left-4 z-10 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">
                    EG-83
                    <span className="hidden group-data-[finish=graphite]/shell:inline">· graphite</span>
                    <span className="hidden group-data-[finish=cream]/shell:inline">· cream</span>
                    <span className="hidden group-data-[finish=jade]/shell:inline">· jade</span>
                </span>

                <span className="absolute top-4 right-4 z-10 rounded-full border border-white/10 bg-ink-950/70 px-2 py-0.5 font-mono text-[10px] text-zinc-500">1:2 scale</span>

                {shots.map((item) => (
                    <div
                        key={item.key}
                        className={`pointer-events-none absolute inset-0 px-6 pt-12 pb-6 transition-opacity duration-300 ${shot === item.key ? 'opacity-100' : 'opacity-0'}`}
                    >
                        <div className="flex size-full flex-col items-center justify-center gap-3 rounded-2xl border border-dashed border-white/12">
                            <svg className="size-8 text-zinc-700" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" strokeWidth="1.3"/>
                                <circle cx="8.5" cy="10" r="1.5" stroke="currentColor" strokeWidth="1.3"/>
                                <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/>
                            </svg>
                            <p className="font-mono text-[11px] text-zinc-500">{item.caption}</p>
                            <p className="font-mono text-[10px] text-zinc-700">1200 × 1200 · webp</p>
                        </div>
                    </div>
                ))}
            </div>

            <div className="grid grid-cols-4 gap-2">
                {shots.map((item) => (
                    <button
                        key={item.key}
                        type="button"
                        onClick={() => setShot(item.key)}
                        className={`flex flex-col gap-1 rounded-xl border bg-ink-900 px-3 py-2 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${shot === item.key ? 'border-jade-500/60 text-cream' : 'border-white/8 text-zinc-500 hover:border-white/20'}`}
                    >
                        <span className="font-mono text-[10px] text-zinc-600">{item.meta}</span>
                        <span className="truncate text-[12px]">{item.label}</span>
                    </button>
                ))}
            </div>
        </div>
    );
}
