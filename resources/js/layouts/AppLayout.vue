<script setup lang="ts">
import LazyTransition from '@/components/LazyTransition.vue';
import ReserveItemCalendarDialog from '@/components/ReserveItemCalendarDialog.vue';
import ReserveItemDialog from '@/components/ReserveItemDialog.vue';
import { useCart } from '@/composables/useCart';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { defineAsyncComponent } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const Cart = defineAsyncComponent(() => import('@/components/Cart/Cart.vue'));
const cart = useCart();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>

    <!-- Global UIs -->
    <ReserveItemDialog />
    <ReserveItemCalendarDialog />

    <LazyTransition :show="cart.isCartOpen">
        <Cart />
    </LazyTransition>
</template>
