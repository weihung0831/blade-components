export function BlogByline({ name, role = null, date = null, read = null, initials = null, bio = null, size = 'sm', children = null }) {
    const large = size === 'lg';
    const mark = initials ?? name.split(' ').slice(0, 2).map((part) => part[0]).join('');

    return (
        <div className={`flex ${large ? 'gap-4' : 'items-center gap-3'}`}>
            <span
                className={`grid shrink-0 place-items-center rounded-full border border-jade-500/30 bg-jade-500/10 font-mono text-jade-300 uppercase ${
                    large ? 'size-12 text-sm' : 'size-8 text-[11px]'
                }`}
            >
                {mark}
            </span>

            <div className="flex min-w-0 flex-col">
                <div className="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
                    <span className={`text-cream ${large ? 'text-[15px] font-medium' : 'text-[13px]'}`}>{name}</span>
                    {role && <span className="font-mono text-[10px] text-zinc-600">{role}</span>}
                </div>

                {(date || read) && (
                    <p className="mt-0.5 flex flex-wrap items-center gap-x-2 gap-y-0.5 font-mono text-[10px] text-zinc-600">
                        {date && <span>{date}</span>}
                        {date && read && <span aria-hidden="true" className="size-1 rounded-full bg-white/15"></span>}
                        {read && <span>{read} min read</span>}
                    </p>
                )}

                {bio && <p className="mt-2 max-w-md text-[13px]/6 text-zinc-500">{bio}</p>}

                {children}
            </div>
        </div>
    );
}
