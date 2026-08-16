const keyframes = `
@keyframes ui-animated-border-spin { to { transform: translate(-50%, -50%) rotate(1turn); } }
@media (prefers-reduced-motion: reduce) { [class*='ui-animated-border-'] { animation: none; } }
`;

const tones = {
    jade: 'from-jade-400 via-transparent to-transparent',
    cream: 'from-cream via-transparent to-transparent',
    split: 'from-jade-400 via-transparent to-cream',
};

export function UiAnimatedBorder({
    duration = 4,
    tone = 'jade',
    radius = 'rounded-xl',
    thickness = 'p-px',
    className = '',
    children,
    ...props
}) {
    const beamClasses = [
        'absolute top-1/2 left-1/2 aspect-square w-[150%] -translate-x-1/2 -translate-y-1/2 bg-conic animate-[ui-animated-border-spin_var(--ui-border-speed)_linear_infinite]',
        tones[tone] ?? tones.jade,
    ].join(' ');

    return (
        <div
            className={`relative overflow-hidden bg-white/10 ${radius} ${thickness} ${className}`}
            style={{ '--ui-border-speed': `${Math.max(1, duration)}s` }}
            {...props}
        >
            <style>{keyframes}</style>

            <span aria-hidden="true" className={beamClasses} />

            <div className="relative h-full rounded-[inherit] bg-ink-900">{children}</div>
        </div>
    );
}
