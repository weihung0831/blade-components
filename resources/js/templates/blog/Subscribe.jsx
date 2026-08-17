import { useState } from 'react';
import { UiButton } from '../../components/ui/actions/Button';

const OPTIONS = [
    { value: 'every', label: 'Every note', detail: 'Roughly two a month.' },
    { value: 'digest', label: 'Monthly digest', detail: 'One mail, first Tuesday.' },
];

export function BlogSubscribe({ title = 'Get the next one', note = null, compact = false, cadence = true, className = '' }) {
    const [picked, setPicked] = useState('every');
    const [email, setEmail] = useState('');

    return (
        <section className={`rounded-2xl border border-white/8 bg-ink-900 ${compact ? 'p-5' : 'p-6 sm:p-7'} ${className}`}>
            <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Bench Notes</p>
            <h2 className={`font-semibold tracking-tight text-cream ${compact ? 'mt-1.5 text-[15px]' : 'mt-2 text-lg'}`}>{title}</h2>

            {note && <p className={`text-zinc-500 ${compact ? 'mt-1.5 text-[13px]/6' : 'mt-2 max-w-md text-sm/6'}`}>{note}</p>}

            {cadence && (
                <div className="mt-4 grid gap-2.5 sm:grid-cols-2">
                    {OPTIONS.map((option) => (
                        <label
                            key={option.value}
                            className="flex cursor-pointer items-start gap-2.5 rounded-xl border border-white/10 bg-ink-950 p-3.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5"
                        >
                            <span className="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                                <input
                                    type="radio"
                                    name="cadence"
                                    value={option.value}
                                    checked={picked === option.value}
                                    onChange={() => setPicked(option.value)}
                                    className="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                />
                                <span className="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
                            </span>

                            <span className="flex min-w-0 flex-col gap-0.5">
                                <span className="text-[13px]/5 text-zinc-200">{option.label}</span>
                                <span className="text-xs/5 text-zinc-500">{option.detail}</span>
                            </span>
                        </label>
                    ))}
                </div>
            )}

            <form className="mt-4 flex flex-wrap items-center gap-2.5" onSubmit={(event) => event.preventDefault()}>
                <input
                    type="email"
                    value={email}
                    onChange={(event) => setEmail(event.target.value)}
                    placeholder="you@workshop.tw"
                    aria-label="Email address"
                    className="h-9 min-w-0 flex-1 rounded-lg border border-white/10 bg-ink-950 px-3 text-[13px] text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500"
                />
                <UiButton size="sm" type="submit">Subscribe</UiButton>
            </form>

            <p className="mt-3 font-mono text-[10px]/5 text-zinc-600">
                One click to leave, no reason asked. The list lives in a spreadsheet the workshop owns.
            </p>
        </section>
    );
}
