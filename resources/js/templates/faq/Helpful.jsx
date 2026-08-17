import { useState } from 'react';

export function FaqHelpful({ helpful = 91, votes = 212, prompt = 'Did this answer it?', className = '' }) {
    const [vote, setVote] = useState(null);

    return (
        <div className={`rounded-xl border border-white/8 bg-ink-900 px-4 py-3 ${className}`}>
            <div className="flex flex-wrap items-center gap-x-4 gap-y-3">
                <p className="text-[13px] text-zinc-300">{prompt}</p>

                <div className="flex items-center gap-1.5">
                    <button
                        type="button"
                        onClick={() => setVote('yes')}
                        className={`cursor-pointer rounded-lg border px-3 py-1.5 text-[12px] transition-colors duration-150 ${
                            vote === 'yes' ? 'border-jade-500/60 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-400 hover:border-jade-500/50 hover:text-cream'
                        }`}
                    >
                        It did
                    </button>

                    <button
                        type="button"
                        onClick={() => setVote('no')}
                        className={`cursor-pointer rounded-lg border px-3 py-1.5 text-[12px] transition-colors duration-150 ${
                            vote === 'no' ? 'border-amber-400/60 bg-amber-400/10 text-amber-300' : 'border-white/10 text-zinc-400 hover:border-amber-400/50 hover:text-cream'
                        }`}
                    >
                        Not really
                    </button>

                    <span className="ml-1 hidden items-center gap-2 sm:flex">
                        <span className="block h-0.5 w-16 overflow-hidden rounded-full bg-white/10">
                            <span className="block h-full rounded-full bg-jade-500/70" style={{ width: `${helpful}%` }}></span>
                        </span>
                        <span className="font-mono text-[10px] text-zinc-600">{helpful}% of {votes.toLocaleString()}</span>
                    </span>
                </div>

                {vote === 'no' && (
                    <p className="w-full text-[12px]/5 text-amber-200/80">
                        Then it is our fault, not yours.{' '}
                        <a href="/templates/faq/screens/ask" target="_top" className="text-amber-300 underline decoration-amber-400/40 underline-offset-3 transition-colors duration-150 hover:decoration-amber-300">Tell the desk what is missing</a>
                        {' '}and whoever rewrites it will read exactly that sentence.
                    </p>
                )}
            </div>
        </div>
    );
}
