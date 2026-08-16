import { useRef, useState } from 'react';

export function UiInputOtp({
    length = 6,
    label = null,
    masked = false,
    value = '',
    onChange = null,
    className = '',
    ...props
}) {
    const [cells, setCells] = useState(() => Array.from({ length }, (empty, index) => value[index] ?? ''));
    const inputs = useRef([]);

    const commit = (next) => {
        setCells(next);
        onChange?.(next.join(''));
    };

    const handleInput = (index, event) => {
        const digits = event.target.value.replace(/\D/g, '').split('');
        const next = [...cells];

        if (digits.length === 0) {
            next[index] = '';
            commit(next);
            return;
        }

        digits.slice(0, length - index).forEach((digit, offset) => {
            next[index + offset] = digit;
        });

        commit(next);

        const target = inputs.current[Math.min(index + digits.length, length - 1)];

        target?.focus();
        target?.select();
    };

    const handleKeyDown = (index, event) => {
        if (event.key === 'Backspace' && cells[index] === '' && index > 0) {
            event.preventDefault();

            const next = [...cells];

            next[index - 1] = '';
            commit(next);
            inputs.current[index - 1]?.focus();
        }

        if (event.key === 'ArrowLeft' && index > 0) {
            event.preventDefault();
            inputs.current[index - 1]?.focus();
        }

        if (event.key === 'ArrowRight' && index < length - 1) {
            event.preventDefault();
            inputs.current[index + 1]?.focus();
        }
    };

    return (
        <div className={className || undefined} {...props}>
            {label && <label className="mb-1.5 block text-xs text-zinc-500">{label}</label>}
            <div className="flex items-center gap-2">
                {cells.map((cell, index) => (
                    <input
                        key={index}
                        ref={(el) => (inputs.current[index] = el)}
                        type={masked ? 'password' : 'text'}
                        inputMode="numeric"
                        autoComplete="one-time-code"
                        value={cell}
                        aria-label={`${label ?? 'Code'} digit ${index + 1}`}
                        onChange={(event) => handleInput(index, event)}
                        onKeyDown={(event) => handleKeyDown(index, event)}
                        onFocus={(event) => event.target.select()}
                        className="size-10 rounded-lg border border-white/10 bg-ink-950 text-center font-mono text-sm text-cream transition-colors duration-150 outline-none focus:border-jade-500 focus:ring-2 focus:ring-jade-500/20"
                    />
                ))}
            </div>
        </div>
    );
}
