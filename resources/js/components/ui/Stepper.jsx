import { Fragment } from 'react';

const circleClasses = (number, current) => {
    if (number < current) {
        return 'bg-jade-500';
    }

    return number === current
        ? 'border-2 border-jade-500 font-mono text-xs text-jade-400'
        : 'border-2 border-white/15 font-mono text-xs text-zinc-500';
};

const labelClasses = (number, current) =>
    number < current ? 'text-zinc-400' : number === current ? 'font-medium text-cream' : 'text-zinc-500';

const Check = () => (
    <svg className="size-3.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round"/></svg>
);

export function UiStepper({ steps = [], current = 1, orientation = 'horizontal', className = '', ...props }) {
    if (orientation === 'vertical') {
        const classes = ['flex flex-col', className].filter(Boolean).join(' ');

        return (
            <div className={classes} {...props}>
                {steps.map((step, index) => (
                    <div key={index} className="flex gap-3">
                        <div className="flex flex-col items-center">
                            <span className={`grid size-7 shrink-0 place-items-center rounded-full ${circleClasses(index + 1, current)}`}>
                                {index + 1 < current ? <Check /> : index + 1}
                            </span>
                            {index < steps.length - 1 && (
                                <span className={`my-1 min-h-4 w-px flex-1 ${index + 1 < current ? 'bg-jade-500' : 'bg-white/15'}`} />
                            )}
                        </div>
                        <div className={index < steps.length - 1 ? 'pt-1 pb-6' : 'pt-1'}>
                            <p className={`text-sm ${labelClasses(index + 1, current)}`}>{step.label}</p>
                            {step.description && <p className="mt-0.5 text-xs/5 text-zinc-500">{step.description}</p>}
                        </div>
                    </div>
                ))}
            </div>
        );
    }

    const classes = ['flex items-start', className].filter(Boolean).join(' ');

    return (
        <div className={classes} {...props}>
            {steps.map((step, index) => (
                <Fragment key={index}>
                    <div className="flex flex-col items-center gap-1.5 text-center">
                        <span className={`grid size-7 shrink-0 place-items-center rounded-full ${circleClasses(index + 1, current)}`}>
                            {index + 1 < current ? <Check /> : index + 1}
                        </span>
                        <span className={`text-xs ${labelClasses(index + 1, current)}`}>{step.label}</span>
                    </div>
                    {index < steps.length - 1 && (
                        <span className={`mx-2 mt-3.5 h-px w-10 ${index + 1 < current ? 'bg-jade-500' : 'bg-white/15'}`} />
                    )}
                </Fragment>
            ))}
        </div>
    );
}
