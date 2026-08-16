const boxes = {
    default: 'border-white/10 bg-ink-800 text-zinc-300',
    jade: 'border-jade-500/40 bg-jade-500/15 text-jade-300',
};

export function UiOrgChart({ node = {}, depth = 0, className = '', ...props }) {
    const tone = node.tone ?? (depth === 0 ? 'jade' : 'default');

    const wrapperClasses = [
        depth === 0
            ? 'inline-flex flex-col items-center text-xs'
            : 'relative flex flex-col items-center px-2 before:absolute before:top-0 before:left-0 before:h-px before:w-full before:bg-white/15 first:before:left-1/2 first:before:w-1/2 last:before:left-0 last:before:w-1/2 only:before:hidden',
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <div className={wrapperClasses} {...props}>
            {depth > 0 && <span className="h-3 w-px bg-white/15"></span>}
            <span className={`flex flex-col items-center whitespace-nowrap rounded-md border px-3 py-1 ${boxes[tone] ?? boxes.default}`}>
                {node.label}
                {node.meta && <span className={`font-mono text-[10px] ${tone === 'jade' ? 'text-jade-400' : 'text-zinc-500'}`}>{node.meta}</span>}
            </span>
            {node.children?.length > 0 && (
                <>
                    <span className="h-3 w-px bg-white/15"></span>
                    <div className="grid auto-cols-fr grid-flow-col items-start">
                        {node.children.map((child) => (
                            <UiOrgChart key={child.label} node={child} depth={depth + 1} />
                        ))}
                    </div>
                </>
            )}
        </div>
    );
}
