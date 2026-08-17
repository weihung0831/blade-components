import { ProductShell } from './Shell';
import { ProductSpecRow } from './SpecRow';

const groups = [
    {
        label: 'Burr set',
        rows: [
            { label: 'Diameter', value: '83 mm flat', note: 'Italian tool steel' },
            { label: 'Coating', value: 'Titanium nitride', note: '2,400 HV' },
            { label: 'Rated life', value: '1,400 kg', note: 'filter roast, 20 g doses' },
            { label: 'Alignment', value: 'Shimmed at 0.02 mm', note: 'measured, not assumed' },
        ],
    },
    {
        label: 'Grind adjustment',
        rows: [
            { label: 'Range', value: '0–120 detents' },
            { label: 'Per step', value: '8.5 µm', note: 'linear across the range' },
            { label: 'Full range', value: '2.1 turns', note: 'espresso to press' },
            { label: 'Zero point', value: 'User settable', note: 'burr chirp method' },
        ],
    },
    {
        label: 'Motor and drive',
        rows: [
            { label: 'Type', value: 'Brushless DC, 250 W' },
            { label: 'Speed', value: '1,400 rpm', note: 'held under load' },
            { label: 'Throughput', value: '3.1 g/s', note: 'espresso, medium roast' },
            { label: 'Duty cycle', value: 'Continuous', note: 'thermal cut-out at 78 °C' },
            { label: 'Noise', value: '62 dB(A)', note: 'one metre, running empty' },
        ],
    },
    {
        label: 'Physical',
        rows: [
            { label: 'Dimensions', value: '128 × 232 × 380 mm' },
            { label: 'Weight', value: '4.8 kg' },
            { label: 'Body', value: 'Anodised aluminium', note: '3 mm wall' },
            { label: 'Retention', value: '< 0.1 g', note: 'knocker and anti-static ring' },
            { label: 'Hopper', value: '60 g single-dose', note: '1.2 kg bin sold separately' },
        ],
    },
    {
        label: 'Electrical',
        rows: [
            { label: 'Input', value: '100–240 V, 50/60 Hz' },
            { label: 'Plug', value: 'Swappable C13', note: 'TW, EU, UK, US in stock' },
            { label: 'Standby', value: '0.4 W' },
            { label: 'Certification', value: 'BSMI · CE · FCC' },
        ],
    },
];

const range = [
    { use: 'Espresso', steps: '8–24', dose: '18 g', time: '6.2 s', note: 'ristretto sits nearer 8' },
    { use: 'Moka pot', steps: '26–34', dose: '16 g', time: '5.4 s', note: '' },
    { use: 'Aeropress', steps: '34–46', dose: '15 g', time: '4.8 s', note: 'inverted, 2:30' },
    { use: 'V60', steps: '46–62', dose: '22 g', time: '6.9 s', note: '' },
    { use: 'Batch brew', steps: '58–72', dose: '55 g', time: '17.4 s', note: '1 L, 1:16' },
    { use: 'French press', steps: '88–110', dose: '30 g', time: '9.1 s', note: '' },
    { use: 'Cold brew', steps: '100–120', dose: '80 g', time: '25.8 s', note: '16 h, 1:8' },
];

const compare = [
    { label: 'Burr diameter', values: ['83 mm flat', '63 mm flat'] },
    { label: 'Steps', values: ['120', '60'] },
    { label: 'Espresso and filter without swapping burrs', values: [true, true] },
    { label: 'Single-dose hopper included', values: [true, false] },
    { label: 'Anti-static ring', values: [true, false] },
    { label: 'Portafilter fork', values: ['58 mm, adjustable', '58 mm, fixed'] },
    { label: 'Bin hopper option', values: ['1.2 kg', false] },
    { label: 'Shims sold as parts', values: [true, true] },
    { label: 'Weight', values: ['4.8 kg', '3.2 kg'] },
];

const service = [
    { label: 'Brush the chute', every: 'weekly', note: 'brush in the box' },
    { label: 'Pull the burrs and clean', every: '25 kg', note: 'two screws, about a minute' },
    { label: 'Check alignment', every: '150 kg', note: 'shim kit, $28' },
    { label: 'Replace burr set', every: '1,400 kg', note: 'burrs, $210' },
];

const files = [
    ['Spec sheet', 'PDF · 240 kB'],
    ['Exploded view and parts list', 'PDF · 1.1 MB'],
    ['Step chart, printable', 'PDF · 90 kB'],
    ['CAD, front and side', 'DXF · 380 kB'],
];

export function ProductSpecs() {
    return (
        <ProductShell active="Specs">
            <div className="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h1 className="text-2xl font-semibold tracking-tight text-cream">Every number we measure, and how we measured it</h1>
                    <p className="mt-2 max-w-xl text-sm/6 text-zinc-500">
                        Figures come off the units we ship, not off a prototype. Where a number depends on the coffee, the bean and the dose are written next to it.
                    </p>
                </div>
                <span className="font-mono text-[11px] text-zinc-600">revision D · Jan 2026</span>
            </div>

            <div className="mt-8 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_20rem]">
                <div className="flex flex-col gap-6">
                    {groups.map((group) => (
                        <section key={group.label} className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                            <div className="flex items-baseline justify-between gap-4 border-b border-white/5 px-5 py-3">
                                <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">{group.label}</h2>
                                <span className="font-mono text-[10px] text-zinc-700">{String(group.rows.length).padStart(2, '0')}</span>
                            </div>

                            <div className="flex flex-col divide-y divide-white/5">
                                {group.rows.map((row) => (
                                    <ProductSpecRow key={row.label} label={row.label} value={row.value} note={row.note ?? null} />
                                ))}
                            </div>
                        </section>
                    ))}
                </div>

                <div className="flex flex-col gap-4 lg:sticky lg:top-32">
                    <div className="dot-grid overflow-hidden rounded-2xl border border-white/8 bg-ink-900 p-6">
                        <div className="flex aspect-4/3 w-full flex-col items-center justify-center gap-3 rounded-xl border border-dashed border-white/12">
                            <svg className="size-8 text-zinc-700" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" strokeWidth="1.3"/>
                                <circle cx="8.5" cy="10" r="1.5" stroke="currentColor" strokeWidth="1.3"/>
                                <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/>
                            </svg>
                            <p className="font-mono text-[11px] text-zinc-500">dimension drawing</p>
                            <p className="font-mono text-[10px] text-zinc-700">front and side · 1600 × 1200</p>
                        </div>
                    </div>

                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Warranty</p>
                        <p className="mt-2.5 text-[13px]/6 text-zinc-400">Two years on the machine, five on the burr set, from the ship date on your order. Commercial use keeps the same terms.</p>
                        <p className="mt-3 font-mono text-[10px]/5 text-zinc-600">Out of warranty, a burr swap and realignment is $140 plus parts, quoted before we start.</p>
                    </div>

                    <div className="flex flex-col divide-y divide-white/5 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        {files.map((file) => (
                            <a key={file[0]} href="#" className="flex items-center gap-3 px-4 py-3 transition-colors duration-150 hover:bg-white/4">
                                <svg className="size-3.5 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none"><path d="M8 2.5v8M4.5 7 8 10.5 11.5 7M3 13h10" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                <span className="min-w-0 flex-1 truncate text-[13px] text-zinc-300">{file[0]}</span>
                                <span className="shrink-0 font-mono text-[10px] text-zinc-600">{file[1]}</span>
                            </a>
                        ))}
                    </div>
                </div>
            </div>

            <section className="mt-12 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div className="flex flex-wrap items-end justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-4">
                    <div>
                        <h2 className="text-base font-medium text-cream">Where to start on the dial</h2>
                        <p className="mt-1 text-[13px]/6 text-zinc-500">Starting points from the workshop, on a medium roast rested five days. Yours will land within a few steps of these.</p>
                    </div>
                    <span className="font-mono text-[10px] text-zinc-600">grind time at 1,400 rpm</span>
                </div>

                <div className="overflow-x-auto">
                    <table className="w-full border-separate border-spacing-0 text-left">
                        <thead>
                            <tr>
                                <th scope="col" className="border-b border-white/5 px-5 py-2.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Brew</th>
                                <th scope="col" className="border-b border-white/5 px-5 py-2.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Steps</th>
                                <th scope="col" className="border-b border-white/5 px-5 py-2.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Dose</th>
                                <th scope="col" className="border-b border-white/5 px-5 py-2.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Grind time</th>
                                <th scope="col" className="hidden border-b border-white/5 px-5 py-2.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase sm:table-cell">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            {range.map((row) => (
                                <tr key={row.use} className="transition-colors duration-150 hover:bg-white/3">
                                    <th scope="row" className="border-b border-white/5 px-5 py-3 text-[13px] font-normal text-zinc-300">{row.use}</th>
                                    <td className="border-b border-white/5 px-5 py-3">
                                        <span className="rounded-md bg-jade-500/12 px-2 py-0.5 font-mono text-[11px] text-jade-300">{row.steps}</span>
                                    </td>
                                    <td className="border-b border-white/5 px-5 py-3 font-mono text-[13px] text-zinc-400">{row.dose}</td>
                                    <td className="border-b border-white/5 px-5 py-3 font-mono text-[13px] text-zinc-400">{row.time}</td>
                                    <td className="hidden border-b border-white/5 px-5 py-3 font-mono text-[11px] text-zinc-600 sm:table-cell">{row.note}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </section>

            <section className="mt-12 grid items-start gap-6 lg:grid-cols-2">
                <div className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div className="border-b border-white/5 px-5 py-4">
                        <h2 className="text-base font-medium text-cream">Against the 63</h2>
                        <p className="mt-1 text-[13px]/6 text-zinc-500">The smaller one is the same grinder with less burr and fewer steps. Below about 4 kg a week, it is the honest answer.</p>
                    </div>

                    <table className="w-full border-separate border-spacing-0 text-left">
                        <thead>
                            <tr>
                                <th scope="col" className="border-b border-white/5 px-5 py-2.5"></th>
                                <th scope="col" className="border-b border-jade-500/20 bg-jade-500/6 px-4 py-2.5 font-mono text-[10px] tracking-wider text-jade-300 uppercase">EG-83</th>
                                <th scope="col" className="border-b border-white/5 px-4 py-2.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">EG-63</th>
                            </tr>
                        </thead>
                        <tbody>
                            {compare.map((row) => (
                                <tr key={row.label}>
                                    <th scope="row" className="border-b border-white/5 px-5 py-3 text-[13px] font-normal text-zinc-400">{row.label}</th>
                                    {row.values.map((value, index) => (
                                        <td key={index} className={`border-b px-4 py-3 align-middle ${index === 0 ? 'border-jade-500/20 bg-jade-500/6' : 'border-white/5'}`}>
                                            {value === true && (
                                                <svg className="size-3.5 text-jade-400" viewBox="0 0 12 12" fill="none" role="img" aria-label="Yes">
                                                    <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round"/>
                                                </svg>
                                            )}
                                            {value === false && <span className="block h-3.5 w-3 border-b border-white/15" role="img" aria-label="No" />}
                                            {typeof value === 'string' && <span className="font-mono text-[12px] text-zinc-400">{value}</span>}
                                        </td>
                                    ))}
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                <div className="flex flex-col gap-6">
                    <div className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                        <div className="border-b border-white/5 px-5 py-4">
                            <h2 className="text-base font-medium text-cream">What it asks of you</h2>
                            <p className="mt-1 text-[13px]/6 text-zinc-500">Measured in coffee through the burrs, not in months. A busy bar hits these in a fraction of the time a home setup does.</p>
                        </div>

                        <div className="flex flex-col divide-y divide-white/5">
                            {service.map((item) => (
                                <div key={item.label} className="flex items-baseline gap-4 px-5 py-3">
                                    <span className="flex-1 text-[13px] text-zinc-300">{item.label}</span>
                                    <span className="shrink-0 font-mono text-[12px] text-jade-400">{item.every}</span>
                                    <span className="hidden w-32 shrink-0 text-right font-mono text-[10px] text-zinc-600 sm:block">{item.note}</span>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Still deciding</p>
                        <p className="mt-2.5 text-[13px]/6 text-zinc-400">
                            Three hundred people wrote about living with this thing — noise at 6 am, how it behaves on a light roast, what the chute does after a month.
                        </p>
                        <a href="/templates/product/screens/reviews" target="_top"
                            className="mt-4 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Read the reviews →</a>
                    </div>
                </div>
            </section>
        </ProductShell>
    );
}
