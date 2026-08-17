import { useState } from 'react';
import { InboxShell } from './Shell';
import { InboxThread } from './Thread';

const RESULTS = [
    { ref: 'NS-4471', from: 'Tomás Ferreira', company: null, subject: 'Grinder howls above 1800 rpm after three weeks', preview: 'Starts around the middle of the dial and gets worse on lighter roasts.', tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Batch 40', tone: 'order' }], minutes: -40, unread: true, assignee: null, count: 4, time: '11:12', channel: 'form', state: 'open', files: 2 },
    { ref: 'NS-4468', from: 'Kenta Mori', company: 'Osaka Roast Supply', subject: 'Batch 40 landed — 48 units, no invoice in the crate', preview: 'Accounts cannot pay against a packing slip.', tags: [{ label: 'Dealer', tone: 'dealer' }, { label: 'Batch 40', tone: 'order' }], minutes: 80, unread: false, assignee: 'Idris Bahar', count: 5, time: '10:04', channel: 'email', state: 'open', files: 1 },
    { ref: 'NS-4465', from: 'Anja Lindqvist', company: null, subject: 'Ordered jade, opened graphite', preview: 'The box label says jade. The grinder inside is not.', tags: [{ label: 'Order', tone: 'order' }], minutes: 130, unread: true, assignee: 'Hana Okabe', count: 2, time: '09:41', channel: 'email', state: 'open', files: 1 },
    { ref: 'NS-4462', from: 'Bruno Sacchi', company: null, subject: 'Can I buy the dosing cup on its own?', preview: 'Dropped mine on tile. The lip is cracked, everything else is fine.', tags: [{ label: 'Parts', tone: 'plain' }], minutes: 205, unread: false, assignee: null, count: 1, time: '09:12', channel: 'form', state: 'open', files: 0 },
    { ref: 'NS-4459', from: 'Wei-Ting Kao', company: 'Taipei Coffee Fair', subject: 'Six show units — can we take them Wednesday instead?', preview: 'Hall access moved forward a day.', tags: [{ label: 'Dealer', tone: 'dealer' }], minutes: 55, unread: false, assignee: 'Idris Bahar', count: 3, time: 'Tue', channel: 'email', state: 'open', files: 0 },
    { ref: 'NS-4455', from: 'Marta Nowak', company: null, subject: 'Refund, day 12 of 14', preview: 'Nothing wrong with it. It is louder than my flat allows at 6am.', tags: [{ label: 'Refund', tone: 'plain' }], minutes: null, unread: false, assignee: 'Hana Okabe', count: 4, time: 'Tue', channel: 'email', state: 'waiting', files: 1 },
    { ref: 'NS-4450', from: 'Kenji Sato', company: null, subject: 'Burrs still off after the seat swap', preview: 'Second time round. Same drift, same side.', tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Escalated', tone: 'escalated' }], minutes: -160, unread: true, assignee: 'Lena Kohler', count: 6, time: 'Tue', channel: 'email', state: 'open', files: 3 },
    { ref: 'NS-4447', from: 'Emre Yıldız', company: 'Café Bereket', subject: 'Quote for 12 units, Istanbul', preview: 'Four shops, three grinders each.', tags: [{ label: 'Dealer', tone: 'dealer' }], minutes: 300, unread: false, assignee: null, count: 1, time: 'Mon', channel: 'form', state: 'open', files: 0 },
    { ref: 'NS-4444', from: 'Ida Sørensen', company: null, subject: 'Change the address before the Thursday van', preview: 'Moving on the 20th.', tags: [{ label: 'Order', tone: 'order' }], minutes: null, unread: false, assignee: 'Hana Okabe', count: 2, time: 'Mon', channel: 'chat', state: 'snoozed', files: 0 },
    { ref: 'NS-4402', from: 'Julia Brandt', company: null, subject: 'Same noise as the one on your blog', preview: 'Took the shim kit, twenty minutes, silent again. Thank you.', tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Batch 40', tone: 'order' }], minutes: null, unread: false, assignee: 'Lena Kohler', count: 7, time: '4 Aug', channel: 'email', state: 'closed', files: 2 },
    { ref: 'NS-4388', from: 'Owen Pryce', company: null, subject: 'Noise above half dial, sending it back', preview: 'Would rather not open it myself. Label received, posted Tuesday.', tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Batch 40', tone: 'order' }], minutes: null, unread: false, assignee: 'Lena Kohler', count: 9, time: '28 Jul', channel: 'email', state: 'closed', files: 4 },
    { ref: 'NS-4361', from: 'Priya Raman', company: null, subject: 'Which basket fits a 58 mm portafilter?', preview: 'Answered in eleven minutes, closed happy.', tags: [{ label: 'Parts', tone: 'plain' }], minutes: null, unread: false, assignee: 'Hana Okabe', count: 2, time: '19 Jul', channel: 'chat', state: 'closed', files: 0 },
    { ref: 'NS-4340', from: 'Sofia Reyes', company: null, subject: 'Static in the graphite finish', preview: 'Grounds cling to everything. Is that the finish or the burrs?', tags: [{ label: 'Parts', tone: 'plain' }], minutes: null, unread: false, assignee: 'Lena Kohler', count: 5, time: '11 Jul', channel: 'form', state: 'closed', files: 1 },
    { ref: 'NS-4318', from: 'Hugo Almeida', company: 'Praça Coffee', subject: 'Dealer terms for two shops in Lisbon', preview: 'Signed, first order went out in May.', tags: [{ label: 'Dealer', tone: 'dealer' }], minutes: null, unread: false, assignee: 'Idris Bahar', count: 11, time: '2 Jul', channel: 'email', state: 'closed', files: 2 },
];

const FACETS = {
    State: ['is:open', 'is:waiting', 'is:snoozed', 'is:closed', 'is:overdue', 'is:unowned'],
    Tag: ['tag:warranty', 'tag:dealer', 'tag:order', 'tag:parts', 'tag:batch'],
    Desk: ['with:hana', 'with:lena', 'with:idris'],
    'Came in by': ['via:email', 'via:form', 'via:chat', 'has:file'],
};

const LABELS = {
    'is:open': 'open',
    'is:waiting': 'waiting on them',
    'is:snoozed': 'snoozed',
    'is:closed': 'closed',
    'is:overdue': 'past the promise',
    'is:unowned': 'nobody has it',
    'tag:warranty': 'warranty',
    'tag:dealer': 'dealer',
    'tag:order': 'order',
    'tag:parts': 'parts',
    'tag:batch': 'batch 40',
    'with:hana': 'Hana Okabe',
    'with:lena': 'Lena Kohler',
    'with:idris': 'Idris Bahar',
    'via:email': 'email',
    'via:form': 'the contact form',
    'via:chat': 'chat',
    'has:file': 'something attached',
};

const WORDS = {
    'is:open': 'still open',
    'is:waiting': 'waiting on the customer',
    'is:snoozed': 'snoozed',
    'is:closed': 'closed',
    'is:overdue': 'past the reply promise',
    'is:unowned': 'nobody has picked it up',
    'has:file': 'something attached',
};

const SAVED = [
    { name: 'Nobody has it, and it is late', query: 'is:open is:unowned is:overdue', owner: 'the whole desk' },
    { name: 'The Batch 40 noise', query: 'tag:batch noise', owner: 'Lena' },
    { name: 'Dealers waiting on us', query: 'tag:dealer is:open', owner: 'Idris' },
];

const SUGGESTIONS = ['is:open', 'is:overdue', 'is:unowned', 'tag:warranty', 'with:lena', 'has:file'];

const FIELDS = ['is', 'tag', 'with', 'via', 'has', 'ref'];
const DESK = { hana: 'Hana Okabe', lena: 'Lena Kohler', idris: 'Idris Bahar' };

const parse = (text) => {
    const filters = [];
    const terms = [];

    text.trim().toLowerCase().split(/\s+/).filter(Boolean).forEach((piece) => {
        const [key, ...rest] = piece.split(':');

        if (rest.length > 0 && FIELDS.includes(key)) {
            filters.push([key, rest.join(':')]);
        } else {
            terms.push(piece);
        }
    });

    return { filters, terms };
};

const keeps = (row, { filters, terms }) => {
    const haystack = `${row.ref} ${row.from} ${row.company ?? ''} ${row.subject} ${row.preview} ${row.tags.map((tag) => tag.label).join(' ')}`.toLowerCase();
    const tags = row.tags.map((tag) => tag.label.toLowerCase()).join(' ');

    const passes = filters.every(([key, value]) => {
        if (key === 'is') {
            if (value === 'overdue') return row.minutes !== null && row.minutes < 0;
            if (value === 'unowned') return row.assignee === null;
            if (value === 'unread') return row.unread;

            return row.state === value;
        }

        if (key === 'tag') return tags.includes(value);
        if (key === 'with') return (row.assignee ?? '').toLowerCase().includes(DESK[value]?.toLowerCase() ?? value);
        if (key === 'via') return row.channel === value;
        if (key === 'has') return value === 'file' && row.files > 0;
        if (key === 'ref') return row.ref.toLowerCase().includes(value);

        return true;
    });

    return passes && terms.every((term) => haystack.includes(term));
};

const describe = ({ filters, terms }) => {
    const pieces = filters.map(([key, value]) => {
        const token = `${key}:${value}`;

        if (WORDS[token]) return WORDS[token];
        if (key === 'tag') return `tagged ${value}`;
        if (key === 'with') return `${DESK[value] ?? value} is on it`;
        if (key === 'via') return `came in by ${value}`;
        if (key === 'ref') return `ref contains ${value}`;

        return token;
    });

    if (terms.length > 0) {
        pieces.push(`the ${terms.length > 1 ? 'words' : 'word'} “${terms.join(' ')}”`);
    }

    return pieces.length > 0 ? pieces.join(' · ') : 'everything, oldest promise first';
};

export function InboxSearch() {
    const [query, setQuery] = useState('is:open');

    const parsed = parse(query);
    const listed = RESULTS.filter((row) => keeps(row, parsed));
    const active = query.trim().toLowerCase().split(/\s+/).filter(Boolean);

    const tally = (token) => RESULTS.filter((row) => keeps(row, parse(`${query} ${token}`))).length;

    const toggle = (token) => {
        const parts = query.trim().split(/\s+/).filter(Boolean);

        setQuery(parts.includes(token) ? parts.filter((part) => part !== token).join(' ') : [...parts, token].join(' '));
    };

    return (
        <InboxShell active="Search" folder="Unassigned" padded={false}>
            <div className="flex min-h-0 flex-1 overflow-hidden">
                <aside className="hidden w-56 shrink-0 overflow-y-auto border-r border-white/5 px-3 py-5 xl:block">
                    <p className="px-1 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Saved</p>
                    <div className="mt-2 space-y-1">
                        {SAVED.map((view) => (
                            <button
                                key={view.name}
                                type="button"
                                onClick={() => setQuery(view.query)}
                                className="block w-full rounded-lg px-2 py-1.5 text-left transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            >
                                <span className="block text-[12px]/5 text-zinc-300">{view.name}</span>
                                <span className="mt-0.5 block truncate font-mono text-[10px] text-zinc-700">{view.query}</span>
                            </button>
                        ))}
                    </div>

                    {Object.entries(FACETS).map(([group, tokens]) => (
                        <div key={group}>
                            <p className="mt-6 px-1 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{group}</p>
                            <div className="mt-2 space-y-0.5">
                                {tokens.map((token) => (
                                    <button
                                        key={token}
                                        type="button"
                                        onClick={() => toggle(token)}
                                        className={`flex w-full items-baseline gap-2 rounded-lg px-2 py-1 text-left transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                                            active.includes(token) ? 'bg-jade-500/10' : ''
                                        }`}
                                    >
                                        <span className={`truncate text-[12px] ${active.includes(token) ? 'text-jade-300' : 'text-zinc-400'}`}>{LABELS[token]}</span>
                                        <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{tally(token)}</span>
                                    </button>
                                ))}
                            </div>
                        </div>
                    ))}
                </aside>

                <div className="flex min-w-0 flex-1 flex-col">
                    <div className="shrink-0 border-b border-white/5 px-5 py-4">
                        <label className="relative flex items-center">
                            <svg className="pointer-events-none absolute left-3.5 size-4 text-zinc-600" viewBox="0 0 16 16" fill="none">
                                <circle cx="7" cy="7" r="4.5" stroke="currentColor" strokeWidth="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                            </svg>
                            <input
                                type="search"
                                value={query}
                                onChange={(event) => setQuery(event.target.value)}
                                spellCheck="false"
                                placeholder="tag:warranty is:open with:lena"
                                className="w-full rounded-xl border border-white/10 bg-ink-900 py-2.5 pr-3 pl-10 font-mono text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                            />
                            <span className="sr-only">Search every conversation</span>
                        </label>

                        <div className="mt-2.5 flex flex-wrap items-center gap-x-2 gap-y-1.5">
                            <span className="font-mono text-[10px] text-zinc-700">reads as</span>
                            <span className="text-[12px] text-zinc-400">{describe(parsed)}</span>
                        </div>

                        <div className="mt-2 flex flex-wrap items-center gap-1.5">
                            <span className="font-mono text-[10px] text-zinc-700">add</span>
                            {SUGGESTIONS.map((token) => (
                                <button
                                    key={token}
                                    type="button"
                                    onClick={() => toggle(token)}
                                    className="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                                >
                                    {token}
                                </button>
                            ))}
                        </div>
                    </div>

                    <div className="flex shrink-0 items-center gap-3 border-b border-white/5 px-5 py-2">
                        <p className="font-mono text-[10px] text-zinc-600">
                            <span className="text-zinc-400">{listed.length}</span> of 486 conversations · 14 months on disk · answered in 0.03s
                        </p>
                        <button type="button" onClick={() => setQuery('')} className="ml-auto font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">
                            clear
                        </button>
                    </div>

                    <div className="min-h-0 flex-1 overflow-y-auto">
                        {listed.map((row) => <InboxThread key={row.ref} thread={row} />)}

                        {listed.length === 0 && (
                            <p className="px-5 py-16 text-center font-mono text-[11px] text-zinc-700">
                                Nothing matches that. Drop a word, not a filter — the filters are usually right.
                            </p>
                        )}
                    </div>
                </div>
            </div>
        </InboxShell>
    );
}
