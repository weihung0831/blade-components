export function UiSeparator({ label = null, vertical = false, className = '', ...props }) {
    if (vertical) {
        return <span className={['inline-block w-px self-stretch bg-white/10', className].filter(Boolean).join(' ')} {...props} />;
    }

    if (label !== null) {
        return (
            <div className={['flex w-full items-center gap-3', className].filter(Boolean).join(' ')} {...props}>
                <span className="h-px flex-1 bg-white/10" />
                <span className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{label}</span>
                <span className="h-px flex-1 bg-white/10" />
            </div>
        );
    }

    return <div className={['h-px w-full bg-white/10', className].filter(Boolean).join(' ')} {...props} />;
}
