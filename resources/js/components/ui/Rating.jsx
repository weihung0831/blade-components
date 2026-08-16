import { Fragment, useId } from 'react';

const starPath = 'M8 1.5l1.9 3.9 4.3.6-3.1 3 .7 4.3L8 11.3l-3.8 2 .7-4.3-3.1-3 4.3-.6L8 1.5Z';

export function UiRating({ max = 5, value = 0, readonly = false, onChange = null, className = '', ...props }) {
    const name = useId();

    if (readonly) {
        const wrapperClasses = ['inline-flex items-center gap-1.5', className].filter(Boolean).join(' ');

        return (
            <span className={wrapperClasses} {...props}>
                {Array.from({ length: max }, (_, index) => index + 1).map((star) => (
                    <svg
                        key={star}
                        className={`size-4.5 ${star <= value ? 'text-jade-400' : 'text-white/15'}`}
                        viewBox="0 0 16 16"
                        fill="currentColor"
                    >
                        <path d={starPath} />
                    </svg>
                ))}
                <span className="ml-1 font-mono text-xs text-zinc-500">{value.toFixed(1)}</span>
            </span>
        );
    }

    const wrapperClasses = ['inline-flex flex-row-reverse items-center', className].filter(Boolean).join(' ');

    return (
        <fieldset className={wrapperClasses} {...props}>
            {Array.from({ length: max }, (_, index) => max - index).map((star) => (
                <Fragment key={star}>
                    <input
                        type="radio"
                        name={name}
                        value={star}
                        id={`${name}-${star}`}
                        defaultChecked={star === value}
                        onChange={() => onChange?.(star)}
                        className="peer sr-only"
                    />
                    <label
                        htmlFor={`${name}-${star}`}
                        aria-label={`${star} of ${max}`}
                        className="cursor-pointer px-0.5 text-white/15 transition-colors duration-150 peer-checked:text-jade-400 peer-focus-visible:text-jade-300 hover:text-jade-300 [&:hover~label]:text-jade-300"
                    >
                        <svg className="size-4.5" viewBox="0 0 16 16" fill="currentColor">
                            <path d={starPath} />
                        </svg>
                    </label>
                </Fragment>
            ))}
        </fieldset>
    );
}
