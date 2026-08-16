import { useState } from 'react';

const hints = ['Use 8+ characters', 'Weak — keep going', 'Okay — mix cases', 'Good — add a symbol', 'Strong password'];

export function UiPassword({ label = null, placeholder = '••••••••', meter = false, className = '', ...props }) {
    const [value, setValue] = useState('');
    const [revealed, setRevealed] = useState(false);

    const score = [
        value.length >= 8,
        /[a-z]/.test(value) && /[A-Z]/.test(value),
        /\d/.test(value),
        /[^a-zA-Z0-9]/.test(value),
    ].filter(Boolean).length;

    return (
        <div className={`w-56 ${className}`.trim()} {...props}>
            {label && <label className="mb-1.5 block text-xs text-zinc-500">{label}</label>}
            <div className="relative">
                <input
                    type={revealed ? 'text' : 'password'}
                    placeholder={placeholder}
                    value={value}
                    onChange={(event) => setValue(event.target.value)}
                    className="h-10 w-full rounded-lg border border-white/10 bg-ink-950 pr-10 pl-3 text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500"
                />
                <button
                    type="button"
                    aria-label={revealed ? 'Hide password' : 'Show password'}
                    onClick={() => setRevealed((current) => !current)}
                    className="absolute top-1/2 right-1.5 grid size-7 -translate-y-1/2 place-items-center rounded-md text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    {revealed ? (
                        <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M1.5 8s2.5-4.5 6.5-4.5S14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8Z" stroke="currentColor" strokeWidth="1.3"/><path d="m3 13 10-10" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round"/></svg>
                    ) : (
                        <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M1.5 8s2.5-4.5 6.5-4.5S14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8Z" stroke="currentColor" strokeWidth="1.3"/><circle cx="8" cy="8" r="2" stroke="currentColor" strokeWidth="1.3"/></svg>
                    )}
                </button>
            </div>
            {meter && (
                <>
                    <div className="mt-2 flex gap-1">
                        {[1, 2, 3, 4].map((bar) => (
                            <span key={bar} className={`h-1 flex-1 rounded-full transition-colors duration-200 ${bar <= score ? 'bg-jade-500' : 'bg-white/10'}`} />
                        ))}
                    </div>
                    <p className="mt-1.5 text-xs text-zinc-500">{hints[score]}</p>
                </>
            )}
        </div>
    );
}
