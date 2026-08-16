import { useState } from 'react';

const axes = {
    y: {
        face: '[transform:rotateY(180deg)]',
        hover: 'group-hover:[transform:rotateY(180deg)]',
    },
    x: {
        face: '[transform:rotateX(180deg)]',
        hover: 'group-hover:[transform:rotateX(180deg)]',
    },
};

const face = 'absolute inset-0 overflow-hidden backface-hidden';

export function UiFlipCard({ trigger = 'hover', axis = 'y', front, back, className = '', ...props }) {
    const [flipped, setFlipped] = useState(false);

    const turn = axes[axis] ?? axes.y;
    const interactive = trigger === 'click';
    const Tag = interactive ? 'button' : 'div';

    const innerClasses = [
        'relative size-full transform-3d transition-transform duration-700 ease-snap',
        interactive ? (flipped ? turn.face : '') : turn.hover,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <Tag
            type={interactive ? 'button' : undefined}
            aria-pressed={interactive ? flipped : undefined}
            className={`group relative block [perspective:1000px] ${interactive ? 'cursor-pointer text-left outline-none' : ''} ${className}`}
            onClick={interactive ? () => setFlipped((current) => !current) : undefined}
            {...props}
        >
            <div className={innerClasses}>
                <div className={face}>{front}</div>
                <div className={`${face} ${turn.face}`}>{back}</div>
            </div>
        </Tag>
    );
}
