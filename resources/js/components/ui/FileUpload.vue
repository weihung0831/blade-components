<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    hint: { type: String, default: '10 MB max' },
    multiple: { type: Boolean, default: false },
    compact: { type: Boolean, default: false },
});

const emit = defineEmits(['change']);

const files = ref([]);
const dragover = ref(false);

const summary = computed(() => {
    if (files.value.length === 0) {
        return 'No file selected';
    }

    return files.value.length === 1 ? files.value[0].name : `${files.value.length} files`;
});

const formatSize = (bytes) => {
    if (bytes >= 1048576) {
        return `${(bytes / 1048576).toFixed(1)} MB`;
    }

    if (bytes >= 1024) {
        return `${Math.round(bytes / 1024)} KB`;
    }

    return `${bytes} B`;
};

const setFiles = (next) => {
    files.value = next;
    emit('change', files.value);
};

const addFiles = (list) => {
    setFiles(props.multiple ? [...files.value, ...list] : [...list].slice(0, 1));
};

const removeFile = (index) => {
    setFiles(files.value.filter((file, i) => i !== index));
};

const onDrop = (event) => {
    dragover.value = false;
    addFiles(event.dataTransfer.files);
};
</script>

<template>
    <div :class="compact ? 'w-64' : 'w-72'">
        <label
            v-if="compact"
            class="flex cursor-pointer items-center gap-3 rounded-lg border bg-ink-950 p-1.5 transition-colors duration-150 focus-within:border-jade-500"
            :class="dragover ? 'border-jade-500' : 'border-white/10'"
            @dragover.prevent="dragover = true"
            @dragleave.prevent="dragover = false"
            @drop.prevent="onDrop"
        >
            <input type="file" :multiple="multiple" class="sr-only" @change="addFiles($event.target.files)" />
            <span class="flex h-7 shrink-0 items-center rounded-md border border-white/10 px-2.5 text-xs font-medium text-zinc-300 transition-colors duration-150 hover:border-white/25">Choose file</span>
            <span class="truncate text-xs" :class="files.length > 0 ? 'text-zinc-300' : 'text-zinc-600'">{{ summary }}</span>
        </label>
        <label
            v-else
            class="grid cursor-pointer place-items-center gap-1.5 rounded-xl border border-dashed px-4 py-8 text-center transition-colors duration-150 focus-within:border-jade-500"
            :class="dragover ? 'border-jade-500 bg-jade-500/5' : 'border-white/15 bg-ink-950/50 hover:border-white/30'"
            @dragover.prevent="dragover = true"
            @dragleave.prevent="dragover = false"
            @drop.prevent="onDrop"
        >
            <input type="file" :multiple="multiple" class="sr-only" @change="addFiles($event.target.files)" />
            <svg class="size-5 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M8 10.5v-7M5 6l3-2.5L11 6M3 12.5h10" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <p class="text-sm text-zinc-400">Drop {{ multiple ? 'files' : 'a file' }} here</p>
            <p class="text-xs text-zinc-600">or <span class="text-jade-400">browse</span> · {{ hint }}</p>
        </label>
        <ul v-if="files.length" class="mt-2 flex flex-col gap-1.5">
            <li v-for="(file, index) in files" :key="`${file.name}-${index}`" class="flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 py-2 pr-2 pl-3">
                <svg class="size-3.5 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M9.5 1.5h-5a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4.5l-3-3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><path d="M9.5 1.5v3h3" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                <span class="min-w-0 flex-1 truncate text-xs text-zinc-300">{{ file.name }}</span>
                <span class="shrink-0 font-mono text-[10px] text-zinc-600">{{ formatSize(file.size) }}</span>
                <button type="button" aria-label="Remove file" @click="removeFile(index)" class="grid size-5 shrink-0 cursor-pointer place-items-center rounded text-zinc-600 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                    <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3l-6 6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                </button>
            </li>
        </ul>
    </div>
</template>
