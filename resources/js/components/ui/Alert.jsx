import { useState } from 'react';

const variants = {
    info: {
        box: 'border-white/10 bg-white/5',
        icon: 'text-zinc-400',
        title: 'text-zinc-200',
        mark: 'M8 7.4v3.4M8 5v.2',
    },
    success: {
        box: 'border-jade-500/25 bg-jade-500/10',
        icon: 'text-jade-400',
        title: 'text-jade-300',
        mark: 'm5.4 8.3 1.8 1.8 3.4-4.2',
    },
    warning: {
        box: 'border-amber-400/25 bg-amber-400/10',
        icon: 'text-amber-400',
        title: 'text-amber-300',
        mark: 'M8 5v3.4M8 11v.2',
    },
    danger: {
        box: 'border-red-500/25 bg-red-500/10',
        icon: 'text-red-400',
        title: 'text-red-300',
        mark: 'm6.2 6.2 3.6 3.6M9.8 6.2 6.2 9.8',
    },
};

export function UiAlert({
    variant = 'info',
    title = null,
    dismissible = false,
    actions = null,
    onDismiss = null,
    className = '',
    children,
    ...props
}) {
    const [visible, setVisible] = useState(true);
    const style = variants[variant] ?? variants.info;

    if (!visible) {
        return null;
    }

    const dismiss = () => {
        setVisible(false);
        onDismiss?.();
    };

    return (
        <div role="alert" className={`flex gap-3 rounded-xl border px-4 py-3.5 ${style.box} ${className}`.trim()} {...props}>
            <svg className={`mt-0.5 size-4 shrink-0 ${style.icon}`} viewBox="0 0 16 16" fill="none">
                <circle cx="8" cy="8" r="6.4" stroke="currentColor" strokeWidth="1.4" />
                <path d={style.mark} stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round" />
            </svg>
            <div className="min-w-0 flex-1">
                {title && <p className={`text-sm font-medium ${style.title}`}>{title}</p>}
                <div className={`text-sm/6 text-zinc-400 ${title ? 'mt-1' : ''}`.trim()}>{children}</div>
                {actions && <div className="mt-2.5 flex items-center gap-4">{actions}</div>}
            </div>
            {dismissible && (
                <button
                    type="button"
                    aria-label="Dismiss"
                    className="-mt-0.5 -mr-1 grid size-6 shrink-0 place-items-center rounded-md text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    onClick={dismiss}
                >
                    <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" /></svg>
                </button>
            )}
        </div>
    );
}
