import { useDateFormat } from '@vueuse/core';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export const convertIsoToHumanFormat = (isoString?: string) => {
    if (!isoString) return;
    try {
        return useDateFormat(new Date(isoString), 'MMMM D, YYYY hh:mma');
    } catch {
        return;
    }
};

export const convertIsoToHumanFormatShort = (isoString?: string) => {
    if (!isoString) return;
    try {
        return useDateFormat(new Date(isoString), 'D MMM hh:mma');
    } catch {
        return;
    }
};

