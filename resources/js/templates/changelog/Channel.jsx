const ICONS = {
    mail: [{ d: 'M3 6.5h14v11H3z' }, { d: 'm3 7 7 5.5L17 7' }],
    rss: [{ d: 'M5 15.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z', fill: 'currentColor' }, { d: 'M5 9.5a5.5 5.5 0 0 1 5.5 5.5' }, { d: 'M5 5.5a9.5 9.5 0 0 1 9.5 9.5' }],
    hook: [{ d: 'M7 5.5h6l3 4.5-3 4.5H7l-3-4.5z' }, { d: 'M10 8.5v3' }],
    chat: [{ d: 'M4 5.5h12v8H9l-4 3v-3H4z' }],
};

export function ChangelogChannel({ name, handle, icon = 'mail', note, volume, lag, on = false, onToggle }) {
    const paths = ICONS[icon] ?? ICONS.mail;

    return (
        <button
            type="button"
            data-channel={handle}
            data-on={on ? '' : undefined}
            className="group/channel flex w-full items-start gap-3 rounded-xl border border-white/8 bg-ink-950 p-3.5 text-left transition-colors duration-150 outline-none hover:border-white/15 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-on:border-jade-500/40 data-on:bg-jade-500/5"
            onClick={onToggle}
        >
            <span className="mt-0.5 grid size-8 shrink-0 place-items-center rounded-lg border border-white/8 text-zinc-500 transition-colors duration-150 group-data-on/channel:border-jade-500/40 group-data-on/channel:text-jade-300">
                <svg className="size-4.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round">
                    {paths.map((path) => <path key={path.d} d={path.d} fill={path.fill} />)}
                </svg>
            </span>

            <span className="min-w-0 flex-1">
                <span className="flex flex-wrap items-baseline gap-x-2">
                    <span className="text-[13px] text-cream">{name}</span>
                    <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-600 group-data-on/channel:text-jade-400">{on ? 'on' : 'off'}</span>
                </span>

                <span className="mt-0.5 block truncate font-mono text-[11px] text-zinc-600">{handle}</span>

                {note && <span className="mt-1.5 block text-[11px]/5 text-zinc-500">{note}</span>}

                {(volume || lag) && (
                    <span className="mt-2 flex flex-wrap items-baseline gap-x-3 font-mono text-[10px] text-zinc-700">
                        {volume && <span>{volume}</span>}
                        {lag && <span>{lag}</span>}
                    </span>
                )}
            </span>
        </button>
    );
}
