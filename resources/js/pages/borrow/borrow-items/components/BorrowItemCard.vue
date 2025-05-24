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
    <Card class="flex h-[20rem] max-w-[15rem] flex-col hover:bg-gray-50 dark:hover:bg-gray-900">
        <!-- Image / Broken Img Icon -->
        <div class="flex-[0_0_60%] rounded-t-lg bg-gray-200 dark:bg-gray-300">
            <div v-if="props.images.length === 0" class="flex h-full items-center justify-center">
                <img src="/images/img-icon.svg" alt="image" class="mx-auto my-auto h-20 w-20" />
            </div>
        </div>

        <!-- Details -->
        <div class="flex w-full flex-[0_0_40%] flex-col gap-2 p-3">
            <div class="">
                <DepartmentBadge :department="props.department" />
                <h2 class="w-full truncate font-semibold">{{ props.name }}</h2>
            </div>

            <div class="align-center flex justify-between">
                <div class="flex flex-col justify-center">
                    <h5 class="text-xs leading-none">Available</h5>
                    <h4 class="font-semibold leading-none">{{ props.available_count ?? 0 }} {{ props.available_count <= 1 ? 'item' : 'items' }}</h4>
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
                                    stroke-width="1.5"
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
                                    stroke-width="1.5"
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
                            <p v-if="props.is_required_supervisor_approval">Requires lending Supervisor approval</p>
                            <p v-else>Not required lending Supervisor approval</p>
                        </TooltipContent>
                    </Tooltip>
                </TooltipProvider>
            </div>
        </div>
    </Card>
</template>
