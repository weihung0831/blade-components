import { useRef, useState } from 'react';

export function UiSplitter({ orientation = 'horizontal', size = 50, min = 20, first = null, second = null, className = '', ...props }) {
    const root = useRef(null);
    const [basis, setBasis] = useState(size);
    const horizontal = orientation !== 'vertical';

    const startDrag = (event) => {
        const gutter = event.currentTarget;
        const rect = root.current.getBoundingClientRect();

        gutter.setPointerCapture(event.pointerId);

        const resize = (move) => {
            const position = horizontal
                ? ((move.clientX - rect.left) / rect.width) * 100
                : ((move.clientY - rect.top) / rect.height) * 100;

            setBasis(Math.min(100 - min, Math.max(min, position)));
        };

        const stop = () => {
            gutter.removeEventListener('pointermove', resize);
            gutter.removeEventListener('pointerup', stop);
        };

        gutter.addEventListener('pointermove', resize);
        gutter.addEventListener('pointerup', stop);
        event.preventDefault();
    };

    const classes = [
        'overflow-hidden rounded-xl border border-white/10 bg-ink-800',
        horizontal ? 'flex' : 'flex flex-col',
        className,
    ].filter(Boolean).join(' ');

    return (
        <div ref={root} className={classes} {...props}>
            <div className="min-h-0 min-w-0 shrink-0 grow-0 overflow-auto" style={{ flexBasis: basis + '%' }}>{first}</div>
            <div
                onPointerDown={startDrag}
                className={`group grid shrink-0 touch-none place-items-center bg-ink-950 ${horizontal ? 'w-2 cursor-col-resize border-x border-white/10' : 'h-2 cursor-row-resize border-y border-white/10'}`}
            >
                <span className={`rounded-full bg-white/20 transition-colors duration-150 group-hover:bg-jade-500/70 group-active:bg-jade-400 ${horizontal ? 'h-6 w-0.5' : 'h-0.5 w-6'}`} />
            </div>
            <div className="min-h-0 min-w-0 flex-1 overflow-auto">{second}</div>
        </div>
    );
}
