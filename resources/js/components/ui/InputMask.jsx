import { useState } from 'react';

export function UiInputMask({
    mask,
    label = null,
    placeholder = null,
    value = '',
    onChange = null,
    className = '',
    ...props
}) {
    const [current, setCurrent] = useState(value);

    const format = (raw) => {
        const pending = [...raw].filter((char) => /[0-9a-z]/i.test(char));
        let output = '';

        for (const token of mask) {
            if (pending.length === 0) {
                break;
            }

            if (token === '#' || token === 'a') {
                const pattern = token === '#' ? /\d/ : /[a-z]/i;

                while (pending.length > 0 && !pattern.test(pending[0])) {
                    pending.shift();
                }

                if (pending.length === 0) {
                    break;
                }

                output += pending.shift();
            } else {
                output += token;
            }
        }

        return output;
    };

    const handleChange = (event) => {
        const formatted = format(event.target.value);

        setCurrent(formatted);
        onChange?.(formatted);
    };

    return (
        <div className={`w-56 ${className}`.trim()} {...props}>
            {label && <label className="mb-1.5 block text-xs text-zinc-500">{label}</label>}
            <input
                type="text"
                value={current}
                placeholder={placeholder ?? mask}
                aria-label={label ?? undefined}
                onChange={handleChange}
                className="h-9 w-full rounded-lg border border-white/10 bg-ink-950 px-3 font-mono text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500"
            />
        </div>
    );
}
