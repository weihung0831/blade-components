const DOT = 'size-2 shrink-0 rounded-full border border-white/15 bg-transparent transition-colors duration-150 '
    + 'group-data-[step-state=done]/step:border-jade-500 group-data-[step-state=done]/step:bg-jade-500 '
    + 'group-data-[step-state=current]/step:border-jade-500 group-data-[step-state=current]/step:bg-jade-500 group-data-[step-state=current]/step:ring-4 group-data-[step-state=current]/step:ring-jade-500/20 '
    + 'group-data-[step-state=skipped]/step:border-dashed group-data-[step-state=skipped]/step:border-amber-400/60';

const TEXT = 'text-zinc-600 transition-colors duration-150 '
    + 'group-data-[step-state=done]/step:text-zinc-400 '
    + 'group-data-[step-state=current]/step:text-cream '
    + 'group-data-[step-state=skipped]/step:text-amber-300/70';

const LINE = 'bg-white/10 group-data-[step-state=done]/step:bg-jade-500/40';

export function OnboardingStepper({ steps = [], layout = 'rail', interactive = false, onJump }) {
    if (layout === 'row') {
        return (
            <ol className="flex items-center gap-1.5">
                {steps.map((step, index) => (
                    <li key={step.key} className="group/step flex min-w-0 flex-1 items-center gap-1.5" data-step-state={step.state || 'todo'}>
                        <span className={DOT}></span>
                        <span className={`truncate text-[11px] ${TEXT}`}>{step.label}</span>
                        {index < steps.length - 1 && <span className={`h-px min-w-3 flex-1 ${LINE}`}></span>}
                    </li>
                ))}
            </ol>
        );
    }

    const Body = interactive ? 'button' : 'div';

    return (
        <ol className="flex flex-col">
            {steps.map((step, index) => (
                <li key={step.key} className="group/step flex gap-3" data-step-state={step.state || 'todo'}>
                    <span className="flex w-2 shrink-0 flex-col items-center pt-1.5">
                        <span className={DOT}></span>
                        {index < steps.length - 1 && <span className={`mt-1 w-px flex-1 ${LINE}`}></span>}
                    </span>

                    <Body
                        type={interactive ? 'button' : undefined}
                        className={`min-w-0 flex-1 pb-4 text-left outline-none ${
                            interactive ? '-mx-2 rounded-lg px-2 transition-colors duration-150 hover:bg-white/4 focus-visible:ring-2 focus-visible:ring-jade-500/70' : ''
                        }`}
                        onClick={interactive && onJump ? () => onJump(step.key) : undefined}
                    >
                        <span className="flex items-baseline gap-2">
                            <span className={`truncate text-[13px] ${TEXT}`}>{step.label}</span>

                            {step.optional && (
                                <span className="shrink-0 font-mono text-[10px] text-zinc-700 group-data-[step-state=skipped]/step:text-amber-300/70">
                                    <span className="hidden group-data-[step-state=skipped]/step:inline">skipped</span>
                                    <span className="group-data-[step-state=skipped]/step:hidden group-data-[step-state=done]/step:hidden">optional</span>
                                </span>
                            )}

                            <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{step.minutes}</span>
                        </span>

                        {step.note && <span className="mt-0.5 block text-[11px]/5 text-zinc-600">{step.note}</span>}
                    </Body>
                </li>
            ))}
        </ol>
    );
}
