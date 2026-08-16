<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'aurora' },
    speed: { type: Number, default: 14 },
});

const style = computed(() => ({ '--ui-bg-speed': `${Math.max(1, props.speed)}s` }));
</script>

<template>
    <div class="relative isolate overflow-hidden bg-ink-950" :style="style">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
            <template v-if="variant === 'grid'">
                <div
                    class="absolute -inset-12 bg-[linear-gradient(to_right,color-mix(in_srgb,var(--color-white)_6%,transparent)_1px,transparent_1px),linear-gradient(to_bottom,color-mix(in_srgb,var(--color-white)_6%,transparent)_1px,transparent_1px)] bg-[size:40px_40px] animate-[ui-animated-background-pan_var(--ui-bg-speed)_linear_infinite]"
                ></div>
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_65%_55%_at_50%_0%,color-mix(in_srgb,var(--color-jade-500)_26%,transparent),transparent)]"></div>
            </template>
            <template v-else>
                <span
                    class="absolute -top-1/2 -left-1/4 aspect-square w-3/4 rounded-full bg-jade-500/35 blur-3xl animate-[ui-animated-background-drift_var(--ui-bg-speed)_ease-in-out_infinite_alternate]"
                ></span>
                <span
                    class="absolute -right-1/4 -bottom-1/2 aspect-square w-3/4 rounded-full bg-jade-300/20 blur-3xl animate-[ui-animated-background-drift_var(--ui-bg-speed)_ease-in-out_infinite_alternate-reverse]"
                ></span>
            </template>
        </div>

        <slot />
    </div>
</template>

<style>
@keyframes ui-animated-background-drift {
    from {
        transform: translate(-12%, -8%) scale(1);
    }

    to {
        transform: translate(18%, 12%) scale(1.25);
    }
}

@keyframes ui-animated-background-pan {
    to {
        transform: translate(40px, 40px);
    }
}

@media (prefers-reduced-motion: reduce) {
    [class*='ui-animated-background-'] {
        animation: none;
    }
}
</style>
