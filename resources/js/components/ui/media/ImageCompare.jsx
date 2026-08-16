import { useRef, useState } from 'react';

const label = 'absolute rounded-md border border-white/10 bg-ink-950/70 px-2 py-1 font-mono text-[10px] tracking-wider uppercase backdrop-blur-sm';
const steps = { ArrowLeft: -2, ArrowUp: -2, ArrowRight: 2, ArrowDown: 2, Home: -100, End: 100 };

export function UiImageCompare({
    before,
    after,
    beforeAlt = '',
    afterAlt = '',
    beforeLabel = 'Before',
    afterLabel = 'After',
    position = 50,
    orientation = 'horizontal',
    ratio = 'aspect-video',
    className = '',
    ...props
}) {
    const root = useRef(null);
    const [value, setValue] = useState(position);
    const horizontal = orientation !== 'vertical';

    const set = (percent) => setValue(Math.round(Math.min(100, Math.max(0, percent))));

    const startDrag = (event) => {
        const rect = root.current.getBoundingClientRect();

        const drag = (pointer) => set(horizontal
            ? ((pointer.clientX - rect.left) / rect.width) * 100
            : ((pointer.clientY - rect.top) / rect.height) * 100);

        const stop = () => {
            root.current.removeEventListener('pointermove', drag);
            root.current.removeEventListener('pointerup', stop);
        };

        root.current.setPointerCapture(event.pointerId);
        root.current.addEventListener('pointermove', drag);
        root.current.addEventListener('pointerup', stop);
        drag(event);
        event.preventDefault();
    };

    const onKeyDown = (event) => {
        if (!(event.key in steps)) {
            return;
        }

        set(value + steps[event.key]);
        event.preventDefault();
    };

    return (
        <div
            ref={root}
            onPointerDown={startDrag}
            style={{ '--ui-compare': value + '%' }}
            className={`relative touch-none overflow-hidden rounded-xl border border-white/10 bg-ink-900 select-none ${ratio} ${className}`.trim()}
            {...props}
        >
            <img src={before} alt={beforeAlt} className="pointer-events-none absolute inset-0 size-full object-cover" />
            <img
                src={after}
                alt={afterAlt}
                className={`pointer-events-none absolute inset-0 size-full object-cover ${horizontal ? '[clip-path:inset(0_0_0_var(--ui-compare))]' : '[clip-path:inset(var(--ui-compare)_0_0_0)]'}`}
            />

            <span className={`${label} top-3 left-3 text-zinc-400`}>{beforeLabel}</span>
            <span className={`${label} right-3 bottom-3 text-jade-300`}>{afterLabel}</span>

            <div
                role="slider"
                tabIndex={0}
                aria-label="Comparison position"
                aria-orientation={horizontal ? 'horizontal' : 'vertical'}
                aria-valuemin={0}
                aria-valuemax={100}
                aria-valuenow={value}
                onKeyDown={onKeyDown}
                className={`group absolute bg-cream/70 outline-none ${horizontal ? 'inset-y-0 left-[var(--ui-compare)] w-px -translate-x-1/2 cursor-col-resize' : 'inset-x-0 top-[var(--ui-compare)] h-px -translate-y-1/2 cursor-row-resize'}`}
            >
                <span className="absolute top-1/2 left-1/2 grid size-8 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border border-white/20 bg-ink-950/80 text-cream shadow-lg shadow-black/40 backdrop-blur-sm transition-colors duration-150 group-hover:border-jade-500/70 group-focus-visible:ring-2 group-focus-visible:ring-jade-500/70 group-active:border-jade-400">
                    <svg className={`size-3.5 ${horizontal ? '' : 'rotate-90'}`} viewBox="0 0 16 16" fill="none">
                        <path d="M6 4.5 2.5 8 6 11.5M10 4.5 13.5 8 10 11.5" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" />
                    </svg>
                </span>
            </div>
        </div>
    );
}
