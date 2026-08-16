const keyframes = `
@keyframes ui-animated-background-drift { from { transform: translate(-12%, -8%) scale(1); } to { transform: translate(18%, 12%) scale(1.25); } }
@keyframes ui-animated-background-pan { to { transform: translate(40px, 40px); } }
@media (prefers-reduced-motion: reduce) { [class*='ui-animated-background-'] { animation: none; } }
`;

export function UiAnimatedBackground({ variant = 'aurora', speed = 14, className = '', children, ...props }) {
    return (
        <div
            className={`relative isolate overflow-hidden bg-ink-950 ${className}`}
            style={{ '--ui-bg-speed': `${Math.max(1, speed)}s` }}
            {...props}
        >
            <style>{keyframes}</style>

            <div aria-hidden="true" className="pointer-events-none absolute inset-0 -z-10">
                {variant === 'grid' ? (
                    <>
                        <div className="absolute -inset-12 bg-[linear-gradient(to_right,color-mix(in_srgb,var(--color-white)_6%,transparent)_1px,transparent_1px),linear-gradient(to_bottom,color-mix(in_srgb,var(--color-white)_6%,transparent)_1px,transparent_1px)] bg-[size:40px_40px] animate-[ui-animated-background-pan_var(--ui-bg-speed)_linear_infinite]" />
                        <div className="absolute inset-0 bg-[radial-gradient(ellipse_65%_55%_at_50%_0%,color-mix(in_srgb,var(--color-jade-500)_26%,transparent),transparent)]" />
                    </>
                ) : (
                    <>
                        <span className="absolute -top-1/2 -left-1/4 aspect-square w-3/4 rounded-full bg-jade-500/35 blur-3xl animate-[ui-animated-background-drift_var(--ui-bg-speed)_ease-in-out_infinite_alternate]" />
                        <span className="absolute -right-1/4 -bottom-1/2 aspect-square w-3/4 rounded-full bg-jade-300/20 blur-3xl animate-[ui-animated-background-drift_var(--ui-bg-speed)_ease-in-out_infinite_alternate-reverse]" />
                    </>
                )}
            </div>

            {children}
        </div>
    );
}
