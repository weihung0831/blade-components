import { useState } from 'react';

const iso = (date) => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const weekdays = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

export function UiDatePicker({
    label = null,
    placeholder = 'Pick a date',
    defaultValue = null,
    min = null,
    max = null,
    onChange = () => {},
    className = '',
    ...props
}) {
    const [value, setValue] = useState(defaultValue);
    const [open, setOpen] = useState(false);

    const base = value ? new Date(`${value}T00:00:00`) : new Date();
    const [year, setYear] = useState(base.getFullYear());
    const [month, setMonth] = useState(base.getMonth());

    const today = iso(new Date());
    const first = new Date(year, month, 1);

    const days = Array.from({ length: 42 }, (_, i) => {
        const date = new Date(year, month, 1 - first.getDay() + i);
        const day = iso(date);

        return {
            value: day,
            label: date.getDate(),
            inMonth: date.getMonth() === month,
            outOfBounds: (min && day < min) || (max && day > max),
        };
    });

    const shiftMonth = (delta) => {
        const next = new Date(year, month + delta, 1);

        setYear(next.getFullYear());
        setMonth(next.getMonth());
    };

    const select = (day) => {
        setValue(day);
        onChange(day);

        if (day) {
            const date = new Date(`${day}T00:00:00`);

            setYear(date.getFullYear());
            setMonth(date.getMonth());
            setOpen(false);
        }
    };

    const dayClasses = (day) => {
        if (day.value === value) {
            return 'bg-jade-500 text-ink-950';
        }

        const tone = day.outOfBounds ? 'text-zinc-700' : day.inMonth ? 'text-zinc-300 hover:bg-white/5 hover:text-cream' : 'text-zinc-600 hover:bg-white/5 hover:text-cream';
        const ring = day.value === today ? ' border border-jade-500/40' : '';

        return tone + ring;
    };

    return (
        <div className={['w-56', className].filter(Boolean).join(' ')} {...props}>
            {label && <label className="mb-1.5 block text-xs text-zinc-500">{label}</label>}
            <div className="relative block">
                <button
                    type="button"
                    onClick={() => setOpen(!open)}
                    className={`flex h-10 w-full cursor-pointer items-center justify-between gap-3 rounded-lg border bg-ink-950 px-3 font-mono text-xs transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${open ? 'border-jade-500' : 'border-white/10 hover:border-white/25'}`}
                >
                    <span className={value !== null ? 'text-zinc-300' : 'text-zinc-600'}>{value ?? placeholder}</span>
                    <svg className="size-3.5 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><rect x="2.5" y="3.5" width="11" height="10" rx="1.5" stroke="currentColor" strokeWidth="1.3"/><path d="M2.5 6.5h11M5.5 2v2.5M10.5 2v2.5" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round"/></svg>
                </button>
                {open && (
                    <>
                        <div className="fixed inset-0 z-10" onClick={() => setOpen(false)} />
                        <div className="absolute top-full left-0 z-20 mt-2 w-max rounded-lg border border-white/10 bg-ink-900 p-3 shadow-lg shadow-black/40">
                            <div className="flex items-center justify-between">
                                <button type="button" aria-label="Previous month" onClick={() => shiftMonth(-1)} className="grid size-7 cursor-pointer place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                                    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                </button>
                                <span className="font-mono text-xs text-zinc-300">{months[month]} {year}</span>
                                <button type="button" aria-label="Next month" onClick={() => shiftMonth(1)} className="grid size-7 cursor-pointer place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                                    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                </button>
                            </div>
                            <div className="mt-2 grid grid-cols-7">
                                {weekdays.map((weekday) => (
                                    <span key={weekday} className="grid size-8 place-items-center font-mono text-[10px] text-zinc-600">{weekday}</span>
                                ))}
                            </div>
                            <div className="grid grid-cols-7 gap-y-0.5">
                                {days.map((day) => (
                                    <button
                                        key={day.value}
                                        type="button"
                                        disabled={day.outOfBounds}
                                        onClick={() => select(day.value)}
                                        className={`grid size-8 cursor-pointer place-items-center rounded-md font-mono text-xs transition-colors duration-150 disabled:pointer-events-none ${dayClasses(day)}`}
                                    >
                                        {day.label}
                                    </button>
                                ))}
                            </div>
                            <div className="mt-2 flex items-center justify-between border-t border-white/5 pt-2">
                                <button type="button" onClick={() => select(null)} className="cursor-pointer rounded px-1.5 py-0.5 text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">Clear</button>
                                <button type="button" onClick={() => select(today)} className="cursor-pointer rounded px-1.5 py-0.5 text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Today</button>
                            </div>
                        </div>
                    </>
                )}
            </div>
        </div>
    );
}
