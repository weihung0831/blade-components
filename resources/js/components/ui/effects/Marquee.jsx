const keyframes = `
@keyframes ui-marquee-x { to { transform: translateX(-50%); } }
@keyframes ui-marquee-y { to { transform: translateY(-50%); } }
@media (prefers-reduced-motion: reduce) { [class*='ui-marquee-'] { animation: none; } }
`;

export function UiMarquee({
    speed = 20,
    reverse = false,
    vertical = false,
    gap = 'gap-3',
    pauseOnHover = true,
    fade = true,
    className = '',
    children,
    ...props
}) {
    const rootClasses = [
        'group relative overflow-hidden',
        vertical ? 'flex' : '',
        fade
            ? vertical
                ? '[mask-image:linear-gradient(to_bottom,transparent,black_12%,black_88%,transparent)]'
                : '[mask-image:linear-gradient(to_right,transparent,black_12%,black_88%,transparent)]'
            : '',
        className,
    ]
        .filter(Boolean)
        .join(' ');

    const trackClasses = [
        'flex',
        vertical
            ? 'flex-col h-max animate-[ui-marquee-y_var(--ui-marquee-speed)_linear_infinite]'
            : 'w-max animate-[ui-marquee-x_var(--ui-marquee-speed)_linear_infinite]',
        reverse ? '[animation-direction:reverse]' : '',
        pauseOnHover ? 'group-hover:[animation-play-state:paused]' : '',
    ]
        .filter(Boolean)
        .join(' ');

    const groupClasses = ['flex shrink-0', vertical ? 'flex-col pb-3' : 'pr-3', gap].filter(Boolean).join(' ');

    return (
        <div className={rootClasses} style={{ '--ui-marquee-speed': `${Math.max(1, speed)}s` }} {...props}>
            <style>{keyframes}</style>
            <div className={trackClasses}>
                <div className={groupClasses}>{children}</div>
                <div className={groupClasses} aria-hidden="true">
                    {children}
                </div>
            </div>
        </div>
    );
}
