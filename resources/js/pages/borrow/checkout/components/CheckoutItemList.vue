<script lang="ts" setup>
import CartItem from '@/components/Cart/CartItem.vue';
import ConfirmationDialog from '@/components/ConfirmationDialog.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { useCart } from '@/composables/useCart';
import { ALL_DEPARTMENTS } from '@/lib/constants/departments';
import { computed, ref } from 'vue';

const props = defineProps<{
    class?: string;
}>();

const cart = useCart();

// Clear items in an office
const isDeleteBMO = ref(false);
const isDeleteESLO = ref(false);
const isDeleteITRO = ref(false);
const isAllSelected = computed({
    get() {
        return isDeleteBMO.value && isDeleteESLO.value && isDeleteITRO.value;
    },
    set(value: boolean) {
        isDeleteBMO.value = value;
        isDeleteESLO.value = value;
        isDeleteITRO.value = value;
    },
});
const isOneSelected = computed(() => {
    return isDeleteBMO.value || isDeleteESLO.value || isDeleteITRO.value;
});

const handleDeleteOfficeItems = () => {
    if (isDeleteBMO.value) {
        cart.clearOfficeItems('BMO');
    }
    if (isDeleteESLO.value) {
        cart.clearOfficeItems('ESLO');
    }
    if (isDeleteITRO.value) {
        cart.clearOfficeItems('ITRO');
    }
};

// Collapse per office
const isCollapsedBmo = ref(false);
const isCollapsedEslo = ref(false);
const isCollapsedItro = ref(false);
</script>

<template>
    <div :class="props.class" class="flex w-full flex-col gap-3 sm:border sm:dark:border-neutral-900">
        <div class="flex items-center justify-between">
            <h3 class="font-semibold">Item list</h3>
            <ConfirmationDialog
                :confirm-text="'Delete'"
                :cancel-text="'Cancel'"
                @confirm="handleDeleteOfficeItems"
                :title="'Delete checkout items'"
                :description="'Are you sure you want to delete these items?'"
            >
                <Button variant="ghost" class="text-foreground" :disabled="cart.isEmpty || !isOneSelected">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                        />
                    </svg>
                </Button>
            </ConfirmationDialog>
        </div>

        <div class="flex flex-col gap-4 overflow-y-scroll sm:h-[calc(100vh-310px)] sm:p-3">
            <!-- BMO -->
            <div v-if="cart.items.BMO.length > 0" class="flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="isDeleteBMO" class="bg-white" />
                        <h3 class="text-sm font-medium">{{ ALL_DEPARTMENTS['BMO'].fullName }}</h3>
                    </div>
                    <Button @click="isCollapsedBmo = !isCollapsedBmo" variant="ghost">
                        <svg
                            v-if="isCollapsedBmo"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        <svg
                            v-else
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </Button>
                </div>
                <div
                    :class="isCollapsedBmo ? 'max-h-0 opacity-0' : 'max-h-[1000px] opacity-100'"
                    class="flex flex-col gap-2 overflow-hidden transition-all duration-500"
                >
                    <CartItem v-for="item in cart.items.BMO" v-bind:key="item.id" :item="item" :class="'bg-white dark:bg-neutral-950'" />
                </div>
            </div>

            <!-- ESLO -->
            <div v-if="cart.items.ESLO.length > 0" class="flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="isDeleteESLO" class="bg-white" />
                        <h3 class="text-sm font-medium">{{ ALL_DEPARTMENTS['ESLO'].fullName }}</h3>
                    </div>
                    <Button @click="isCollapsedEslo = !isCollapsedEslo" variant="ghost">
                        <svg
                            v-if="isCollapsedEslo"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        <svg
                            v-else
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </Button>
                </div>
                <div
                    :class="isCollapsedEslo ? 'max-h-0 opacity-0' : 'max-h-[1000px] opacity-100'"
                    class="flex flex-col gap-2 overflow-hidden transition-all duration-500"
                >
                    <CartItem v-for="item in cart.items.ESLO" v-bind:key="item.id" :item="item" :class="'bg-white dark:bg-neutral-950'" />
                </div>
            </div>

            <!-- ITRO -->
            <div v-if="cart.items.ITRO.length > 0" class="flex flex-col gap-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="isDeleteITRO" class="bg-white" />
                        <h3 class="text-sm font-medium">{{ ALL_DEPARTMENTS['ITRO'].fullName }}</h3>
                    </div>
                    <Button @click="isCollapsedItro = !isCollapsedItro" variant="ghost">
                        <svg
                            v-if="isCollapsedItro"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        <svg
                            v-else
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </Button>
                </div>
                <div
                    :class="isCollapsedItro ? 'max-h-0 opacity-0' : 'max-h-[1000px] opacity-100'"
                    class="flex flex-col gap-2 overflow-hidden transition-all duration-500"
                >
                    <CartItem v-for="item in cart.items.ITRO" v-bind:key="item.id" :item="item" :class="'bg-white dark:bg-neutral-950'" />
                </div>
            </div>

            <!-- Empty state -->
            <div v-if="cart.isEmpty" class="flex items-center justify-center p-4">
                <p class="text-sm text-gray-500">No items in the cart.</p>
            </div>
        </div>
        <div v-if="!cart.isEmpty" class="flex items-center gap-2 sm:p-3">
            <Checkbox v-model="isAllSelected" class="bg-white" :disabled="cart.isEmpty"/>
            <p class="text-sm font-medium leading-none">Select all</p>
        </div>
    </div>
</template>
