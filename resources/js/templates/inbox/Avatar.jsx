const CREW = [
    'border-jade-500/50 bg-jade-500/15 text-jade-300',
    'border-white/20 bg-white/10 text-cream',
    'border-white/12 bg-ink-800 text-zinc-300',
];

const SIZES = {
    xs: 'size-5 text-[9px]',
    sm: 'size-6 text-[10px]',
    md: 'size-8 text-[11px]',
    lg: 'size-10 text-[13px]',
};

export function InboxAvatar({ name, size = 'sm', kind = 'agent', meta = null, className = '' }) {
    const initials = name.split(' ').slice(0, 2).map((part) => part.charAt(0).toUpperCase()).join('');

    const tone = kind === 'customer'
        ? 'border-dashed border-white/15 bg-ink-950 text-zinc-500'
        : CREW[[...name].reduce((sum, char) => sum + char.charCodeAt(0), 0) % 3];

    return (
        <span
            className={`grid shrink-0 place-items-center border font-mono select-none ${kind === 'customer' ? 'rounded-lg' : 'rounded-full'} ${tone} ${SIZES[size] ?? SIZES.sm} ${className}`}
            title={meta ? `${name} · ${meta}` : name}
        >
            {initials}
        </span>
    );
}
