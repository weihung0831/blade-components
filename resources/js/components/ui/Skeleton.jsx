const shapes = {
    text: 'h-3 rounded',
    circle: 'rounded-full',
    rect: 'rounded-lg',
};

const animations = {
    pulse: 'animate-pulse bg-white/8',
    wave: 'bg-white/6 bg-[linear-gradient(100deg,transparent_35%,color-mix(in_srgb,var(--color-white)_12%,transparent)_50%,transparent_65%)] bg-[length:250%_100%] animate-[ui-skeleton-wave_1.8s_linear_infinite]',
    none: 'bg-white/8',
};

export function UiSkeleton({ variant = 'text', animation = 'pulse', className = '', ...props }) {
    const classes = [shapes[variant] ?? shapes.text, animations[animation] ?? animations.pulse, className]
        .filter(Boolean)
        .join(' ');

    return (
        <>
            {animation === 'wave' && (
                <style>{'@keyframes ui-skeleton-wave { from { background-position: 165% 0; } to { background-position: -65% 0; } }'}</style>
            )}
            <div aria-hidden="true" className={classes} {...props} />
        </>
    );
}
