<script setup>
import { computed } from 'vue';
import KanbanTag from './Tag.vue';
import KanbanAssignee from './Assignee.vue';

const props = defineProps({
    job: { type: Object, required: true },
    dragging: { type: Boolean, default: false },
    href: { type: String, default: '/templates/kanban/screens/ticket' },
});

const ageTone = computed(() => {
    if (props.job.days >= 5) {
        return 'text-red-300';
    }

    return props.job.days >= 3 ? 'text-amber-300' : 'text-zinc-600';
});

const progress = computed(() => (props.job.steps > 0 ? Math.round((props.job.done / props.job.steps) * 100) : 0));
</script>

<template>
    <article
        draggable="true"
        class="group/card relative cursor-grab rounded-xl border border-white/8 bg-ink-900 p-3 transition-[border-color,transform,opacity] duration-200 ease-snap select-none hover:border-white/20 active:cursor-grabbing"
        :class="dragging ? 'rotate-1 opacity-40' : ''"
    >
        <span v-if="job.blocked" aria-hidden="true" class="absolute inset-y-3 left-0 w-0.5 rounded-full bg-red-400"></span>

        <div class="flex items-center gap-2">
            <span class="font-mono text-[10px] text-zinc-600">{{ job.code }}</span>
            <span v-if="job.station" class="truncate font-mono text-[10px] text-zinc-700">{{ job.station }}</span>
            <span class="ml-auto font-mono text-[10px]" :class="ageTone">{{ job.days }}d</span>
        </div>

        <h4 class="mt-1.5 text-[13px]/5 font-medium text-cream">
            <a :href="href" target="_top" class="outline-none transition-colors duration-150 group-hover/card:text-jade-300 focus-visible:text-jade-300">{{ job.title }}</a>
        </h4>

        <div v-if="job.tags?.length" class="mt-2.5 flex flex-wrap gap-1">
            <KanbanTag v-for="tag in job.tags" :key="tag.label" :label="tag.label" :tone="tag.tone" />
        </div>

        <div class="mt-3 flex items-center gap-2.5 border-t border-white/5 pt-2.5">
            <span v-if="job.steps > 0" class="flex items-center gap-1.5" :title="`${job.done} of ${job.steps} checks done`">
                <span class="block h-0.5 w-8 overflow-hidden rounded-full bg-white/10">
                    <span class="block h-full rounded-full" :class="progress === 100 ? 'bg-jade-400' : 'bg-zinc-500'" :style="{ width: `${progress}%` }"></span>
                </span>
                <span class="font-mono text-[10px] text-zinc-600">{{ job.done }}/{{ job.steps }}</span>
            </span>

            <span v-if="job.qty" class="font-mono text-[10px] text-zinc-600">×{{ job.qty }}</span>

            <KanbanAssignee v-if="job.assignee" :name="job.assignee" size="xs" :station="job.station" class="ml-auto" />
        </div>
    </article>
</template>
