const rings = {
    sm: 'size-4',
    md: 'size-5',
    lg: 'size-8',
};

const dots = {
    sm: 'size-1',
    md: 'size-1.5',
    lg: 'size-2.5',
};

const colors = {
    jade: 'text-jade-500',
    zinc: 'text-zinc-400',
    cream: 'text-cream',
    red: 'text-red-400',
};

export function UiSpinner({ variant = 'ring', size = 'md', color = 'jade', label = null, className = '', ...props }) {
    const dotClasses = `animate-bounce rounded-full bg-current ${dots[size] ?? dots.md}`;

    return (
        <span role="status" className={`inline-flex items-center gap-2.5 ${colors[color] ?? colors.jade} ${className}`.trim()} {...props}>
            {variant === 'dots' ? (
                <span className="flex items-center gap-1">
                    <span className={`${dotClasses} [animation-delay:-320ms]`} />
                    <span className={`${dotClasses} [animation-delay:-160ms]`} />
                    <span className={dotClasses} />
                </span>
            ) : (
                <svg className={`animate-spin ${rings[size] ?? rings.md}`} viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="8" r="6.5" stroke="currentColor" strokeWidth="2" className="opacity-20" />
                    <path d="M14.5 8A6.5 6.5 0 0 0 8 1.5" stroke="currentColor" strokeWidth="2" strokeLinecap="round" />
                </svg>
            )}
            {label ? <span className="text-sm text-zinc-400">{label}</span> : <span className="sr-only">Loading</span>}
        </span>
    );
}
