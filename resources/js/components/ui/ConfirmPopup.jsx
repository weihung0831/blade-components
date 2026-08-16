import { useRef } from 'react';

const variants = {
    danger: {
        chip: 'bg-red-500/15 text-red-400',
        button: 'border border-red-500/20 bg-red-500/10 text-red-400 hover:bg-red-500/20',
    },
    primary: {
        chip: 'bg-jade-500/15 text-jade-400',
        button: 'bg-jade-500 text-ink-950 hover:bg-jade-400',
    },
};

const positions = {
    bottom: 'top-full left-0 mt-2',
    'bottom-end': 'top-full right-0 mt-2',
    top: 'bottom-full left-0 mb-2',
};

export function UiConfirmPopup({
    title,
    description = null,
    confirm = 'Confirm',
    cancel = 'Cancel',
    variant = 'danger',
    position = 'bottom',
    onConfirm,
    trigger,
    className = '',
    ...props
}) {
    const ref = useRef(null);
    const style = variants[variant] ?? variants.danger;

    const close = () => {
        ref.current.open = false;
    };

    return (
        <details ref={ref} className={`group/confirm relative inline-block ${className}`.trim()} name="ui-confirm-popup" {...props}>
            <summary className="inline-block cursor-pointer list-none rounded-lg outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/confirm:before:fixed group-open/confirm:before:inset-0 group-open/confirm:before:cursor-default group-open/confirm:before:content-['']">
                {trigger}
            </summary>
            <div
                role="alertdialog"
                className={`absolute z-10 w-64 rounded-xl border border-white/10 bg-ink-900 p-3.5 shadow-lg shadow-black/40 ${positions[position] ?? positions.bottom}`}
            >
                <div className="flex items-start gap-2.5">
                    <span className={`grid size-5 shrink-0 place-items-center rounded-full ${style.chip}`}>
                        <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M6 2.8v3.9M6 9.2v.2" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" /></svg>
                    </span>
                    <div className="min-w-0">
                        <p className="text-sm font-medium text-zinc-200">{title}</p>
                        {description && <p className="mt-0.5 text-xs/5 text-zinc-500">{description}</p>}
                    </div>
                </div>
                <div className="mt-3 flex justify-end gap-2">
                    <button
                        type="button"
                        className="h-7 rounded-md px-2.5 text-xs font-medium text-zinc-400 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        onClick={close}
                    >
                        {cancel}
                    </button>
                    <button
                        type="button"
                        className={`h-7 rounded-md px-2.5 text-xs font-medium transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${style.button}`}
                        onClick={() => {
                            close();
                            onConfirm?.();
                        }}
                    >
                        {confirm}
                    </button>
                </div>
            </div>
        </details>
    );
}
