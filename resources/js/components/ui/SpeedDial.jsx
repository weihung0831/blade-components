const directions = {
    up: { container: 'flex-col-reverse', shift: 'translate-y-2' },
    right: { container: 'flex-row', shift: '-translate-x-2' },
};

export function UiSpeedDial({ label = 'Quick actions', direction = 'up', className = '', children, ...props }) {
    const style = directions[direction] ?? directions.up;

    return (
        <div className={['group inline-flex items-center gap-2.5', style.container, className].filter(Boolean).join(' ')} {...props}>
            <button
                type="button"
                aria-label={label}
                aria-haspopup="true"
                className="grid size-12 shrink-0 place-items-center rounded-full bg-jade-500 text-ink-950 transition-[transform,background-color] duration-200 ease-snap outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-[0.95] group-focus-within:rotate-45 group-hover:rotate-45"
            >
                <svg className="size-5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round"/></svg>
            </button>
            <div
                className={[
                    'pointer-events-none flex items-center gap-2.5 opacity-0 transition-[opacity,translate] duration-200 ease-snap',
                    style.container,
                    style.shift,
                    'group-focus-within:pointer-events-auto group-focus-within:translate-x-0 group-focus-within:translate-y-0 group-focus-within:opacity-100 group-hover:pointer-events-auto group-hover:translate-x-0 group-hover:translate-y-0 group-hover:opacity-100',
                ].join(' ')}
            >
                {children}
            </div>
        </div>
    );
}
