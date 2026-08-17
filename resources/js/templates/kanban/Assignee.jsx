const TONES = [
    'border-jade-500/50 bg-jade-500/15 text-jade-300',
    'border-white/20 bg-white/10 text-cream',
    'border-white/10 bg-ink-800 text-zinc-400',
];

const SIZES = {
    xs: 'size-5 text-[9px]',
    sm: 'size-6 text-[10px]',
    md: 'size-8 text-[11px]',
    lg: 'size-11 text-sm',
};

export function KanbanAssignee({ name, size = 'sm', station = null, className = '' }) {
    const initials = name
        .split(' ')
        .slice(0, 2)
        .map((part) => part.charAt(0).toUpperCase())
        .join('');

    const tone = TONES[[...name].reduce((sum, char) => sum + char.charCodeAt(0), 0) % 3];

    return (
        <span
            className={`grid shrink-0 place-items-center rounded-full border font-mono select-none ${tone} ${SIZES[size] ?? SIZES.sm} ${className}`}
            title={station ? `${name} · ${station}` : name}
        >
            {initials}
        </span>
    );
}
