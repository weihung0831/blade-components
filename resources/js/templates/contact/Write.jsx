import { useState } from 'react';
import { ContactShell } from './Shell';
import { ContactField } from './Field';

const REASONS = [
    { key: 'warranty', label: 'Something is wrong with the machine', person: 'Ines Marto', initials: 'IM', reply: '47 min', window: '09:30–18:30 Mon–Fri', note: 'She built about a third of the machines in the field. Noise questions usually come back in one line.' },
    { key: 'order', label: 'An order or a parcel', person: 'Ping Hsu', initials: 'PH', reply: '2 h', window: '09:00–18:00 Mon–Sat', note: 'He can move an address up to the moment the label prints, which is 16:00 the day before it ships.' },
    { key: 'dealer', label: 'I sell coffee gear', person: 'Ines Marto', initials: 'IM', reply: '1 day', window: 'Tue and Thu', note: 'Dealer terms start at six machines a month. Under that she will tell you to buy at retail and keep the margin.' },
    { key: 'press', label: 'Press, or none of the above', person: 'Sofia Reis', initials: 'SR', reply: '3 days', window: 'Mon Wed Fri', note: 'Two loan machines exist. If your deadline is inside a fortnight, say so in the first line.' },
];

const AFTER = [
    { when: 'Straight away', what: 'A reference lands in your mail. It is the same one on our side, so quoting it means something.' },
    { when: 'When the bench opens', what: 'A person reads it. Not a triage bot deciding which queue you belong in.' },
    { when: 'Same day, usually', what: 'If it needs a part, the part goes on the van before anyone asks you to prove anything.' },
    { when: 'After it closes', what: 'If the answer was worth keeping, it turns up in the help centre with your wording in it.' },
];

const AGES = ['Under a month', '1 to 12 months', 'Over a year', 'Bought used'];
const TROUBLES = ['It has not arrived', 'Wrong item', 'Arrived damaged', 'Change the address'];
const VOLUMES = ['1 to 5', '6 to 15', '16 to 40', 'More than 40'];
const NEEDS = ['Photographs', 'A machine on loan', 'Twenty minutes on a call', 'Specifications'];

const CHECKS = [
    { key: 'when', label: 'when it started', test: (text) => /\b(week|weeks|month|months|day|days|since|after|yesterday|new|arrived|first)\b/i.test(text) },
    { key: 'what', label: 'what it does', test: (text) => text.trim().length > 40 },
    { key: 'tried', label: 'what you already tried', test: (text) => /\b(tried|already|swapped|cleaned|reset|checked|took|opened|ran)\b/i.test(text) },
];

const chip = (on) => (on
    ? 'border-jade-500/60 bg-jade-500/10 text-jade-300'
    : 'border-white/10 text-zinc-400 hover:border-jade-500/50 hover:text-cream');

export function ContactWrite() {
    const [reason, setReason] = useState('warranty');
    const [name, setName] = useState('Tomás Ferreira');
    const [email, setEmail] = useState('tomas@ferreira.pt');
    const [serial, setSerial] = useState('');
    const [age, setAge] = useState(AGES[1]);
    const [order, setOrder] = useState('');
    const [trouble, setTrouble] = useState(TROUBLES[0]);
    const [shop, setShop] = useState('');
    const [city, setCity] = useState('');
    const [volume, setVolume] = useState(VOLUMES[1]);
    const [outlet, setOutlet] = useState('');
    const [deadline, setDeadline] = useState('2026-09-04');
    const [wanted, setWanted] = useState([NEEDS[0]]);
    const [message, setMessage] = useState('');

    const desk = REASONS.find((entry) => entry.key === reason);
    const words = message.trim() === '' ? 0 : message.trim().split(/\s+/).length;

    const toggleNeed = (entry) => setWanted(wanted.includes(entry)
        ? wanted.filter((item) => item !== entry)
        : [...wanted, entry]);

    return (
        <ContactShell active="Write in" rail={false}>
            <div className="mx-auto flex max-w-5xl gap-10">
                <div className="min-w-0 flex-1">
                    <h1 className="text-lg font-semibold tracking-tight text-cream">Say it the way you would say it out loud</h1>
                    <p className="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        The first question tells us whose desk this belongs on. Everything after it changes with your answer, so
                        you are never typing a serial number into a form about wholesale pricing.
                    </p>

                    <fieldset className="mt-6">
                        <legend className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What is this about</legend>
                        <div className="mt-2.5 flex flex-wrap gap-1.5">
                            {REASONS.map((entry) => (
                                <button
                                    key={entry.key}
                                    type="button"
                                    onClick={() => setReason(entry.key)}
                                    className={`rounded-lg border px-3 py-1.5 text-[12px] transition-colors duration-150 ${chip(reason === entry.key)}`}
                                >
                                    {entry.label}
                                </button>
                            ))}
                        </div>
                    </fieldset>

                    <div className="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <ContactField label="Your name" value={name} onChange={setName} />
                        <ContactField label="Where to write back" type="email" value={email} onChange={setEmail} />
                    </div>

                    {reason === 'warranty' && (
                        <div className="mt-4">
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <ContactField
                                    label="Serial"
                                    value={serial}
                                    onChange={setSerial}
                                    placeholder="NS-B40-0117"
                                    mono
                                    hint="Plate under the base, six digits after NS-B. It tells us the batch and the burr set."
                                />

                                <div>
                                    <span className="text-[12px] text-zinc-400">How long have you had it</span>
                                    <div className="mt-2 flex flex-wrap gap-1.5">
                                        {AGES.map((entry) => (
                                            <button
                                                key={entry}
                                                type="button"
                                                onClick={() => setAge(entry)}
                                                className={`rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150 ${chip(age === entry)}`}
                                            >
                                                {entry}
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>

                            <label className="mt-4 flex cursor-pointer items-center gap-2.5 rounded-lg border border-dashed border-white/12 px-3 py-2.5 text-[12px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">
                                <svg className="size-3.5 shrink-0" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/></svg>
                                Attach a clip of the noise
                                <span className="ml-auto font-mono text-[10px] text-zinc-700">ten seconds, dial 1 to 16, no beans</span>
                                <input type="file" className="sr-only" />
                            </label>
                        </div>
                    )}

                    {reason === 'order' && (
                        <div className="mt-4">
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <ContactField
                                    label="Order number"
                                    value={order}
                                    onChange={setOrder}
                                    placeholder="NS-2026-0117"
                                    mono
                                    hint="On the confirmation mail. Without it we are searching by surname, and there are four of you."
                                />

                                <div>
                                    <span className="text-[12px] text-zinc-400">What has happened</span>
                                    <div className="mt-2 flex flex-wrap gap-1.5">
                                        {TROUBLES.map((entry) => (
                                            <button
                                                key={entry}
                                                type="button"
                                                onClick={() => setTrouble(entry)}
                                                className={`rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150 ${chip(trouble === entry)}`}
                                            >
                                                {entry}
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>

                            <p className="mt-3 text-[12px]/5 text-zinc-600">
                                Tracking that has not moved for nine days is almost always customs, not the courier. Ping can see the
                                declaration and will tell you which of the two it is before you spend an afternoon on the phone.
                            </p>
                        </div>
                    )}

                    {reason === 'dealer' && (
                        <div className="mt-4">
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <ContactField label="Shop" value={shop} onChange={setShop} placeholder="Rua da Prata Coffee" />
                                <ContactField label="City" value={city} onChange={setCity} placeholder="Lisbon" />
                            </div>

                            <div className="mt-4">
                                <span className="text-[12px] text-zinc-400">Machines a month, honestly</span>
                                <div className="mt-2 flex flex-wrap gap-1.5">
                                    {VOLUMES.map((entry) => (
                                        <button
                                            key={entry}
                                            type="button"
                                            onClick={() => setVolume(entry)}
                                            className={`rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150 ${chip(volume === entry)}`}
                                        >
                                            {entry}
                                        </button>
                                    ))}
                                </div>
                                <p className="mt-2.5 text-[12px]/5 text-zinc-600">
                                    Under six a month the dealer price is worse for you than the retail one, once the stock you have to
                                    hold is counted. We would rather say that now than in the third mail.
                                </p>
                            </div>
                        </div>
                    )}

                    {reason === 'press' && (
                        <div className="mt-4">
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <ContactField label="Where it runs" value={outlet} onChange={setOutlet} placeholder="Standart, issue 24" />
                                <ContactField label="Your deadline" type="date" value={deadline} onChange={setDeadline} mono />
                            </div>

                            <div className="mt-4">
                                <span className="text-[12px] text-zinc-400">What you need</span>
                                <div className="mt-2 flex flex-wrap gap-1.5">
                                    {NEEDS.map((entry) => (
                                        <button
                                            key={entry}
                                            type="button"
                                            onClick={() => toggleNeed(entry)}
                                            className={`rounded-lg border px-2.5 py-1.5 text-[12px] transition-colors duration-150 ${chip(wanted.includes(entry))}`}
                                        >
                                            {entry}
                                        </button>
                                    ))}
                                </div>
                                <p className="mt-2.5 text-[12px]/5 text-zinc-600">Two loan machines exist and they are usually out. Six weeks of notice gets you one; two does not.</p>
                            </div>
                        </div>
                    )}

                    <div className="mt-5">
                        <ContactField label="What happened" hint="Plain sentences beat a bullet list. Whoever reads it has taken one of these apart, so you can be blunt about it.">
                            <textarea
                                value={message}
                                onChange={(event) => setMessage(event.target.value)}
                                rows={5}
                                spellCheck="false"
                                placeholder="Three weeks old. Quiet at first, and since the weekend it screams anywhere past halfway on the dial…"
                                className="w-full resize-none rounded-lg border border-white/10 bg-ink-900 px-3 py-2.5 text-[13px]/6 text-cream placeholder:text-zinc-600 transition-colors duration-150 focus:border-jade-500/60 focus:outline-none"
                            ></textarea>
                        </ContactField>

                        <div className="mt-2.5 flex flex-wrap gap-x-5 gap-y-2">
                            {CHECKS.map((check) => {
                                const done = check.test(message);

                                return (
                                    <span key={check.key} className="flex items-center gap-1.5">
                                        <span className={`flex size-3.5 items-center justify-center rounded-full border ${done ? 'border-jade-500/60 bg-jade-500/15' : 'border-white/12'}`}>
                                            <svg className={`size-2 ${done ? 'text-jade-400' : 'text-zinc-700'}`} viewBox="0 0 12 12" fill="none"><path d="M2 6.5 4.5 9 10 3" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                        </span>
                                        <span className={`font-mono text-[10px] ${done ? 'text-jade-400/90' : 'text-zinc-700'}`}>{check.label}</span>
                                    </span>
                                );
                            })}

                            <span className="ml-auto font-mono text-[10px] text-zinc-700">{words} words · three lines is plenty</span>
                        </div>
                    </div>

                    <div className="mt-6 flex flex-wrap items-center gap-4 border-t border-white/5 pt-5">
                        <a
                            href="/templates/contact/screens/sent"
                            target="_top"
                            className="rounded-lg bg-jade-500 px-4 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            Send it
                        </a>

                        <p className="text-[12px]/5 text-zinc-500">
                            It is <span className="font-mono text-zinc-300">04:12</span> at the bench and nobody is up.
                            <span className="block text-zinc-600">First reply usually lands by <span className="font-mono">10:20</span>, and it will be a person.</span>
                        </p>
                    </div>
                </div>

                <aside className="hidden w-60 shrink-0 lg:block">
                    <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where this lands</p>

                    <div className="mt-3 rounded-xl border border-jade-500/25 bg-jade-500/5 p-3.5">
                        <div className="flex items-center gap-3">
                            <span className="flex size-9 shrink-0 items-center justify-center rounded-lg border border-jade-500/40 bg-jade-500/10 font-mono text-[11px] text-jade-300">{desk.initials}</span>
                            <span className="min-w-0">
                                <span className="block truncate text-[13px] text-cream">{desk.person}</span>
                                <span className="mt-0.5 block font-mono text-[10px] text-zinc-600">reads this one</span>
                            </span>
                        </div>

                        <p className="mt-3 text-[12px]/5 text-zinc-500">{desk.note}</p>

                        <div className="mt-3.5 border-t border-white/8 pt-3">
                            <p className="flex items-baseline gap-2">
                                <span className="font-mono text-base text-cream">{desk.reply}</span>
                                <span className="font-mono text-[10px] text-zinc-700">median first reply</span>
                            </p>
                            <p className="mt-1 font-mono text-[10px] text-zinc-600">{desk.window}</p>
                        </div>
                    </div>

                    <p className="mt-6 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What happens next</p>
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
                            <li>No chatbot in between</li>
                            <li>Nothing sold to you afterwards</li>
                            <li>Your address goes to the courier and nowhere else</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </ContactShell>
    );
}
