<script setup>
import { computed, nextTick, onBeforeUnmount, onMounted, ref, watch } from 'vue';

const props = defineProps({
    placeholder: { type: String, default: 'Search commands…' },
    shortcut: { type: String, default: 'k' },
    groups: { type: Array, default: () => [] },
});

const emit = defineEmits(['select']);
const open = defineModel('open', { type: Boolean, default: false });

const dialog = ref(null);
const input = ref(null);
const query = ref('');
const active = ref(0);

const matches = computed(() => {
    const needle = query.value.trim().toLowerCase();

    return props.groups
        .map((group) => ({
            ...group,
            items: (group.items ?? []).filter((item) => needle === '' || item.label.toLowerCase().includes(needle)),
        }))
        .filter((group) => group.items.length > 0);
});

const flat = computed(() => matches.value.flatMap((group) => group.items));

const select = (item) => {
    if (!item) {
        return;
    }

    emit('select', item);
    open.value = false;
};

const onBackdropClick = (event) => {
    if (event.target === dialog.value) {
        open.value = false;
    }
};

const onKeydown = (event) => {
    if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === props.shortcut) {
        event.preventDefault();
        open.value = true;

        return;
    }

    if (!open.value) {
        return;
    }

    if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
        event.preventDefault();

        const step = event.key === 'ArrowDown' ? 1 : flat.value.length - 1;
        active.value = (active.value + step) % flat.value.length;
    }

    if (event.key === 'Enter') {
        event.preventDefault();
        select(flat.value[active.value]);
    }
};

watch(open, async (isOpen) => {
    if (isOpen) {
        query.value = '';
        active.value = 0;
        dialog.value.showModal();
        await nextTick();
        input.value.focus();
    } else {
        dialog.value.close();
    }
});

watch(query, () => {
    active.value = 0;
});

onMounted(() => document.addEventListener('keydown', onKeydown));
onBeforeUnmount(() => document.removeEventListener('keydown', onKeydown));
</script>

<template>
    <dialog
        ref="dialog"
        class="mx-auto mt-[12vh] mb-0 w-[calc(100%-2.5rem)] max-w-lg scale-95 overflow-hidden rounded-xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-200 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/70 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-200 open:backdrop:opacity-100 starting:open:backdrop:opacity-0"
        @close="open = false"
        @click="onBackdropClick"
    >
        <div class="flex items-center gap-2.5 border-b border-white/5 px-4 py-3">
            <svg class="size-4 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
            <input
                ref="input"
                v-model="query"
                type="text"
                autocomplete="off"
                :placeholder="placeholder"
                class="w-full bg-transparent text-sm text-cream outline-none placeholder:text-zinc-600"
            />
            <span class="shrink-0 rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">ESC</span>
        </div>

        <div class="max-h-72 overflow-y-auto p-1.5">
            <div v-for="group in matches" :key="group.label">
                <p v-if="group.label" class="px-2.5 pt-2 pb-1 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ group.label }}</p>
                <button
                    v-for="item in group.items"
                    :key="item.label"
                    type="button"
                    :data-active="flat[active] === item ? '' : null"
                    class="flex w-full items-center justify-between gap-4 rounded-md px-2.5 py-2 text-left text-sm text-zinc-300 outline-none data-active:bg-white/5 data-active:text-cream"
                    @click="select(item)"
                    @mousemove="active = flat.indexOf(item)"
                >
                    <span>{{ item.label }}</span>
                    <span v-if="item.shortcut" class="shrink-0 font-mono text-[11px] text-zinc-600">{{ item.shortcut }}</span>
                </button>
            </div>

            <p v-if="flat.length === 0" class="px-2.5 py-8 text-center text-sm text-zinc-600">Nothing matches that.</p>
        </div>

        <div class="flex items-center gap-4 border-t border-white/5 px-4 py-2.5 font-mono text-[10px] text-zinc-600">
            <span>↑↓ move</span>
            <span>↵ run</span>
        </div>
    </dialog>
</template>
