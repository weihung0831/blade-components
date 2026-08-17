import { InboxAvatar } from './Avatar';
import { InboxTag } from './Tag';
import { InboxClock } from './Clock';

const CHANNELS = {
    email: 'M2.5 4.5h11v7h-11zM2.5 5l5.5 4 5.5-4',
    form: 'M3.5 2.5h9v11h-9zM5.5 5.5h5M5.5 8h5M5.5 10.5h3',
    chat: 'M2.5 4.5h11v6h-6l-3 2.5v-2.5h-2z',
    phone: 'M4 2.8 5.8 6 4.6 7.4a7 7 0 0 0 4 4L10 10.2l3.2 1.8v2.2A11 11 0 0 1 1.8 2.8z',
};

const STATES = {
    open: null,
    waiting: 'waiting on them',
    snoozed: 'snoozed till Thu',
    closed: 'closed',
};

export function InboxThread({ thread, active = false, onSelect }) {
    return (
        <button
            type="button"
            onClick={onSelect}
            className={`group/thread relative block w-full cursor-pointer border-b border-white/5 py-3 pr-3 pl-4 text-left outline-none transition-colors duration-150 hover:bg-white/4 focus-visible:bg-white/4 ${active ? 'bg-white/6' : ''}`}
        >
            <span aria-hidden="true" className={`absolute inset-y-0 left-0 w-0.5 bg-jade-400 transition-opacity duration-150 ${active ? 'opacity-100' : 'opacity-0'}`}></span>
            <span aria-hidden="true" className={`absolute top-4.5 left-1.5 size-1.5 rounded-full bg-jade-400 ${thread.unread && !active ? 'opacity-100' : 'opacity-0'}`}></span>

            <span className="flex items-start gap-2.5">
                <InboxAvatar name={thread.from} size="md" kind="customer" meta={thread.company} className="mt-0.5" />

                <span className="min-w-0 flex-1">
                    <span className="flex items-baseline gap-2">
                        <span className={`truncate text-[13px] ${thread.unread ? 'font-medium text-cream' : 'text-zinc-400'}`}>{thread.from}</span>
                        {thread.company && <span className="hidden truncate font-mono text-[10px] text-zinc-600 sm:block">{thread.company}</span>}
                        <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{thread.time}</span>
                    </span>

                    <span className="mt-1 flex items-center gap-1.5">
                        <svg className="size-3 shrink-0 text-zinc-700" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d={CHANNELS[thread.channel] ?? CHANNELS.email} stroke="currentColor" strokeWidth="1.2" strokeLinejoin="round"/>
                        </svg>
                        <span className={`truncate text-[13px]/5 ${thread.unread ? 'text-cream' : 'text-zinc-300'}`}>{thread.subject}</span>
                        {thread.count > 1 && <span className="shrink-0 font-mono text-[10px] text-zinc-700">{thread.count}</span>}
                    </span>

                    {thread.preview && <span className="mt-1 line-clamp-1 block text-[12px]/5 text-zinc-600">{thread.preview}</span>}

                    <span className="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1.5">
                        {thread.tags.map((tag) => <InboxTag key={tag.label} label={tag.label} tone={tag.tone} />)}

                        {STATES[thread.state] && <span className="font-mono text-[10px] text-zinc-600">{STATES[thread.state]}</span>}

                        <span className="ml-auto flex items-center gap-2.5">
                            {thread.minutes !== null && thread.minutes !== undefined && <InboxClock minutes={thread.minutes} compact />}

                            {thread.assignee
                                ? <InboxAvatar name={thread.assignee} size="xs" />
                                : <span className="grid size-5 place-items-center rounded-full border border-dashed border-white/15 font-mono text-[9px] text-zinc-700">?</span>}
                        </span>
                    </span>
                </span>
            </span>
        </button>
    );
}
