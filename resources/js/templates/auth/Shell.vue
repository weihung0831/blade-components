<script setup>
defineProps({
    title: { type: String, default: 'Sign in' },
    subtitle: { type: String, default: null },
});

const events = [
    { time: '02:41:08', name: 'auth.session.created', meta: 'ap-1' },
    { time: '02:40:55', name: 'sso.saml.asserted', meta: 'northbeam' },
    { time: '02:40:12', name: 'device.trusted', meta: '+1' },
    { time: '02:38:47', name: 'invite.accepted', meta: 'seat 312' },
];

const regions = [
    { label: 'ap-1', active: true },
    { label: 'sfo-2', active: false },
    { label: 'fra-1', active: false },
];

const slots = Array.from({ length: 30 }, (empty, index) => index);
const incidents = [17, 18];
</script>

<template>
    <div class="flex h-full min-h-[42rem] w-full bg-ink-900">
        <aside class="dot-grid relative hidden w-[42%] max-w-md shrink-0 flex-col justify-between overflow-hidden border-r border-white/5 bg-ink-950 p-8 lg:flex">
            <span aria-hidden="true" class="pointer-events-none absolute -top-24 -left-20 size-72 rounded-full bg-jade-500/10 blur-3xl"></span>

            <div class="relative flex items-center gap-2">
                <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                <span class="text-sm font-medium text-cream">wharf</span>
                <span class="rounded-full border border-white/10 px-1.5 font-mono text-[10px] text-zinc-500">ap-1</span>
            </div>

            <div class="relative">
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Platform access</p>
                <h2 class="mt-3 text-2xl/8 font-semibold tracking-tight text-cream">1,284 storefronts run on wharf, across three regions.</h2>
                <p class="mt-3 text-sm/6 text-zinc-500">Sessions are pinned to a region. Sign in and you land in the one nearest you — <span class="text-zinc-300">ap-1</span> today.</p>

                <ul class="mt-8 flex flex-col gap-2 font-mono text-[11px]">
                    <li v-for="event in events" :key="event.time" class="flex items-center gap-3 border-l border-white/8 pl-3">
                        <span class="text-zinc-600">{{ event.time }}</span>
                        <span class="truncate text-zinc-400">{{ event.name }}</span>
                        <span class="ml-auto shrink-0 text-jade-400">{{ event.meta }}</span>
                    </li>
                </ul>
            </div>

            <div class="relative">
                <div class="flex items-baseline justify-between font-mono text-[10px] text-zinc-600">
                    <span>auth.wharf.app · 30d</span>
                    <span class="text-jade-400">99.98%</span>
                </div>

                <div class="mt-2 flex h-6 items-end gap-[3px]">
                    <span
                        v-for="slot in slots"
                        :key="slot"
                        class="h-full flex-1 rounded-[1px]"
                        :class="incidents.includes(slot) ? 'bg-amber-400' : 'bg-jade-500/35'"
                    ></span>
                </div>

                <div class="mt-4 flex items-center gap-1.5">
                    <span
                        v-for="region in regions"
                        :key="region.label"
                        class="rounded-full border px-2 py-0.5 font-mono text-[10px]"
                        :class="region.active ? 'border-jade-500/40 bg-jade-500/10 text-jade-300' : 'border-white/8 text-zinc-600'"
                    >{{ region.label }}</span>
                    <span class="ml-auto font-mono text-[10px] text-zinc-600">SOC 2 · GDPR</span>
                </div>
            </div>
        </aside>

        <div class="flex min-w-0 flex-1 flex-col overflow-y-auto">
            <header class="flex h-14 shrink-0 items-center gap-4 px-5 sm:px-8">
                <div class="flex items-center gap-2 lg:hidden">
                    <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                    <span class="text-sm font-medium text-cream">wharf</span>
                </div>

                <div v-if="$slots.action" class="ml-auto flex shrink-0 items-center gap-1.5 text-[13px]">
                    <slot name="action" />
                </div>
            </header>

            <main class="flex flex-1 items-center justify-center px-5 py-8 sm:px-8">
                <div class="w-full max-w-sm">
                    <h1 class="text-xl font-semibold tracking-tight text-cream">{{ title }}</h1>
                    <p v-if="subtitle" class="mt-2 text-[13px]/6 text-zinc-500">{{ subtitle }}</p>

                    <div class="mt-7">
                        <slot />
                    </div>
                </div>
            </main>

            <footer class="flex h-12 shrink-0 items-center gap-4 border-t border-white/5 px-5 font-mono text-[10px] text-zinc-600 sm:px-8">
                <span>© 2026 wharf</span>
                <a href="#" class="transition-colors duration-150 hover:text-zinc-400">Terms</a>
                <a href="#" class="transition-colors duration-150 hover:text-zinc-400">Privacy</a>
                <span class="ml-auto flex items-center gap-1.5">
                    <span class="size-1.5 rounded-full bg-jade-400"></span>
                    All systems normal
                </span>
            </footer>
        </div>
    </div>
</template>
