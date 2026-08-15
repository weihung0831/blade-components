<template>
    <div
        role="group"
        class="inline-flex divide-x divide-white/10 overflow-hidden rounded-lg border border-white/10 [&>button]:h-9 [&>button]:px-4 [&>button]:text-sm [&>button]:font-medium [&>button]:text-zinc-400 [&>button]:transition-colors [&>button]:duration-150 [&>button]:outline-none [&>button:hover]:text-cream [&>button:focus-visible]:ring-2 [&>button:focus-visible]:ring-inset [&>button:focus-visible]:ring-jade-500/70 [&>button[data-active]]:bg-white/5 [&>button[data-active]]:text-cream [&>button:disabled]:pointer-events-none [&>button:disabled]:opacity-40 [&_svg]:size-4"
    >
        <slot />
    </div>
</template>
