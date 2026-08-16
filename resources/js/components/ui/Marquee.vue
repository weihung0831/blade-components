<script setup>
import { computed } from 'vue';

const props = defineProps({
    speed: { type: Number, default: 20 },
    reverse: { type: Boolean, default: false },
    vertical: { type: Boolean, default: false },
    gap: { type: String, default: 'gap-3' },
    pauseOnHover: { type: Boolean, default: true },
    fade: { type: Boolean, default: true },
});

const rootClasses = computed(() => [
    'group relative overflow-hidden',
    props.vertical ? 'flex' : '',
    props.fade
        ? props.vertical
            ? '[mask-image:linear-gradient(to_bottom,transparent,black_12%,black_88%,transparent)]'
            : '[mask-image:linear-gradient(to_right,transparent,black_12%,black_88%,transparent)]'
        : '',
]);

const trackClasses = computed(() => [
    'flex',
    props.vertical
        ? 'flex-col h-max animate-[ui-marquee-y_var(--ui-marquee-speed)_linear_infinite]'
        : 'w-max animate-[ui-marquee-x_var(--ui-marquee-speed)_linear_infinite]',
    props.reverse ? '[animation-direction:reverse]' : '',
    props.pauseOnHover ? 'group-hover:[animation-play-state:paused]' : '',
]);

const groupClasses = computed(() => [
    'flex shrink-0',
    props.vertical ? 'flex-col pb-3' : 'pr-3',
    props.gap,
]);
</script>

<template>
    <div :class="rootClasses" :style="{ '--ui-marquee-speed': `${Math.max(1, speed)}s` }">
        <div :class="trackClasses">
            <div :class="groupClasses"><slot /></div>
            <div :class="groupClasses" aria-hidden="true"><slot /></div>
        </div>
    </div>
</template>

<style>
@keyframes ui-marquee-x {
    to {
        transform: translateX(-50%);
    }
}

@keyframes ui-marquee-y {
    to {
        transform: translateY(-50%);
    }
}

@media (prefers-reduced-motion: reduce) {
    [class*='ui-marquee-'] {
        animation: none;
    }
}
</style>
