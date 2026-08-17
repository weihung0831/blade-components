export function BlogPostCard({ post, featured = false, kicker = null, href = '/templates/blog/screens/article' }) {
    return (
        <article
            className={`group/post flex overflow-hidden rounded-2xl border border-white/8 bg-ink-900 transition-colors duration-200 ease-snap hover:border-white/20 ${
                featured ? 'flex-col gap-5 p-6 sm:flex-row sm:items-stretch sm:p-7' : 'flex-col p-5'
            }`}
        >
            {featured && (
                <div className="dot-grid grid shrink-0 place-items-center rounded-xl border border-white/8 bg-ink-950 sm:w-56">
                    <svg className="size-8 text-zinc-700" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="7.5" stroke="currentColor" strokeWidth="1.3"/>
                        <circle cx="12" cy="12" r="2.5" stroke="currentColor" strokeWidth="1.3"/>
                        <path d="M12 4.5v3M12 16.5v3M19.5 12h-3M7.5 12h-3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round"/>
                    </svg>
                </div>
            )}

            <div className="flex min-w-0 flex-1 flex-col">
                <div className="flex flex-wrap items-center gap-x-3 gap-y-1">
                    {kicker && (
                        <span className="rounded-md border border-jade-500/40 bg-jade-500/10 px-2 py-0.5 font-mono text-[10px] tracking-wider text-jade-300 uppercase">{kicker}</span>
                    )}
                    <span className="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{post.topic}</span>
                    <span className="font-mono text-[10px] text-zinc-600">{post.date}</span>
                </div>

                <h3 className={`font-semibold tracking-tight text-cream ${featured ? 'mt-3 text-xl/7 sm:text-2xl/8' : 'mt-2.5 text-[15px]/6'}`}>
                    <a href={href} target="_top" className="outline-none transition-colors duration-150 group-hover/post:text-jade-300 focus-visible:text-jade-300">
                        {post.title}
                    </a>
                </h3>

                {post.excerpt && (
                    <p className={`text-zinc-500 ${featured ? 'mt-2.5 max-w-xl text-sm/6' : 'mt-2 text-[13px]/6'}`}>{post.excerpt}</p>
                )}

                <div
                    className={`flex flex-wrap items-center gap-x-3 gap-y-1.5 font-mono text-[10px] text-zinc-600 ${
                        featured ? 'mt-4 sm:mt-auto sm:pt-4' : 'mt-auto pt-4'
                    }`}
                >
                    {post.author && (
                        <>
                            <span className="text-zinc-500">{post.author}</span>
                            <span aria-hidden="true" className="size-1 rounded-full bg-white/15"></span>
                        </>
                    )}
                    <span>{post.read} min read</span>
                    <span aria-hidden="true" className="size-1 rounded-full bg-white/15"></span>
                    <span className="inline-flex items-center gap-1.5 transition-colors duration-150 group-hover/post:text-jade-400">
                        Read
                        <svg className="size-3 transition-transform duration-200 ease-snap group-hover/post:translate-x-0.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6h7M6.5 3l3 3-3 3" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    </span>
                </div>
            </div>
        </article>
    );
}
