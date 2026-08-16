import { useId } from 'react';

const base =
    'block w-full rounded-lg border bg-ink-950 text-zinc-200 placeholder:text-zinc-600 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40';

const states = {
    default: 'border-white/10 hover:border-white/20 focus:border-jade-500',
    invalid: 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
    success: 'border-jade-500/60 hover:border-jade-500/80 focus:border-jade-400',
};

const sizes = {
    sm: 'h-8 px-2.5 text-[13px]',
    md: 'h-10 px-3 text-sm',
    lg: 'h-11 px-3.5 text-[15px]',
};

export function UiInput({ label = null, hint = null, error = null, state = 'default', size = 'md', className = '', ...props }) {
    const id = useId();
    const resolvedState = error !== null ? 'invalid' : state;

    const classes = [base, states[resolvedState] ?? states.default, sizes[size] ?? sizes.md, className]
        .filter(Boolean)
        .join(' ');

    return (
        <div>
            {label && (
                <label htmlFor={id} className="mb-1.5 block text-[13px] text-zinc-400">
                    {label}
                </label>
            )}
            <input id={id} type="text" aria-invalid={resolvedState === 'invalid' || undefined} className={classes} {...props} />
            {error ? (
                <p className="mt-1.5 text-xs text-red-400">{error}</p>
            ) : hint ? (
                <p className="mt-1.5 text-xs text-zinc-500">{hint}</p>
            ) : null}
        </div>
    );
}
