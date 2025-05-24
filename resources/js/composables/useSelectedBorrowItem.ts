import { BorrowItem, BorrowItemReservation } from '@/types/borrow-item.types';
import { useLocalStorage } from '@vueuse/core';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useSelectedBorrowItem = defineStore('selected-borrow-items', () => {
    const item = useLocalStorage<BorrowItemReservation | null>('selected-borrow-items', null, {
        serializer: {
            read: (value) => {
                try {
                    return JSON.parse(value);
                } catch {
                    return null;
                }
            },
            write: (value) => JSON.stringify(value),
        },
    });
    const isCalendarDialogOpen = ref(false);

    const setItem = (newItem: BorrowItemReservation | BorrowItem | null) => {
        if (!newItem) {
            item.value = null;
            return;
        }

        if ('start_date' in newItem) {
            item.value = newItem as BorrowItemReservation;
        } else {
            item.value = { ...newItem, start_date: '', end_date: '' };
        }
    };

    const updateReservedCount = (count: number) => {
        if (count > -1) {
            // Make a copy of current item
            const newItem = item.value;

            // Update reserved count in object
            if (newItem === null) return;
            newItem['reserved_count'] = count;

            // Set item with updated count
            setItem(newItem);
        }
    };

    const updateDates = (start: string, end: string) => {
        // Make a copy of current item
        const newItem = item.value;

        // Update the dates in the object
        if (newItem === null) return;
        if (start) newItem['start_date'] = start;
        if (end) newItem['end_date'] = end;

        // Set item with updated dates
        setItem(newItem);
    };

    const handleOpenCalendar = () => (isCalendarDialogOpen.value = true);
    const handleCloseCalendar = () => (isCalendarDialogOpen.value = false);

    return {
        item,
        isCalendarDialogOpen,
        setItem,
        updateReservedCount,
        handleOpenCalendar,
        handleCloseCalendar,
        updateDates,
    };
});
