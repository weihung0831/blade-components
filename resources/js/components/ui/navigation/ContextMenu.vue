<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

defineProps({
    items: { type: Array, default: () => [] },
});

const itemClasses =
    'flex w-full items-center justify-between gap-8 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';

const panel = ref(null);

const tone = (entry) =>
    entry.danger ? 'text-red-400 hover:bg-red-500/10' : 'text-zinc-300 hover:bg-white/5 hover:text-cream';

const close = () => {
    if (panel.value?.matches(':popover-open')) {
        panel.value.hidePopover();
    }
};

const show = (event) => {
    event.preventDefault();
    close();
    panel.value.showPopover();

    const { width, height } = panel.value.getBoundingClientRect();

    panel.value.style.left = Math.min(event.clientX, window.innerWidth - width - 8) + 'px';
    panel.value.style.top = Math.min(event.clientY, window.innerHeight - height - 8) + 'px';
};

onMounted(() => document.addEventListener('scroll', close, { capture: true, passive: true }));
onBeforeUnmount(() => document.removeEventListener('scroll', close, { capture: true }));
</script>

<template>
    <div @contextmenu="show">
        <slot />

        <div
            ref="panel"
            role="menu"
            popover="auto"
            class="fixed inset-auto m-0 scale-95 rounded-lg border border-white/10 bg-ink-900 p-1 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-150 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0"
            @click="close"
        >
            <template v-for="(entry, index) in items" :key="index">
                <hr v-if="entry.separator" class="my-1 border-white/5" />
                <button v-else type="button" role="menuitem" :class="[itemClasses, tone(entry)]">
                    <span>{{ entry.label }}</span>
                    <span v-if="entry.shortcut" class="font-mono text-[11px] text-zinc-600">{{ entry.shortcut }}</span>
                </button>
            </template>
        </div>
    </div>
</template>
