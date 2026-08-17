import { KanbanTag } from './Tag';
import { KanbanAssignee } from './Assignee';

export function KanbanCard({ job, dragging = false, href = '/templates/kanban/screens/ticket', ...handlers }) {
    const ageTone = job.days >= 5 ? 'text-red-300' : job.days >= 3 ? 'text-amber-300' : 'text-zinc-600';
    const progress = job.steps > 0 ? Math.round((job.done / job.steps) * 100) : 0;

    return (
        <article
            draggable="true"
            {...handlers}
            className={`group/card relative cursor-grab rounded-xl border border-white/8 bg-ink-900 p-3 transition-[border-color,transform,opacity] duration-200 ease-snap select-none hover:border-white/20 active:cursor-grabbing ${
                dragging ? 'rotate-1 opacity-40' : ''
            }`}
        >
            {job.blocked && <span aria-hidden="true" className="absolute inset-y-3 left-0 w-0.5 rounded-full bg-red-400"></span>}

            <div className="flex items-center gap-2">
                <span className="font-mono text-[10px] text-zinc-600">{job.code}</span>
                {job.station && <span className="truncate font-mono text-[10px] text-zinc-700">{job.station}</span>}
                <span className={`ml-auto font-mono text-[10px] ${ageTone}`}>{job.days}d</span>
            </div>

            <h4 className="mt-1.5 text-[13px]/5 font-medium text-cream">
                <a href={href} target="_top" className="outline-none transition-colors duration-150 group-hover/card:text-jade-300 focus-visible:text-jade-300">
                    {job.title}
                </a>
            </h4>

            {job.tags?.length > 0 && (
                <div className="mt-2.5 flex flex-wrap gap-1">
                    {job.tags.map((tag) => <KanbanTag key={tag.label} label={tag.label} tone={tag.tone} />)}
                </div>
            )}

            <div className="mt-3 flex items-center gap-2.5 border-t border-white/5 pt-2.5">
                {job.steps > 0 && (
                    <span className="flex items-center gap-1.5" title={`${job.done} of ${job.steps} checks done`}>
                        <span className="block h-0.5 w-8 overflow-hidden rounded-full bg-white/10">
                            <span className={`block h-full rounded-full ${progress === 100 ? 'bg-jade-400' : 'bg-zinc-500'}`} style={{ width: `${progress}%` }}></span>
                        </span>
                        <span className="font-mono text-[10px] text-zinc-600">{job.done}/{job.steps}</span>
                    </span>
                )}

                {job.qty && <span className="font-mono text-[10px] text-zinc-600">×{job.qty}</span>}

                {job.assignee && <KanbanAssignee name={job.assignee} size="xs" station={job.station} className="ml-auto" />}
            </div>
        </article>
    );
}
