<script setup lang="ts">
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { PropType } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: 'Are you absolutely sure?',
    },
    description: {
        type: String,
        default: 'This action cannot be undone.',
    },
    cancelText: {
        type: String,
        default: 'Cancel',
    },
    confirmText: {
        type: String,
        default: 'Confirm',
    },
    onConfirm: {
        type: Function as PropType<() => void>,
        default: () => {},
    },
});
</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger as-child>
            <slot />
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>{{ props.title }}</AlertDialogTitle>
                <AlertDialogDescription>
                    {{ props.description }}
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>{{ props.cancelText }}</AlertDialogCancel>
                <AlertDialogAction @click="props.onConfirm">
                    {{ props.confirmText }}
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
