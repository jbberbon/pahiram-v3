<!-- Create a new component: LazyTransition.vue -->
<script lang="ts" setup>
import { ref, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        required: true,
    },
    delay: {
        type: Number,
        default: 300,
    },
});

const shouldRender = ref(props.show);

watch(
    () => props.show,
    (isVisible) => {
        if (isVisible) {
            shouldRender.value = true;
        } else {
            setTimeout(() => {
                shouldRender.value = false;
            }, props.delay);
        }
    },
    { immediate: true },
);
</script>

<template>
    <template v-if="shouldRender">
        <slot></slot>
    </template>
</template>
