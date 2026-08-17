import { ContactShell } from './Shell';
import { ContactHours } from './Hours';
import { ContactPlace } from './Place';

const CAN = [
    'Drop a machine off for repair, with or without an appointment inside the window.',
    'Collect one that is finished. Ping mails you the moment it goes on the shelf.',
    'Buy a burr set, a hopper, a collar, or a bag of shims over the counter, at the same price as the site.',
    'Watch one being assembled, if Ines is on a build and you do not mind standing.',
];

const CANNOT = [
    'Try before you buy. There is one machine on the counter and it is the one being worked on.',
    'Turn up outside the window. The door is shut and the bell goes to a room with a lathe in it.',
    'Pay cash. Card or transfer, because the till is a drawer with screws in it.',
];

const BRING = [
    { what: 'The machine, without the beans', why: 'A full hopper spills across the bench and then across the floor of the van.' },
    { what: 'The serial, or the machine itself', why: 'Either works. The plate is under the base and starts NS-B.' },
    { what: 'Nothing else', why: 'No box, no receipt, no proof of anything. The serial says when it was built and who built it.' },
];

const WORKSHOP_HOURS = [
    { when: 'Tue and Thu', what: '14:00–18:00 — counter open, walk in' },
    { when: 'Saturday', what: '10:00–13:00 — collection only, mail first' },
    { when: 'Everything else', what: 'Shut. Somebody is inside and cannot hear you.' },
];

const TRAVEL = [
    { mode: 'MRT', detail: 'Nanjing Fuxing, exit 4. Left onto Bade, seven minutes east, then the second lane after the petrol station.' },
    { mode: 'Bus', detail: '605 or 262 to Bade Junior High. The stop is level with the lane mouth.' },
    { mode: 'Scooter', detail: 'Park in the lane itself, on the north side. The south side is towed on Tuesdays.' },
    { mode: 'Car', detail: 'Do not. The nearest garage is under the school and it is a nine-minute walk back.' },
];

const ELSEWHERE = [
    {
        name: 'Kissaten Ono',
        tag: 'Osaka',
        lines: ['2-14-8 Nakazakinishi, Kita-ku', 'Osaka 530-0015'],
        hours: [{ when: 'Wed–Sun', what: '12:00–19:00, closed the second Wednesday' }],
        note: 'Holds four machines and the full spares list. Repairs go by courier to Taipei and come back in about three weeks.',
    },
    {
        name: 'Ruderal Kaffee',
        tag: 'Berlin',
        lines: ['Lausitzer Str. 31', '10999 Berlin'],
        hours: [{ when: 'Tue–Sat', what: '10:00–18:00' }],
        note: 'Stocks the jade finish only. They fit burr sets on the spot, which nobody else in Europe does.',
    },
];

export function ContactVisit() {
    return (
        <ContactShell
            active="Visit"
            toolbar={<ContactHours zone="Taipei" time="04:12" cursor={4.2} state="shut" windows={[[14, 18]]} note="Counter opens Tue and Thu, 14:00" />}
        >
            <div className="mx-auto max-w-5xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">It is the door with the pallet outside</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    There is no sign and no shopfront — the ground floor of Lane 44 is a machine shop, a noodle place, and us.
                    Two afternoons a week the roller door is up, and that is the whole of it.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.35fr_1fr]">
                    <div>
                        <ContactPlace
                            map
                            name="The workshop"
                            tag="the bench"
                            lines={['No. 12, Ln. 44, Sec. 3, Bade Rd', 'Songshan District, Taipei 105']}
                            hours={WORKSHOP_HOURS}
                            travel={TRAVEL}
                            note="Number 12 has a roller door and no plate. If you are standing in front of a noodle shop you have gone twenty metres too far."
                        />

                        <div className="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <section>
                                <h2 className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">What the counter is for</h2>
                                <ul className="mt-3 space-y-2.5">
                                    {CAN.map((line) => (
                                        <li key={line} className="flex gap-2.5 text-[12px]/5 text-zinc-500">
                                            <span className="mt-1.5 size-1 shrink-0 rounded-full bg-jade-400/70"></span>
                                            <span>{line}</span>
                                        </li>
                                    ))}
                                </ul>
                            </section>

                            <section>
                                <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What it is not for</h2>
                                <ul className="mt-3 space-y-2.5">
                                    {CANNOT.map((line) => (
                                        <li key={line} className="flex gap-2.5 text-[12px]/5 text-zinc-500">
                                            <span className="mt-1.5 size-1 shrink-0 rounded-full bg-amber-400/60"></span>
                                            <span>{line}</span>
                                        </li>
                                    ))}
                                </ul>
                            </section>
                        </div>
                    </div>

                    <div>
                        <section>
                            <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Bring this, and nothing else</h2>
                            <div className="mt-3 divide-y divide-white/5 border-y border-white/5">
                                {BRING.map((entry) => (
                                    <div key={entry.what} className="py-3">
                                        <p className="text-[13px] text-zinc-300">{entry.what}</p>
                                        <p className="mt-1 text-[12px]/5 text-zinc-600">{entry.why}</p>
                                    </div>
                                ))}
                            </div>
                        </section>

                        <div className="mt-6 rounded-xl border border-dashed border-white/12 bg-ink-900 p-4">
                            <div className="flex aspect-4/3 items-center justify-center rounded-lg border border-white/8 bg-ink-950">
                                <span className="font-mono text-[10px] text-zinc-700">photograph of the door</span>
                            </div>
                            <p className="mt-3 text-[12px]/5 text-zinc-500">
                                Grey roller, half up, a pallet against the wall on the right. People walk past it twice before they
                                knock, so we put the picture here rather than a longer sentence.
                            </p>
                        </div>

                        <section className="mt-8">
                            <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Two other counters</h2>
                            <p className="mt-2 text-[12px]/5 text-zinc-500">
                                Both are shops we like that happen to carry the machine. Neither is us, so warranty work still comes
                                back here — but they will start it for you.
                            </p>

                            <div className="mt-3.5 space-y-3">
                                {ELSEWHERE.map((entry) => <ContactPlace key={entry.name} {...entry} />)}
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </ContactShell>
    );
}
