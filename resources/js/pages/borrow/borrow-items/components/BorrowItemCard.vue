<script lang="ts" setup>
import DepartmentBadge from '@/components/Badges/DepartmentBadge.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import { BorrowItem } from '@/types/borrow-item.types';

import { defineProps } from 'vue';

// define the props
const props = defineProps<BorrowItem>();
</script>

<template>
    <Card class="flex h-[20rem] max-w-[15rem] flex-col">
        <!-- Image / Broken Img Icon -->
        <div class="flex-[0_0_60%] rounded-t-lg bg-gray-300">
            <div v-if="props.images.length === 0" class="flex h-full items-center justify-center">
                <img src="/images/img-icon.svg" alt="image" class="mx-auto my-auto h-20 w-20" />
            </div>
        </div>

        <!-- Details -->
        <div class="flex w-full flex-[0_0_40%] flex-col gap- p-3">
            <div class="">
                <DepartmentBadge :department="props.department" />
                <h2 class="w-full truncate font-semibold">{{ props.name }}</h2>
            </div>

            <div class="align-center flex justify-between">
                <div class="flex flex-col justify-center">
                    <h4 class="font-medium">{{ props.count }} available</h4>
                </div>

                <Button variant="outline" size="default">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                        />
                    </svg>
                </Button>
            </div>
        </div>
        <!-- <Carousel class="relative w-full max-w-xs">
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
                <CarouselPrevious />
                <CarouselNext />
            </Carousel> -->
        <!-- </CardContent> -->
    </Card>
</template>
