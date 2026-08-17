export function InboxClock({ minutes = 0, target = 240, bar = false, label = null, compact = false, className = '' }) {
    const late = minutes < 0;
    const span = Math.abs(minutes);
    const hours = Math.floor(span / 60);
    const rest = span % 60;

    const clock = hours > 0 ? `${hours}h${rest > 0 ? ` ${rest}m` : ''}` : `${rest}m`;
    const words = label ?? (late ? 'overdue' : 'to first reply');
    const text = compact ? clock : (late ? `${words} ${clock}` : `${clock} ${words}`);

    const tone = late ? 'text-red-300' : minutes <= 60 ? 'text-amber-300' : 'text-zinc-500';
    const fillTone = late ? 'bg-red-400' : minutes <= 60 ? 'bg-amber-400' : 'bg-jade-500/70';
    const burned = target > 0 ? Math.min(100, Math.max(0, Math.round(((target - minutes) / target) * 100))) : 100;

    return (
        <span
            className={`inline-flex items-center gap-1.5 font-mono text-[10px] whitespace-nowrap ${tone} ${className}`}
            title={late ? `First reply is ${clock} past the promise` : `${clock} left on the reply promise`}
        >
            {late ? (
                <svg className="size-3 shrink-0" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <circle cx="8" cy="8" r="5.5" stroke="currentColor" strokeWidth="1.3"/><path d="M8 5.2v3.4M8 10.6v.6" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round"/>
                </svg>
            ) : (
                <svg className="size-3 shrink-0" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <circle cx="8" cy="8" r="5.5" stroke="currentColor" strokeWidth="1.3"/><path d="M8 5v3.2l2.2 1.3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
            )}

            <span>{text}</span>

            {bar && (
                <span className="ml-0.5 block h-0.5 w-12 overflow-hidden rounded-full bg-white/10">
                    <span className={`block h-full rounded-full ${fillTone}`} style={{ width: `${burned}%` }}></span>
                </span>
            )}
        </span>
    );
}
