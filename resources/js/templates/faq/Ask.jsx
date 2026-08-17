import { useState } from 'react';
import { FaqShell } from './Shell';

const CANDIDATES = [
    { slug: 'noise', q: 'It howls above half the dial after three weeks. Is that normal?', topic: 'Noise and grind', helpful: 94, keys: 'noise noisy loud howl scream squeal whine rpm dial halfway middle grinding sound batch vibration' },
    { slug: 'static', q: 'Grounds cling to everything. Is the graphite finish static?', topic: 'Noise and grind', helpful: 89, keys: 'static cling mess grounds dust everywhere stick graphite finish spray' },
    { slug: 'season', q: 'Do I have to season the burrs, and how much coffee does that cost me?', topic: 'Setting it up', helpful: 96, keys: 'season seasoning break in bedding new burrs waste beans first grind drift' },
    { slug: 'used', q: 'It arrived with grounds inside. Was mine used?', topic: 'Setting it up', helpful: 97, keys: 'used second hand grounds inside chute dirty box opened refurbished' },
    { slug: 'void', q: 'I opened it myself before writing in. Have I voided anything?', topic: 'Warranty', helpful: 62, keys: 'warranty void opened apart screws myself repair fix disassemble guarantee' },
    { slug: 'late', q: 'Nine days and the tracking has not moved. Where is it?', topic: 'Orders and delivery', helpful: 71, keys: 'tracking late delivery shipping where order lost days parcel courier customs' },
    { slug: 'address', q: 'Can I change the address after ordering?', topic: 'Orders and delivery', helpful: 90, keys: 'address change move wrong delivery order edit label' },
    { slug: 'finish', q: 'Jade or graphite — does the finish change anything?', topic: 'Before you buy', helpful: 98, keys: 'jade graphite colour color finish difference which choose buy' },
];

const AFTER = [
    { when: 'Straight away', what: 'A reference number lands in your mail. It is the same number the desk sees.' },
    { when: 'Within 47 minutes', what: 'Median first reply, business hours. Not a robot and not a form letter — one of four people.' },
    { when: 'Same day', what: 'If it needs a part, the part goes on the van before anybody asks you to prove anything.' },
    { when: 'Whenever it closes', what: 'If the answer was worth writing down, it turns up in the help centre with your words in it.' },
];

const SAMPLES = ['it screams past halfway', 'grounds go everywhere', 'nine days, no tracking', 'I already took it apart'];

const LANES = ['Noise and grind', 'Setting it up', 'Warranty', 'Orders and delivery', 'Something else'];

const STOP = ['the', 'and', 'for', 'with', 'that', 'this', 'have', 'has', 'was', 'are', 'but', 'not', 'you', 'from', 'its', 'it', 'is', 'my', 'me', 'a', 'i'];

const alike = (key, word) => key === word
    || (key.length > 3 && word.startsWith(key))
    || (word.length > 3 && key.startsWith(word));

const score = (entry, words) => {
    const keys = entry.keys.split(' ');

    return words.reduce((total, word) => total + (keys.some((key) => alike(key, word)) ? 1 : 0), 0);
};

export function FaqAsk() {
    const [text, setText] = useState('');
    const [forced, setForced] = useState(false);
    const [lane, setLane] = useState(LANES[0]);
    const [email, setEmail] = useState('tomas@ferreira.pt');
    const [serial, setSerial] = useState('');

    const words = text.toLowerCase().replace(/[^a-z0-9\s]/g, ' ').split(/\s+/)
        .filter((word) => word.length > 2 && !STOP.includes(word));

    const matches = CANDIDATES
        .map((entry) => ({ entry, hits: score(entry, words) }))
        .filter((row) => row.hits > 0)
        .sort((a, b) => b.hits - a.hits)
        .slice(0, 3)
        .map((row) => row.entry);

    const showForm = forced || (words.length > 0 && matches.length === 0);

    return (
        <FaqShell active="Ask">
            <div className="mx-auto flex max-w-5xl gap-10">
                <div className="min-w-0 flex-1">
                    <h1 className="text-lg font-semibold tracking-tight text-cream">Say it the way you would say it out loud</h1>
                    <p className="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        Six out of ten letters have an answer sitting on this site already, so we look while you type.
                        If one of them is yours, you have your answer now instead of at ten tomorrow morning.
                    </p>

                    <div className="mt-5">
                        <textarea
                            value={text}
                            onChange={(event) => setText(event.target.value)}
                            rows={4}
                            spellCheck="false"
                            placeholder="Three weeks old and it has started screaming past halfway on the dial…"
                            className="w-full resize-none rounded-xl border border-white/10 bg-ink-900 px-4 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                        ></textarea>

                        <div className="mt-2 flex flex-wrap items-center gap-1.5">
                            <span className="font-mono text-[10px] text-zinc-700">try</span>
                            {SAMPLES.map((sample) => (
                                <button
                                    key={sample}
                                    type="button"
                                    onClick={() => { setText(sample); setForced(false); }}
                                    className="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                                >
                                    {sample}
                                </button>
                            ))}
                        </div>
                    </div>

                    {matches.length > 0 && (
                        <div className="mt-6">
                            <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">
                                {matches.length} {matches.length === 1 ? 'answer looks' : 'answers look'} like what you just wrote
                            </p>

                            <div className="mt-2.5 overflow-hidden rounded-xl border border-jade-500/25 bg-jade-500/5">
                                {matches.map((entry) => (
                                    <a
                                        key={entry.slug}
                                        href="/templates/faq/screens/answer"
                                        target="_top"
                                        className="flex items-start gap-3 border-b border-white/5 px-4 py-3 transition-colors duration-150 last:border-b-0 hover:bg-white/4"
                                    >
                                        <span className="mt-1 size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                                        <span className="min-w-0 flex-1">
                                            <span className="block text-[13px]/5 text-zinc-200">{entry.q}</span>
                                            <span className="mt-1 flex items-center gap-2.5">
                                                <span className="font-mono text-[10px] text-zinc-600">{entry.topic}</span>
                                                <span className="font-mono text-[10px] text-jade-400/80">{entry.helpful}% said it helped</span>
                                            </span>
                                        </span>
                                        <svg className="mt-0.5 size-3.5 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none"><path d="M6 3.5 10.5 8 6 12.5" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                    </a>
                                ))}
                            </div>

                            <button
                                type="button"
                                onClick={() => setForced(true)}
                                className="mt-2.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream"
                            >
                                none of those — send it to a person →
                            </button>
                        </div>
                    )}

                    {showForm && (
                        <div className="mt-6 border-t border-white/5 pt-6">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What the desk needs from you</p>

                            <div className="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <label className="block">
                                    <span className="block text-[12px] text-zinc-400">Where to write back</span>
                                    <input
                                        type="email"
                                        value={email}
                                        onChange={(event) => setEmail(event.target.value)}
                                        className="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                                    />
                                </label>

                                <label className="block">
                                    <span className="block text-[12px] text-zinc-400">Serial, if the machine is the problem</span>
                                    <input
                                        type="text"
                                        value={serial}
                                        onChange={(event) => setSerial(event.target.value)}
                                        spellCheck="false"
                                        placeholder="NS-B40-0117"
                                        className="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 font-mono text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                                    />
                                </label>
                            </div>

                            <div className="mt-4">
                                <span className="block text-[12px] text-zinc-400">What is it about</span>
                                <div className="mt-2 flex flex-wrap gap-1.5">
                                    {LANES.map((entry) => (
                                        <button
                                            key={entry}
                                            type="button"
                                            onClick={() => setLane(entry)}
                                            className={`rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150 ${
                                                lane === entry ? 'border-jade-500/60 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-400 hover:border-jade-500/50 hover:text-cream'
                                            }`}
                                        >
                                            {entry}
                                        </button>
                                    ))}
                                </div>
                            </div>

                            <div className="mt-4 flex flex-wrap items-center gap-3">
                                <label className="flex cursor-pointer items-center gap-2 rounded-lg border border-dashed border-white/12 px-3 py-2 text-[12px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">
                                    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/></svg>
                                    Attach a recording
                                    <input type="file" className="sr-only" />
                                </label>
                                <span className="font-mono text-[10px] text-zinc-700">a ten-second clip of the noise beats three paragraphs describing it</span>
                            </div>

                            <div className="mt-6 flex flex-wrap items-center gap-4 border-t border-white/5 pt-5">
                                <button
                                    type="button"
                                    className="rounded-lg bg-jade-500 px-4 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                >
                                    Send it
                                </button>

                                <p className="text-[12px]/5 text-zinc-500">
                                    It is <span className="font-mono text-zinc-300">04:12</span> at the bench. Nobody is up.
                                    <span className="block text-zinc-600">First reply usually lands by <span className="font-mono">10:30</span>, and it will be a person.</span>
                                </p>
                            </div>
                        </div>
                    )}
                </div>

                <aside className="hidden w-56 shrink-0 lg:block">
                    <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What happens next</p>

                    <div className="mt-3 space-y-3.5">
                        {AFTER.map((entry) => (
                            <div key={entry.when} className="border-l border-white/8 pl-3">
                                <p className="font-mono text-[10px] text-jade-400/80">{entry.when}</p>
                                <p className="mt-1 text-[12px]/5 text-zinc-500">{entry.what}</p>
                            </div>
                        ))}
                    </div>

                    <div className="mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                        <p className="font-mono text-[10px] text-zinc-600">What does not happen</p>
                        <ul className="mt-2 space-y-1.5 text-[11px]/5 text-zinc-500">
                            <li>No account to create</li>
                            <li>No ticket number to quote back at us</li>
                            <li>No chatbot in between</li>
                            <li>Nothing sold to you afterwards</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </FaqShell>
    );
}
