const solids = {
    jade: 'bg-jade-500/15 font-medium text-jade-400',
    zinc: 'bg-white/10 font-medium text-zinc-300',
    red: 'bg-red-400/15 font-medium text-red-400',
    amber: 'bg-amber-400/15 font-medium text-amber-400',
};

const dots = {
    jade: 'bg-jade-500',
    zinc: 'bg-zinc-500',
    red: 'bg-red-400',
    amber: 'bg-amber-400',
};

export function UiBadge({ variant = 'solid', color = 'jade', className = '', children, ...props }) {
    const badgeClasses = [
        'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs',
        ['outline', 'dot'].includes(variant) ? 'border border-white/10 text-zinc-400' : (solids[color] ?? solids.jade),
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <span className={badgeClasses} {...props}>
            {variant === 'dot' && <span className={`size-1.5 rounded-full ${dots[color] ?? dots.jade}`} />}
            {children}
        </span>
    );
}
