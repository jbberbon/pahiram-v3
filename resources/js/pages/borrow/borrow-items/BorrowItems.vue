<script setup lang="ts">
// import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { useBorrowItems } from '@/composables/api-queries/borrower/useBorrowItem';
import { useSelectedBorrowItem } from '@/composables/useSelectedBorrowItem';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { BorrowItemListFilters } from '@/types/borrow-item.types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import BorrowItemCard from './components/BorrowItemCard.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Borrow items',
        href: '/borrow-items',
    },
];

const filter = ref<BorrowItemListFilters>({});

const { data } = useBorrowItems(filter.value);

const selectedBorrowItem = useSelectedBorrowItem();

</script>

<template>
    <Head title="Borrow items" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <BorrowItemCard 
                v-for="item in data?.data.items" 
                :key="item.id" v-bind="item" 
                @click="selectedBorrowItem.setItem(item)"
            />
        </div>
        <!-- <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-4">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div> -->
    </AppLayout>
</template>
