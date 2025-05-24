<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Checkout',
        href: '/borrow/checkout',
    },
];
</script>

<template>
    <Head title="Borrow items" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class=""></div>
        <div>hello worldo</div>
    </AppLayout>
</template>
