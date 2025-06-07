<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Sheet, SheetClose, SheetContent, SheetDescription, SheetHeader, SheetTitle } from '@/components/ui/sheet';
import { useCart } from '@/composables/useCart';
import { ALL_DEPARTMENTS } from '@/lib/constants/departments';
import { computed, ref } from 'vue';
import ConfirmationDialog from '../ConfirmationDialog.vue';
import { Checkbox } from '../ui/checkbox';
import CartItem from './CartItem.vue';
import { router } from '@inertiajs/vue3'

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
</script>

<template>
    <Sheet v-model:open="cart.isCartOpen">
        <SheetContent class="max-h-[100vh] w-screen max-w-none [&>button:first-of-type]:hidden">
            <SheetHeader class="pb-4">
                <SheetTitle class="flex justify-between gap-2">
                    <h2 class="text-lg font-semibold text-foreground">My bag</h2>

                    <ConfirmationDialog
                        :confirm-text="'Delete'"
                        :cancel-text="'Cancel'"
                        @confirm="handleDeleteOfficeItems"
                        :title="'Delete cart items'"
                        :description="'Are you sure you want to delete these cart items?'"
                    >
                        <Button variant="ghost" class="text-foreground" :disabled="cart.isEmpty || !isOneSelected">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-7"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </Button>
                    </ConfirmationDialog>
                </SheetTitle>
                <SheetDescription class="text-left"> Manage your saved items here. Please note that items are not stored online. </SheetDescription>
            </SheetHeader>

            <div class="flex h-[calc(100vh-210px)] flex-col gap-4 overflow-y-auto">
                <!-- BMO -->
                <div v-if="cart.items.BMO.length > 0" class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="isDeleteBMO" />
                        <h3 class="text-sm font-medium">{{ ALL_DEPARTMENTS['BMO'].fullName }}</h3>
                    </div>
                    <CartItem v-for="item in cart.items.BMO" v-bind:key="item.id" :item="item" />
                </div>

                <!-- ESLO -->
                <div v-if="cart.items.ESLO.length > 0" class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="isDeleteESLO" />
                        <h3 class="text-sm font-medium">{{ ALL_DEPARTMENTS['ESLO'].fullName }}</h3>
                    </div>
                    <CartItem v-for="item in cart.items.ESLO" v-bind:key="item.id" :item="item" />
                </div>

                <!-- ITRO -->
                <div v-if="cart.items.ITRO.length > 0" class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="isDeleteITRO" />
                        <h3 class="text-sm font-medium">{{ ALL_DEPARTMENTS['ITRO'].fullName }}</h3>
                    </div>
                    <CartItem v-for="item in cart.items.ITRO" v-bind:key="item.id" :item="item" />
                </div>
            </div>
            <div class="flex flex-row justify-between pt-4">
                <div class="flex items-center gap-2">
                    <Checkbox v-model="isAllSelected" />
                    <p class="text-sm leading-none">Select all</p>
                </div>
                <SheetClose as-child>
                    <Button class="text-xs" @click="router.visit('/borrow/checkout')">
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
                                d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59"
                            />
                        </svg>
                        Proceed to checkout
                    </Button>
                </SheetClose>
            </div>
        </SheetContent>
    </Sheet>
</template>
