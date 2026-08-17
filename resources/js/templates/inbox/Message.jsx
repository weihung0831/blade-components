import { InboxAvatar } from './Avatar';

const BUBBLES = {
    outbound: 'border-jade-500/25 bg-jade-500/8',
    note: 'border-dashed border-amber-400/30 bg-amber-400/5',
    inbound: 'border-white/8 bg-ink-900',
};

export function InboxMessage({ message }) {
    if (message.kind === 'event') {
        return (
            <div className="flex items-center gap-2.5 py-1 pl-3">
                <span aria-hidden="true" className="size-1 shrink-0 rounded-full bg-zinc-700"></span>
                <p className="font-mono text-[10px] text-zinc-600">{message.body.join(' ')}</p>
                <span aria-hidden="true" className="h-px min-w-4 flex-1 bg-white/5"></span>
                {message.time && <span className="shrink-0 font-mono text-[10px] text-zinc-700">{message.time}</span>}
            </div>
        );
    }

    const outbound = message.kind === 'outbound';
    const note = message.kind === 'note';

    return (
        <article className={`flex gap-3 ${outbound ? 'flex-row-reverse' : ''}`}>
            <InboxAvatar
                name={message.author}
                size="md"
                kind={message.kind === 'inbound' ? 'customer' : 'agent'}
                meta={message.role}
                className="mt-1"
            />

            <div className="min-w-0 max-w-[44rem] flex-1">
                <div className={`flex flex-wrap items-baseline gap-x-2 gap-y-0.5 ${outbound ? 'flex-row-reverse' : ''}`}>
                    <span className="text-[13px] font-medium text-cream">{message.author}</span>
                    {message.role && <span className="font-mono text-[10px] text-zinc-600">{message.role}</span>}
                    <span className="font-mono text-[10px] text-zinc-700">{message.time}</span>
                </div>

                <div className={`mt-1.5 rounded-xl border px-3.5 py-3 ${BUBBLES[message.kind] ?? BUBBLES.inbound}`}>
                    {note && (
                        <p className="mb-2 flex items-center gap-1.5 font-mono text-[10px] tracking-wide text-amber-300/80 uppercase">
                            <svg className="size-3" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M11.5 2.5 13.5 4.5 6 12l-3 1 1-3z" stroke="currentColor" strokeWidth="1.2" strokeLinejoin="round"/>
                            </svg>
                            internal note — the customer never sees this
                        </p>
                    )}

                    <div className="space-y-2.5 text-[13px]/6 text-zinc-300">
                        {message.body.map((paragraph, index) => <p key={index}>{paragraph}</p>)}
                    </div>

                    {message.attachments?.length > 0 && (
                        <div className="mt-3 flex flex-wrap gap-1.5 border-t border-white/5 pt-3">
                            {message.attachments.map((file) => (
                                <span key={file.name} className="inline-flex items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1 font-mono text-[10px] text-zinc-400">
                                    <svg className="size-3 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                        <path d="M9 2.5H4.5v11h7V5z" stroke="currentColor" strokeWidth="1.2" strokeLinejoin="round"/><path d="M9 2.5V5h2.5" stroke="currentColor" strokeWidth="1.2" strokeLinejoin="round"/>
                                    </svg>
                                    {file.name}
                                    <span className="text-zinc-700">{file.size}</span>
                                </span>
                            ))}
                        </div>
                    )}
                </div>

                <div className={`mt-1 flex items-center gap-2 ${outbound ? 'justify-end' : ''}`}>
                    {message.via && <span className="font-mono text-[10px] text-zinc-700">{message.via}</span>}
                    {message.seen && <span className="font-mono text-[10px] text-jade-400/70">{message.seen}</span>}
                </div>
            </div>
        </article>
    );
}
