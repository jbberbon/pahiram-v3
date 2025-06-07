<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import CheckoutItemList from './components/CheckoutItemList.vue';
import CheckoutRequestDetails from './components/CheckoutRequestDetails.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Checkout',
        href: '/borrow/checkout',
    },
];
</script>

<template>
    <Head title="Checkout items" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-[calc(100vh-80px)] w-full flex-col justify-between overflow-y-auto p-4">
            <div class="flex w-full flex-col gap-3 pb-4 sm:gap-5 lg:flex-row">
                <CheckoutRequestDetails
                    :class="'self-start rounded-xl sm:bg-neutral-100/70 sm:p-4 dark:sm:bg-[hsl(var(--sidebar-background))] lg:w-[40%]'"
                />
                <CheckoutItemList :class="'rounded-xl sm:bg-neutral-100/70 sm:p-4 dark:sm:bg-[hsl(var(--sidebar-background))] lg:w-[60%]'" />
            </div>

            <div class="flex w-full justify-end">
                <Button type="submit" form="borrow-form" class="w-[100%] bg-yellow-500 hover:bg-yellow-500/90 sm:max-w-[200px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59"
                        />
                    </svg>
                    Submit Request
                </Button>
            </div>
        </div>
    </AppLayout>
</template>
