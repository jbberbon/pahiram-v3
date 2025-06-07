<script lang="ts" setup>
import DepartmentBadge from '@/components/Badges/DepartmentBadge.vue';
import { Badge } from '@/components/ui/badge';
import Card from '@/components/ui/card/Card.vue';
import { TooltipProvider } from '@/components/ui/tooltip';
import { BorrowItem } from '@/types/borrow-item.types';
import { defineProps } from 'vue';

import { Tooltip, TooltipTrigger } from '@/components/ui/tooltip';
import TooltipContent from '@/components/ui/tooltip/TooltipContent.vue';

const props = defineProps<BorrowItem>();
</script>

<template>
    <Card class="flex h-[18rem] max-w-[13rem] flex-col bg-neutral-100/50 hover:bg-neutral-200/40 dark:bg-neutral-900/20 dark:hover:bg-neutral-800/30">
        <!-- Image / Broken Img Icon -->
        <div class="flex-[0_0_60%] rounded-t-lg bg-white dark:bg-neutral-900">
            <div v-if="props.images.length === 0" class="flex h-full items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="size-16">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                    />
                </svg>
            </div>
        </div>

        <!-- Details -->
        <div class="flex w-full flex-[0_0_40%] flex-col gap-2 p-3">
            <div class="">
                <DepartmentBadge :department="props.department" />
                <h2 class="w-full truncate font-semibold text-sm">{{ props.name }}</h2>
            </div>

            <div class="align-center flex justify-between pt-1 pb-2">
                <div class="flex flex-col justify-center">
                    <h5 class="text-xs leading-none">Available</h5>
                    <h4 class="font-semibold leading-none text-sm">{{ props.available_count ?? 0 }} {{ props.available_count <= 1 ? 'item' : 'items' }}</h4>
                </div>

                <TooltipProvider>
                    <Tooltip>
                        <TooltipTrigger as-child>
                            <Badge
                                variant="outline"
                                :class="props.is_required_supervisor_approval ? 'hover:bg-red-500' : 'hover:bg-yellow-500'"
                                class="hover:cursor-pointer"
                            >
                                <!-- Locked -->
                                <svg
                                    v-if="props.is_required_supervisor_approval"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="size-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                    />
                                </svg>

                                <!-- Unlocked -->
                                <svg
                                    v-else
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="size-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                                    />
                                </svg>
                            </Badge>
                        </TooltipTrigger>

                        <TooltipContent>
                            <p v-if="props.is_required_supervisor_approval" class="text-black dark:text-white">Requires lending supervisor approval</p>
                            <p v-else>Not required lending supervisor approval</p>
                        </TooltipContent>
                    </Tooltip>
                </TooltipProvider>
            </div>
        </div>
    </Card>
</template>
