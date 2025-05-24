<script lang="ts" setup>
import { convertIsoToHumanFormatShort } from '@/lib/utils';
import { BorrowItemReservation } from '@/types/borrow-item.types';
import { Card } from '../ui/card';

const props = defineProps<{
    item: BorrowItemReservation;
}>();
</script>

<template>
    <Card class="flex w-[100%] p-2 sm:p-4 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer">
        <!-- Image -->
        <div class="aspect-square w-[25%] rounded outline outline-1 outline-gray-200 dark:outline-gray-600">
            <span v-if="props.item.images.length === 0" class="flex h-full items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                    />
                </svg>
            </span>

            <img v-else :src="props.item.images[0]" alt="Item Image" class="h-full w-full rounded-lg object-cover" />
        </div>

        <!-- Details -->
        <div class="flex w-[75%] flex-col px-4">
            <h2 class="w-full truncate font-semibold">{{ props.item.reserved_count ?? 0 }}x {{ props.item.name }}</h2>
            <div class="flex flex-col gap-1">
                <p class="text-sm leading-none">{{ convertIsoToHumanFormatShort(props.item.start_date) }}</p>

                <p class="text-sm leading-none">{{ convertIsoToHumanFormatShort(props.item.end_date) }}</p>
            </div>
        </div>
    </Card>
</template>
