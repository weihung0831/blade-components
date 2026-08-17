const CONTROL = 'w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px] text-cream placeholder:text-zinc-600 transition-colors duration-150 focus:border-jade-500/60 focus:outline-none';

export function ContactField({
    label,
    value = '',
    onChange = () => {},
    type = 'text',
    hint = null,
    note = null,
    placeholder = null,
    mono = false,
    rows = 4,
    optional = false,
    children = null,
}) {
    const control = `${CONTROL}${mono ? ' font-mono' : ''}`;

    return (
        <label className="block">
            <span className="flex items-baseline gap-2">
                <span className="text-[12px] text-zinc-400">{label}</span>
                {optional && <span className="font-mono text-[10px] text-zinc-700">optional</span>}
                {note && <span className="ml-auto font-mono text-[10px] text-zinc-700">{note}</span>}
            </span>

            <span className="mt-1.5 block">
                {children ?? (type === 'textarea' ? (
                    <textarea
                        value={value}
                        onChange={(event) => onChange(event.target.value)}
                        rows={rows}
                        placeholder={placeholder}
                        spellCheck="false"
                        className={`${control} resize-none leading-6`}
                    ></textarea>
                ) : (
                    <input
                        type={type}
                        value={value}
                        onChange={(event) => onChange(event.target.value)}
                        placeholder={placeholder}
                        spellCheck={mono ? 'false' : undefined}
                        className={control}
                    />
                ))}
            </span>

            {hint && <span className="mt-1.5 block text-[11px]/5 text-zinc-600">{hint}</span>}
        </label>
    );
}
