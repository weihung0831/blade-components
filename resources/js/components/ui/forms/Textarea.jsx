import { useId } from 'react';

const states = {
    default: 'border-white/10 hover:border-white/20 focus:border-jade-500',
    invalid: 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
};

export function UiTextarea({ label = null, hint = null, error = null, state = 'default', autoResize = false, className = '', ...props }) {
    const id = useId();
    const resolvedState = error !== null ? 'invalid' : state;

    const classes = [
        'block w-full rounded-lg border bg-ink-950 px-3 py-2 text-sm/6 text-zinc-200 placeholder:text-zinc-600 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40',
        states[resolvedState] ?? states.default,
        autoResize ? 'field-sizing-content resize-none' : 'resize-y',
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <div>
            {label && (
                <label htmlFor={id} className="mb-1.5 block text-[13px] text-zinc-400">
                    {label}
                </label>
            )}
            <textarea id={id} rows={4} aria-invalid={resolvedState === 'invalid' || undefined} className={classes} {...props} />
            {error ? (
                <p className="mt-1.5 text-xs text-red-400">{error}</p>
            ) : hint ? (
                <p className="mt-1.5 text-xs text-zinc-500">{hint}</p>
            ) : null}
        </div>
    );
}
