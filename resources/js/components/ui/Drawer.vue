<script setup>
import { computed, ref, watch } from 'vue';

const props = defineProps({
    title: { type: String, required: true },
    side: { type: String, default: 'right' },
});

const open = defineModel('open', { type: Boolean, default: false });
const dialog = ref(null);

const sides = {
    right: 'ml-auto border-l translate-x-6 open:translate-x-0 starting:open:translate-x-6',
    left: 'mr-auto border-r -translate-x-6 open:translate-x-0 starting:open:-translate-x-6',
};

const dialogClasses = computed(() => [
    'm-0 h-dvh max-h-none w-full max-w-sm border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,translate,display,overlay] transition-discrete duration-300 ease-snap outline-none open:opacity-100 starting:open:opacity-0 backdrop:bg-ink-950/70 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-300 open:backdrop:opacity-100 starting:open:backdrop:opacity-0',
    sides[props.side] ?? sides.right,
]);

watch(open, (isOpen) => {
    if (isOpen) {
        dialog.value.showModal();
    } else {
        dialog.value.close();
    }
});

const onBackdropClick = (event) => {
    if (event.target === dialog.value) {
        open.value = false;
    }
};
</script>

<template>
    <dialog ref="dialog" :class="dialogClasses" @close="open = false" @click="onBackdropClick">
        <div class="flex h-full flex-col">
            <div class="flex items-center justify-between border-b border-white/5 px-5 py-4">
                <h2 class="text-base font-semibold tracking-tight text-cream">{{ title }}</h2>
                <button
                    type="button"
                    aria-label="Close"
                    class="grid size-6 shrink-0 place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    @click="open = false"
                >
                    <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" /></svg>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-5 text-sm/6 text-zinc-400"><slot /></div>
            <div v-if="$slots.footer" class="flex justify-end gap-2 border-t border-white/5 px-5 py-4"><slot name="footer" /></div>
        </div>
    </dialog>
</template>
