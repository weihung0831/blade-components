import { useEffect, useState } from 'react';
import { BlogShell } from './Shell';
import { BlogByline } from './Byline';
import { BlogSubscribe } from './Subscribe';

const SECTIONS = [
    { id: 'what-came-back', label: 'What came back' },
    { id: 'measuring', label: 'How we measured' },
    { id: 'numbers', label: 'The numbers' },
    { id: 'tuesday', label: 'Four seats, one Tuesday' },
    { id: 'changed', label: 'What changed on the line' },
    { id: 'yours', label: 'If yours is one of them' },
];

const ROWS = [
    { model: 'EG-83', units: 214, runout: '0.11 mm', swap: 'Seat plate, 61%' },
    { model: 'EG-83 Pro', units: 96, runout: '0.09 mm', swap: 'Seat plate, 54%' },
    { model: 'EG-64', units: 74, runout: '0.14 mm', swap: 'Burr set, 38%' },
    { model: 'Older, pre-2023', units: 28, runout: '0.22 mm', swap: 'Whole carrier, 79%' },
];

const RELATED = [
    { title: 'The 0.05 mm shim that closed a five-year complaint', meta: 'Workshop · 9 min', direction: 'Earlier' },
    { title: 'A bench test you can run with a phone and a spirit level', meta: 'Method · 5 min', direction: 'Next' },
];

const TYPE_SIZES = { s: 'text-[13px]/7', m: 'text-[15px]/8', l: 'text-[17px]/9' };

const offsetOf = (element, scroller) => element.getBoundingClientRect().top - scroller.getBoundingClientRect().top + scroller.scrollTop;

export function BlogArticle() {
    const [type, setType] = useState('m');
    const [progress, setProgress] = useState(0);
    const [current, setCurrent] = useState(SECTIONS[0].id);

    useEffect(() => {
        const scroller = document.querySelector('[data-blog-scroll]');

        if (!scroller) {
            return undefined;
        }

        const paint = () => {
            const travelled = scroller.scrollHeight - scroller.clientHeight;

            setProgress(travelled > 0 ? Math.min(100, (scroller.scrollTop / travelled) * 100) : 0);

            const line = scroller.scrollTop + scroller.clientHeight * 0.3;
            const passed = SECTIONS.map((section) => document.getElementById(section.id))
                .filter((element) => element && offsetOf(element, scroller) <= line);

            setCurrent(passed.length > 0 ? passed[passed.length - 1].id : SECTIONS[0].id);
        };

        scroller.addEventListener('scroll', paint, { passive: true });
        paint();

        return () => scroller.removeEventListener('scroll', paint);
    }, []);

    const jump = (id) => {
        const scroller = document.querySelector('[data-blog-scroll]');

        scroller?.scrollTo({ top: offsetOf(document.getElementById(id), scroller) - 72, behavior: 'smooth' });
    };

    return (
        <BlogShell active="Latest" progress={progress}>
            <article>
                <a
                    href="/templates/blog/screens/latest"
                    target="_top"
                    className="inline-flex items-center gap-1.5 font-mono text-[11px] text-zinc-600 transition-colors duration-150 hover:text-cream"
                >
                    <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M7 3 4 6l3 3" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    All notes
                </a>

                <header className="mt-5 max-w-2xl">
                    <div className="flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span className="rounded-md border border-jade-500/40 bg-jade-500/10 px-2 py-0.5 font-mono text-[10px] tracking-wider text-jade-300 uppercase">Machines</span>
                        <span className="font-mono text-[10px] text-zinc-600">Note 22 · 12 Aug 2026</span>
                    </div>

                    <h1 className="mt-4 text-3xl/10 font-semibold tracking-tight text-cream sm:text-4xl/12">
                        What 412 returned grinders told us about alignment
                    </h1>

                    <p className="mt-4 text-base/7 text-zinc-400">
                        Every unit that came back last year was measured before anyone touched it. The burrs were rarely the fault. The seat underneath them
                        usually was, and four of those seats left the workshop on the same Tuesday.
                    </p>
                </header>

                <div className="mt-7 flex flex-wrap items-center justify-between gap-4 border-y border-white/5 py-4">
                    <BlogByline name="Mei Tsai" role="workshop lead" date="12 Aug 2026" read={14} />

                    <div className="flex items-center gap-3">
                        <span className="hidden font-mono text-[10px] text-zinc-600 sm:block">Type size</span>
                        <div className="flex items-center gap-0.5 rounded-lg bg-ink-900 p-0.5">
                            {[{ value: 's', label: 'S' }, { value: 'm', label: 'M' }, { value: 'l', label: 'L' }].map((option) => (
                                <label
                                    key={option.value}
                                    className="grid size-7 cursor-pointer place-items-center rounded-md font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/10 has-[:checked]:text-cream"
                                >
                                    <input
                                        type="radio"
                                        name="type-size"
                                        value={option.value}
                                        checked={type === option.value}
                                        onChange={() => setType(option.value)}
                                        className="sr-only"
                                    />
                                    {option.label}
                                    <span className="sr-only">Type size {option.label}</span>
                                </label>
                            ))}
                        </div>
                    </div>
                </div>

                <div className="mt-8 grid items-start gap-10 lg:grid-cols-[13rem_minmax(0,1fr)]">
                    <nav className="hidden lg:sticky lg:top-20 lg:block">
                        <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">On this page</p>
                        <ul className="mt-3 flex flex-col gap-0.5 border-l border-white/8">
                            {SECTIONS.map((section) => (
                                <li key={section.id}>
                                    <a
                                        href={`#${section.id}`}
                                        onClick={(event) => {
                                            event.preventDefault();
                                            jump(section.id);
                                        }}
                                        className={`-ml-px block border-l py-1.5 pl-3 text-[13px]/5 transition-colors duration-150 hover:text-zinc-300 ${
                                            current === section.id ? 'border-jade-500 text-jade-300' : 'border-transparent text-zinc-600'
                                        }`}
                                    >
                                        {section.label}
                                    </a>
                                </li>
                            ))}
                        </ul>

                        <div className="mt-6 border-t border-white/5 pt-4">
                            <p className="font-mono text-[10px]/5 text-zinc-600">
                                Corrected 14 Aug: the pre-2023 figure was 0.22 mm, not 0.22 in. Thanks to the reader who owns nine of them.
                            </p>
                        </div>
                    </nav>

                    <div className={`max-w-2xl space-y-6 text-zinc-400 ${TYPE_SIZES[type]}`}>
                        <section id="what-came-back" className="scroll-mt-20 space-y-5">
                            <h2 className="text-xl font-semibold tracking-tight text-cream">What came back</h2>

                            <p>
                                Four hundred and twelve grinders came back to the workshop between January and December. That is 3.1% of what went out, which is
                                not a number we enjoy, and it is the reason someone spent a year writing down what was wrong with each one before touching it.
                            </p>

                            <p>
                                The complaint on the ticket was almost always the same sentence in different words: the grind wanders. A shop dials in on Monday,
                                and by Thursday the same setting pulls four seconds faster. Most people assumed dull burrs. Some assumed the motor. Both were
                                wrong often enough that we stopped guessing.
                            </p>

                            <figure>
                                <div className="dot-grid grid h-52 place-items-center rounded-2xl border border-white/8 bg-ink-900">
                                    <svg className="size-10 text-zinc-700" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="8" stroke="currentColor" strokeWidth="1.2"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" strokeWidth="1.2"/>
                                        <path d="M12 1.5v3M12 19.5v3M22.5 12h-3M4.5 12h-3" stroke="currentColor" strokeWidth="1.2" strokeLinecap="round"/>
                                    </svg>
                                </div>
                                <figcaption className="mt-2.5 font-mono text-[10px]/5 text-zinc-600">
                                    The measuring rig. A dial gauge, a rotating fixture, and a printed card per unit. Total cost, about the price of two burr sets.
                                </figcaption>
                            </figure>
                        </section>

                        <section id="measuring" className="scroll-mt-20 space-y-5">
                            <h2 className="text-xl font-semibold tracking-tight text-cream">How we measured</h2>

                            <p>
                                Runout at the burr seat, taken at eight points around the carrier, before the machine was cleaned. Cleaning first would have been
                                tidier and would have thrown away half the evidence, because grounds pack into a gap that a straight seat never opens.
                            </p>

                            <p>
                                Anything over 0.08 mm goes on the reject card. That threshold came from a café in Taipei that runs 14 kg a week and can taste the
                                difference at 0.1 mm, which none of us can. We took their number.
                            </p>

                            <ul className="ml-4 list-disc space-y-2 marker:text-zinc-700">
                                <li>Gauge zeroed on the housing, not the burr, so a warped burr does not read as a good seat.</li>
                                <li>Eight points, because four missed a lobe pattern we later found on three units.</li>
                                <li>Every card photographed. The serial is on the card. That mattered later.</li>
                            </ul>
                        </section>

                        <section id="numbers" className="scroll-mt-20 space-y-5">
                            <h2 className="text-xl font-semibold tracking-tight text-cream">The numbers</h2>

                            <p>
                                Sorted by model, the picture is duller than the story people tell about burrs. The median seat was out by more than the threshold
                                on every line we make, and the oldest machines were out by nearly three times it.
                            </p>

                            <div className="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                                <table className="w-full text-left">
                                    <thead>
                                        <tr className="border-b border-white/5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">
                                            <th scope="col" className="px-4 py-3 font-normal">Model</th>
                                            <th scope="col" className="px-4 py-3 font-normal">Returned</th>
                                            <th scope="col" className="px-4 py-3 font-normal">Median runout</th>
                                            <th scope="col" className="px-4 py-3 font-normal">Most swapped</th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-white/5">
                                        {ROWS.map((row, index) => (
                                            <tr key={row.model} className="text-[13px] text-zinc-400">
                                                <td className="px-4 py-3 text-zinc-200">{row.model}</td>
                                                <td className="px-4 py-3 font-mono">{row.units}</td>
                                                <td className={`px-4 py-3 font-mono ${index === ROWS.length - 1 ? 'text-red-400' : 'text-jade-300'}`}>{row.runout}</td>
                                                <td className="px-4 py-3">{row.swap}</td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>

                            <p>
                                Burrs were replaced on 41% of units. In 32 of those cases the burrs measured fine and were changed because the customer had
                                already paid for them and asked. We should not have done that, and we now say so on the phone.
                            </p>
                        </section>

                        <section id="tuesday" className="scroll-mt-20 space-y-5">
                            <h2 className="text-xl font-semibold tracking-tight text-cream">Four seats, one Tuesday</h2>

                            <blockquote className="border-l-2 border-jade-500/60 pl-5">
                                <p className="text-lg/8 text-cream">
                                    Four of the worst readings in the whole year came off machines built within six hours of each other.
                                </p>
                                <p className="mt-2 font-mono text-[10px] text-zinc-600">Build log, 14 March 2023</p>
                            </blockquote>

                            <p>
                                Because every card carried a serial, and every serial carries a build date, the four worst readings landed in the same afternoon.
                                That afternoon the seat facing was done on the second lathe, which had been set up that morning by someone covering a shift.
                            </p>

                            <p>
                                Nineteen machines were built that day. We have contacted all nineteen owners. Eleven had already noticed something, four had not,
                                and four never replied. If you have an EG-83 with a serial starting 2303, the parts are free and so is the freight, in both
                                directions.
                            </p>
                        </section>

                        <section id="changed" className="scroll-mt-20 space-y-5">
                            <h2 className="text-xl font-semibold tracking-tight text-cream">What changed on the line</h2>

                            <p>
                                Every carrier now gets gauged before the burrs go in, and the reading is written on the same card that ships in the box. It adds
                                about ninety seconds per machine. We looked at automating it and decided ninety seconds of someone actually looking at the part
                                was worth more than the fixture would be.
                            </p>

                            <p>
                                The second lathe has a written setup sheet now, which it should have had in 2023. Nobody was careless. The sheet was in one
                                person&apos;s head, and that person was on holiday.
                            </p>
                        </section>

                        <section id="yours" className="scroll-mt-20 space-y-5">
                            <h2 className="text-xl font-semibold tracking-tight text-cream">If yours is one of them</h2>

                            <p>
                                There is a two-minute test you can run at home with a phone and a spirit level. It will not give you a number, but it will tell
                                you whether to send us the serial. The write-up is in the next note.
                            </p>

                            <div className="rounded-2xl border border-jade-500/25 bg-jade-500/5 p-5">
                                <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Serial starts 2303</p>
                                <p className="mt-2 text-[13px]/6 text-zinc-300">
                                    Mail the serial and a photo of the card. Parts and freight are covered both ways, with no receipt needed. The warranty follows
                                    the serial, so it does not matter who bought it first.
                                </p>
                            </div>
                        </section>
                    </div>
                </div>

                <div className="mt-12 max-w-2xl lg:ml-[15rem]">
                    <div className="rounded-2xl border border-white/8 bg-ink-900 p-6">
                        <BlogByline
                            size="lg"
                            name="Mei Tsai"
                            role="workshop lead"
                            bio="Runs the bench in Taichung and signs the card that ships in every box. Fourteen years on machine tools before this, which is why the tables here always have a median in them."
                        >
                            <div className="mt-3 flex flex-wrap gap-2">
                                <a
                                    href="/templates/blog/screens/author"
                                    target="_top"
                                    className="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                                >
                                    9 notes
                                </a>
                                <span className="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-600">writes about machines, mostly</span>
                            </div>
                        </BlogByline>
                    </div>

                    <div className="mt-4 grid gap-4 sm:grid-cols-2">
                        {RELATED.map((entry) => (
                            <a
                                key={entry.title}
                                href="/templates/blog/screens/article"
                                target="_top"
                                className="group/rel rounded-2xl border border-white/8 bg-ink-900 p-5 transition-colors duration-200 ease-snap hover:border-white/20"
                            >
                                <span className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{entry.direction}</span>
                                <p className="mt-2 text-[15px]/6 text-cream transition-colors duration-150 group-hover/rel:text-jade-300">{entry.title}</p>
                                <p className="mt-2 font-mono text-[10px] text-zinc-600">{entry.meta}</p>
                            </a>
                        ))}
                    </div>

                    <BlogSubscribe
                        className="mt-4"
                        title="The next one lands in a fortnight"
                        note="Usually shorter than this. Always with the numbers we actually recorded."
                    />
                </div>
            </article>
        </BlogShell>
    );
}
