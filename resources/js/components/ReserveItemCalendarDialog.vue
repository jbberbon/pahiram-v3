<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { useSelectedBorrowItem } from '@/composables/useSelectedBorrowItem';
import { CalendarOptions, DateSelectArg } from '@fullcalendar/core/index.js';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import FullCalendar from '@fullcalendar/vue3';
import { computed } from 'vue';
import DepartmentBadge from './Badges/DepartmentBadge.vue';
import { Badge } from './ui/badge';

const selectedItem = useSelectedBorrowItem();
const availableCountBadgeColor = computed(() => {
    const count = selectedItem?.item?.available_count;
    return count && count >= 3
        ? 'bg-emerald-400 hover:bg-emerald-500'
        : count && count <= 1
          ? 'bg-pink-300 hover:bg-pink-400'
          : 'bg-orange-300 hover:bg-orange-400';
});

const now = new Date();
const threeMonthsFromNow = new Date();
threeMonthsFromNow.setMonth(now.getMonth() + 3);

const handleDateSelect = (info: DateSelectArg) => {
    selectedItem.updateDates(info.startStr, info.endStr);
};

const calendarOptions = computed<CalendarOptions>(() => ({
    allDaySlot: false,
    plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
    initialView: 'timeGridWeek',
    views: {
        timeGridWeek: {
            type: 'timeGrid',
            duration: { weeks: 1 },
        },
        timeGridDay: {
            type: 'timeGrid',
            duration: { days: 5 },
        },
        dayGridMonth: {
            type: 'dayGrid',
            duration: { months: 1 },
        },
    },

    dragScroll: true,
    eventOverlap: true, // Allow overlap of events
    selectOverlap: true, // Allow new date selection overlapping existing events
    editable: false, // Enable editability for new events only
    handleWindowResize: true,
    nowIndicator: true,
    headerToolbar: {
        start: 'prev,next',
        center: 'title',
        end: 'timeGrid,timeGridWeek',
    },
    buttonText: {
        // Rename buttons
        timeGridWeek: 'Week',
        timeGrid: 'Day',
    },

    hiddenDays: [0], // Hide Sunday
    selectable: true, // Allow date selection
    slotMinTime: '07:30:00', // Minimum time displayed
    slotMaxTime: '17:30:00', // Max time displayed
    validRange: {
        // Limit range from Now -> 3 Months into the future
        start: now,
        end: threeMonthsFromNow,
    },
    select: handleDateSelect,
    events: [{ title: 'Chosen dates', start: selectedItem.item?.start_date, end: selectedItem.item?.end_date, color: '#e7b426' }],
}));
</script>

<template>
    <Dialog v-model:open="selectedItem.isCalendarDialogOpen">
        <DialogContent class="max-h-full min-w-[50%] overflow-y-scroll">
            <DialogHeader class="flex flex-col gap-2">
                <DialogTitle class="text-left">{{ selectedItem.item?.name }}</DialogTitle>
                <DialogDescription class="flex gap-2">
                    <Badge :class="availableCountBadgeColor">{{ selectedItem.item?.available_count }} available</Badge>
                    <DepartmentBadge :department="selectedItem.item?.department ?? ''" />
                </DialogDescription>
            </DialogHeader>

            <FullCalendar :options="calendarOptions" />

            <DialogFooter>
                <Button class="bg-yellow-500 hover:bg-yellow-600" @click="selectedItem.handleCloseCalendar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z"
                        />
                    </svg>
                    Save dates
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<style>
.fc-toolbar-title {
    font-size: 1rem !important;
    font-weight: 600;
}
å .fc-icon {
    width: 15px !important;
    height: 15px !important;
    font-size: 15px !important;
}
</style>
