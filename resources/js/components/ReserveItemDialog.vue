<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter } from '@/components/ui/dialog';
import { useCart } from '@/composables/useCart';
import { useSelectedBorrowItem } from '@/composables/useSelectedBorrowItem';
import { convertIsoToHumanFormat } from '@/lib/utils';
import { computed, ref } from 'vue';
import DepartmentBadge from './Badges/DepartmentBadge.vue';
import { Badge } from './ui/badge';
import { Card, CardContent } from './ui/card';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from './ui/carousel';
import { Label } from './ui/label';
import { NumberField, NumberFieldContent, NumberFieldDecrement, NumberFieldIncrement, NumberFieldInput } from './ui/number-field';

const { insertOfficeItem } = useCart();
const selectedBorrowItem = useSelectedBorrowItem();
const isOpen = computed({
    get: () => selectedBorrowItem.item !== null,
    set: (val) => {
        if (!val) {
            isDateErrorDisplayed.value = false;
            selectedBorrowItem.setItem(null); // clear the selection when dialog closes
        }
    },
});

const availableCountBadgeColor = computed(() => {
    const count = selectedBorrowItem?.item?.available_count;
    return count && count >= 3
        ? 'bg-emerald-400 hover:bg-emerald-500'
        : count && count <= 1
          ? 'bg-pink-300 hover:bg-pink-400'
          : 'bg-orange-300 hover:bg-orange-400';
});

const isDateErrorDisplayed = ref(false);
const handleSaveItemToCart = () => {
    if (!selectedBorrowItem || !selectedBorrowItem.item) return;

    // Check start and end date if exists
    if (!selectedBorrowItem.item.start_date || !selectedBorrowItem.item.end_date) {
        isDateErrorDisplayed.value = true;
        return;
    }

    // Initialize the value of reserved count if not set
    if (!selectedBorrowItem.item?.reserved_count) selectedBorrowItem.item['reserved_count'] = 1;

    // Insert
    insertOfficeItem(selectedBorrowItem.item);
    isDateErrorDisplayed.value = false;

    // Add delay before closing modal
    setTimeout(() => {
        isOpen.value = false;
    }, 100);
};
</script>

<template>
    <Dialog v-model:open="isOpen">
        <DialogContent class="dialog grid max-h-[95%] max-w-[95%] grid-cols-1 gap-4 overflow-y-scroll sm:max-w-[50%] md:max-w-[40%] lg:max-w-[500px]">
            <!-- Image side -->
            <div class="flex flex-col gap-2">
                <Carousel class="relative w-full">
                    <CarouselContent>
                        <CarouselItem v-for="(_, index) in 5" :key="index">
                            <div class="p-1">
                                <Card>
                                    <CardContent class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">{{ index + 1 }}</span>
                                    </CardContent>
                                </Card>
                            </div>
                        </CarouselItem>
                    </CarouselContent>

                    <CarouselPrevious class="left-[10px]" />
                    <CarouselNext class="right-[10px]" />
                </Carousel>
            </div>

            <!-- Item details and Input fields -->
            <div class="flex w-full flex-col gap-5">
                <!-- Details -->
                <div class="flex flex-col gap-2">
                    <h1 class="truncate text-xl font-bold">{{ selectedBorrowItem.item?.name }}</h1>
                    <div class="flex gap-2">
                        <Badge :class="availableCountBadgeColor">{{ selectedBorrowItem.item?.available_count }} available</Badge>
                        <DepartmentBadge :department="selectedBorrowItem.item?.department ?? ''" />
                    </div>

                    <p v-if="selectedBorrowItem.item?.description">
                        {{ selectedBorrowItem.item?.description }}
                    </p>
                    <p v-else class="italics">No description available</p>
                </div>

                <!-- Input fields -->
                <div class="flex flex-col gap-3">
                    <!-- Selected item count -->
                    <NumberField
                        id="reserve-dialog-selected-quantity"
                        :default-value="selectedBorrowItem.item?.reserved_count ?? 1"
                        :min="1"
                        :max="selectedBorrowItem.item?.available_count ?? 0"
                        @update:modelValue="(val) => selectedBorrowItem.updateReservedCount(val)"
                    >
                        <Label for="reserve-dialog-selected-quantity">Requested quantity</Label>
                        <NumberFieldContent>
                            <NumberFieldDecrement />
                            <NumberFieldInput />
                            <NumberFieldIncrement />
                        </NumberFieldContent>
                    </NumberField>

                    <!-- Date Range Inputs -->
                    <div v-if="!selectedBorrowItem.item?.start_date">
                        <Button variant="outline" class="w-full" @click="selectedBorrowItem.handleOpenCalendar()">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z"
                                />
                            </svg>
                            Select date range
                        </Button>
                        <!-- Date range error message -->
                        <span v-if="isDateErrorDisplayed" class="text-sm text-red-500">Please select date range.</span>
                    </div>

                    <div v-else class="flex w-full flex-col">
                        <Label for="reserve-dialog-selected-dates" class="pb-1">Selected dates</Label>
                        <Button id="reserve-dialog-selected-dates" variant="outline" class="w-full" @click="selectedBorrowItem.handleOpenCalendar()">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"
                                />
                            </svg>

                            {{
                                selectedBorrowItem.item?.start_date
                                    ? convertIsoToHumanFormat(selectedBorrowItem.item?.start_date)
                                    : 'Select start date'
                            }}
                        </Button>

                        <Button variant="ghost" disabled size="sm">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                            </svg>
                        </Button>

                        <Button variant="outline" @click="selectedBorrowItem.handleOpenCalendar()">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"
                                />
                            </svg>
                            {{ selectedBorrowItem.item?.end_date ? convertIsoToHumanFormat(selectedBorrowItem.item?.end_date) : 'Select end date' }}
                        </Button>
                    </div>
                </div>
            </div>
            <DialogFooter>
                <Button type="submit" class="bg-yellow-500 hover:bg-yellow-600" @click="handleSaveItemToCart">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                        />
                    </svg>
                    Add to bag
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<style>
@media screen and (max-width: 640px) and (min-width: 450px) {
    .dialog {
        max-width: 70%;
    }
}
</style>
