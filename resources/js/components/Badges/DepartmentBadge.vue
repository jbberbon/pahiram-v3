<script lang="ts" setup>
import { Badge } from '@/components/ui/badge';
import { DEPARTMENT_COLORS } from '@/lib/constants/departments';

import { defineProps } from 'vue';
const props = defineProps({
    department: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Badge class="cursor-pointer text-white" :class="DEPARTMENT_COLORS[props.department] ?? ''" variant="outline">
        <span>{{ props.department ?? "" }}</span>
    </Badge>
</template>
