import { useState } from 'react';
import { PrivacyShell } from './Shell';
import { PrivacyField } from './Field';
import { PrivacyClock } from './Clock';

const GROUPS = [
    {
        key: 'delivery',
        title: 'To get the machine to you',
        lead: 'The four things a parcel cannot leave the bench without.',
        fields: [
            { name: 'Your name', source: 'you', why: 'Printed on the invoice and on the label the courier scans at the door.', keeps: '7 years', removable: 'no', note: 'It rides along on the invoice, and the invoice is the one part of this page nobody here can touch.' },
            { name: 'Delivery address', source: 'you', why: 'Handed to the courier the morning your batch ships, and to nobody else.', keeps: '7 years', removable: 'no', note: 'Change it as often as you like. We hold the current one, plus the one that was actually on each order.' },
            { name: 'Email address', source: 'you', why: 'Order confirmation, the mail when your batch slips, and the tracking number.', keeps: 'until you close the account', removable: 'yes', note: 'Nothing else lands there unless you went and switched it on yourself.' },
            { name: 'Phone number', source: 'you', why: 'The courier rings it on the day. Leave it blank and they leave a card instead.', keeps: '18 months', removable: 'yes', note: 'About a third of orders leave this empty and those parcels arrive fine.' },
        ],
    },
    {
        key: 'warranty',
        title: 'To honour the warranty',
        lead: 'These hang off the machine rather than off you, which is why the answer in the right-hand column is a qualified one.',
        fields: [
            { name: 'Serial number', source: 'us', why: 'Which burr set, which motor batch, which bench it was built on.', keeps: '10 years from build', removable: 'partly', note: 'The serial stays, because a recall has to know which forty machines to write to. Your name comes off it the day you ask.' },
            { name: 'What we did to it', source: 'us', why: 'Repair notes, the photograph of the burr, the invoice for the parts.', keeps: '10 years', removable: 'partly' },
            { name: 'Proof of purchase', source: 'us', why: 'The order it came from, which is the thing that starts the two years running.', keeps: '10 years', removable: 'partly' },
            { name: 'Who it belongs to now', source: 'us', why: 'The warranty follows the machine, so a second-hand buyer registers against the same serial.', keeps: '10 years', removable: 'partly', note: 'Two owners on one serial is ordinary here, and neither of them can see the other.' },
        ],
    },
    {
        key: 'law',
        title: 'Because the law says so',
        lead: 'Four rows we hold whether either of us wants to. The act is named so you can check that we are not hiding behind it.',
        fields: [
            { name: 'Invoice record', source: 'law', why: 'Every sale, against the 統一發票 number the Ministry of Finance issued for it.', keeps: '7 years', removable: 'no', note: '稅捐稽徵法 §11-2. We could not delete this one if all four of us agreed to.' },
            { name: 'Carrier or donation code', source: 'law', why: 'Where the e-invoice went — your carrier barcode, or the charity you picked instead.', keeps: '7 years', removable: 'no' },
            { name: 'Customs declaration', source: 'law', why: 'For anything leaving Taiwan: contents, weight, declared value, tariff code 8509.40.', keeps: '5 years', removable: 'no', note: 'The country it landed in keeps its own copy for longer, and we have no say in that at all.' },
            { name: 'Payment record', source: 'law', why: 'Amount, date, last four digits, and the token the processor gave back.', keeps: '7 years', removable: 'no', note: 'Never the card number. It has not once touched a machine we own.' },
        ],
    },
    {
        key: 'running',
        title: 'To keep the shop up',
        lead: 'The unglamorous half. None of it is about you personally and most of it is gone inside a fortnight.',
        fields: [
            { name: 'Web log', source: 'us', why: 'IP address, the page, the time. It is how we notice somebody hammering the checkout.', keeps: '14 days', removable: 'yes', note: 'After a fortnight the address is dropped and what survives is a number in a chart.' },
            { name: 'Session cookie', source: 'us', why: 'Holds your cart together while you walk from one page to the next.', keeps: 'until the tab closes', removable: 'yes' },
            { name: 'Sign-ins that failed', source: 'us', why: 'Three in a row from one address earns a wait. That is the whole of it.', keeps: '90 days', removable: 'yes' },
            { name: 'Support mail', source: 'us', why: 'The whole thread, because the answer rarely makes sense without the question above it.', keeps: '3 years', removable: 'yes', note: 'A thread about a repair gets filed against the serial instead, and then it keeps to the ten-year line above.' },
            { name: 'Backups', source: 'us', why: 'A copy of the lot, nightly, one in the building and one in a rack across town.', keeps: '35 days', removable: 'partly', note: 'A delete clears the live record that afternoon. The backups roll it out over the next five weeks, and nothing reads them in the meantime.' },
        ],
    },
    {
        key: 'asked',
        title: 'Only because you ticked something',
        lead: 'Four rows that exist only if you went looking for a switch and turned it on.',
        fields: [
            { name: 'Newsletter address', source: 'you', why: 'Six mails a year, mostly about what is on the bench and what went wrong on it.', keeps: 'until you unsubscribe', removable: 'yes' },
            { name: 'A hash of it, afterwards', source: 'us', why: 'Sixteen characters left behind when you unsubscribe.', keeps: 'kept for good', removable: 'partly', note: 'The one thing we hold specifically in order to leave you alone. Without it a later import puts you back on the list.' },
            { name: 'Visit counts', source: 'you', why: 'No cookie, a hash that changes daily, and it never sees an address or an order.', keeps: 'off unless switched on', removable: 'yes' },
            { name: 'Review name and photo', source: 'you', why: 'What you typed into the review box, and only once you pressed publish.', keeps: 'until you delete the review', removable: 'yes' },
        ],
    },
];

const FILTERS = [
    { key: 'all', label: 'All twenty-one' },
    { key: 'yes', label: 'Gone on request' },
    { key: 'partly', label: 'Name comes off' },
    { key: 'no', label: 'Pinned by law' },
];

const SPELL = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
    'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 'twenty-one'];

export function PrivacyHeld() {
    const [picked, setPicked] = useState('all');

    const shown = GROUPS
        .map((group) => ({
            ...group,
            fields: group.fields.filter((field) => picked === 'all' || field.removable === picked),
        }))
        .filter((group) => group.fields.length > 0);

    const total = shown.reduce((sum, group) => sum + group.fields.length, 0);
    const count = picked === 'all' ? 'showing all twenty-one' : `showing ${SPELL[total]} of twenty-one`;

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span className="flex items-center gap-2.5">
                <span className="flex w-24 gap-px overflow-hidden rounded-full">
                    <span className="h-1.5 bg-jade-500" style={{ width: '42.86%' }}></span>
                    <span className="h-1.5 bg-white/15" style={{ width: '28.57%' }}></span>
                    <span className="h-1.5 bg-amber-400/70" style={{ width: '28.57%' }}></span>
                </span>
                <span className="font-mono text-[10px] text-zinc-600">9 you can clear · 6 partial · 6 stuck</span>
            </span>

            <span className="hidden font-mono text-[10px] text-zinc-700 sm:inline">{count}</span>

            <div className="ml-auto flex flex-wrap items-center gap-1">
                {FILTERS.map((filter) => (
                    <button
                        key={filter.key}
                        type="button"
                        className={`rounded-lg px-2.5 py-1 text-[12px] transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                            picked === filter.key ? 'bg-white/8 text-cream' : 'text-zinc-500'
                        }`}
                        onClick={() => setPicked(filter.key)}
                    >{filter.label}</button>
                ))}
            </div>
        </div>
    );

    return (
        <PrivacyShell active="What we hold" toolbar={toolbar}>
            <div className="mx-auto max-w-5xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">Everything we hold about you</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Twenty-one fields, and the honest split is that nine of them you typed, eight we wrote down while doing the work,
                    and four exist because a tax inspector would want them. Each row says how long it stays and whether you can have it
                    gone this afternoon. Where the answer is no, the act that pins it is named rather than gestured at.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <PrivacyClock label="Your address in the web log" span={14} unit="days" elapsed={9} then="dropped, and the row becomes a tally" />
                    <PrivacyClock label="Phone number after delivery" span={18} unit="months" elapsed={4} then="deleted without being asked" />
                    <PrivacyClock label="The invoice, whatever anybody wants" span={7} unit="years" elapsed={2} then="deleted the week it clears" pinned />
                </div>

                <div className="mt-8 flex flex-col gap-8">
                    {shown.map((group) => (
                        <section key={group.key} id={`purpose-${group.key}`} className="scroll-mt-4">
                            <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                                <h2 className="text-[15px] font-medium tracking-tight text-cream">{group.title}</h2>
                                <span className="font-mono text-[10px] text-zinc-700">{group.fields.length} fields</span>
                            </div>
                            <p className="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">{group.lead}</p>

                            <div className="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                                {group.fields.map((field) => (
                                    <PrivacyField key={field.name} {...field} note={field.note ?? null} />
                                ))}
                            </div>
                        </section>
                    ))}
                </div>

                {total === 0 && <p className="mt-4 text-[12px]/5 text-zinc-600">Nothing under this filter.</p>}

                <section className="mt-10 rounded-xl border border-amber-400/20 bg-amber-400/5 p-4">
                    <p className="font-mono text-[10px] tracking-wider text-amber-300/80 uppercase">One we got wrong</p>
                    <p className="mt-2 max-w-2xl text-[13px]/6 text-zinc-400">
                        Until March 2025 the web log kept the full user-agent string for a year. Nobody here ever read one, but a year
                        of browser, version, screen and language against an address is a fingerprint, whatever we meant it to be. It is
                        fourteen days and truncated now, and the old ones were deleted on 2 April 2025 rather than left to run out on
                        their own.
                    </p>
                </section>

                <section className="mt-4 flex flex-wrap items-center gap-x-6 gap-y-3 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <div className="min-w-0 flex-1">
                        <p className="text-[13px] text-cream">A row here that you did not expect</p>
                        <p className="mt-1 text-[12px]/5 text-zinc-500">
                            Say which one and why it surprised you. The phone number used to sit here for five years until somebody
                            asked what a grinder shop wanted with it in year four, and the answer turned out to be nothing.
                        </p>
                    </div>
                    <a
                        href="/templates/privacy/screens/request"
                        target="_top"
                        className="shrink-0 rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >Ask for a copy of the lot</a>
                </section>
            </div>
        </PrivacyShell>
    );
}
