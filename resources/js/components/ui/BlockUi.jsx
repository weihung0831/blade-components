export function UiBlockUi({ blocked = false, label = null, className = '', children, ...props }) {
    return (
        <div className={`group/block relative ${className}`.trim()} data-blocked={blocked ? '' : undefined} {...props}>
            {children}
            <div
                aria-hidden="true"
                className="pointer-events-none absolute inset-0 z-10 grid place-items-center rounded-[inherit] bg-ink-950/60 opacity-0 backdrop-blur-[2px] transition-opacity duration-300 group-data-[blocked]/block:pointer-events-auto group-data-[blocked]/block:opacity-100"
            >
                <div className="flex flex-col items-center gap-2.5">
                    <svg className="size-5 animate-spin text-jade-400" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6.5" stroke="currentColor" strokeOpacity="0.25" strokeWidth="1.5" /><path d="M14.5 8a6.5 6.5 0 0 0-6.5-6.5" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" /></svg>
                    {label && <p className="text-xs text-zinc-400">{label}</p>}
                </div>
            </div>
        </div>
    );
}
