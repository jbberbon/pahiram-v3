import { ALL_DEPARTMENTS } from '@/lib/constants/departments';
import { BorrowItemReservation, Department, GroupedBorrowItemPerOffice } from '@/types/borrow-item.types';
import { useLocalStorage } from '@vueuse/core';
import { defineStore } from 'pinia';
import { computed } from 'vue';

export const useCart = defineStore('items-cart', () => {
    const isCartOpen = useLocalStorage<boolean>('is-cart-open', false);
    const toggleCart = () => {
        isCartOpen.value = !isCartOpen.value;
    };

    const items = useLocalStorage<GroupedBorrowItemPerOffice>('cart-items', {
        BMO: [],
        ITRO: [],
        ESLO: [],
    });

    const isEmpty = computed(() => {
        return Object.values(items.value).every((departmentItems) => departmentItems.length === 0);
    });

    const setItems = (newItems: GroupedBorrowItemPerOffice) => {
        items.value = newItems;
    };

    const insertOfficeItem = (newItem: BorrowItemReservation | null) => {
        if (!newItem) return;

        // Validate department
        const department = newItem.department as Department;
        if (!(department in ALL_DEPARTMENTS)) {
            return console.warn(`Invalid department: ${department}.`);
        }

        // Check for start and end dates and reserved count
        if (!newItem.start_date || !newItem.end_date || !newItem?.reserved_count) return;

        // Make a copy of current items
        const currentItems = { ...items.value };

        // Get the current index of the item if already exists
        const index = currentItems[department].findIndex((item) => item.id === newItem.id);

        if (index !== -1) {
            // Replace existing item in-place
            currentItems[department][index] = newItem;
        } else {
            // Add to end if it doesn't exist
            currentItems[department].push(newItem);
        }

        // Save changes to Local Storage
        setItems(currentItems);
    };

    const incrementItemCount = (department: Department, id: string) => {
        if (!id || !department) return;

        // Validate department
        if (!(department in ALL_DEPARTMENTS)) {
            return console.warn(`Invalid department: ${department}.`);
        }

        // Make a copy of current items
        const currentItems = { ...items.value };

        // Find the item by id and increment its reserved count
        const item = currentItems[department].find((item) => item.id === id);
        if (!item) {
            return console.warn(`Item with id ${id} not found in department ${department}.`);
        }

        // Increment
        item.reserved_count = (item.reserved_count ?? 0) + 1;

        // Save changes to Local Storage (this will also trigger reactivity)
        setItems(currentItems);
    };

    const decrementItemCount = (department: Department, id: string) => {
        if (!id || !department) return;

        // Validate department
        if (!(department in ALL_DEPARTMENTS)) {
            return console.warn(`Invalid department: ${department}.`);
        }

        // Make a copy of current items
        const currentItems = { ...items.value };

        // Find the item by id and increment its reserved count
        const item = currentItems[department].find((item) => item.id === id);
        if (!item) {
            return console.warn(`Item with id ${id} not found in department ${department}.`);
        }

        // Remove item if reserved count is null / undefined
        if (!item.reserved_count) {
            return removeItem(department, id);
        }

        // Remove item if reserved count is 1
        if (item.reserved_count && item.reserved_count <= 1) {
            return removeItem(department, id);
        }

        // Decrement
        item.reserved_count = item.reserved_count - 1;

        // Save changes to Local Storage (this will also trigger reactivity)
        setItems(currentItems);
    };

    const clearOfficeItems = (department: Department) => {
        if (!department) return;

        // Validate department
        if (!(department in ALL_DEPARTMENTS)) {
            return console.warn(`Invalid department: ${department}.`);
        }

        // Make a copy of current items
        const currentItems = { ...items.value };

        // Clear the items for the specified department
        currentItems[department] = [];

        // Save changes to Local Storage
        setItems(currentItems);
    };

    const removeItem = (department: Department, id: string) => {
        if (!id || !department) return;

        // Validate department
        if (!(department in ALL_DEPARTMENTS)) {
            return console.warn(`Invalid department: ${department}.`);
        }

        // Make a copy of current items
        const currentItems = { ...items.value };

        // Filter out the item by id and re-assign the filtered array back
        currentItems[department] = currentItems[department].filter((item) => item.id !== id);

        // Save to Local Storage
        setItems(currentItems);
    };

    return {
        items,
        isCartOpen,
        isEmpty,
        toggleCart,
        insertOfficeItem,
        removeItem,
        clearOfficeItems,
        incrementItemCount,
        decrementItemCount,
    };
});
