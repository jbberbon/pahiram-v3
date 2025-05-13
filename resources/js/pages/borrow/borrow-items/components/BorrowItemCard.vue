<script lang="ts" setup>
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import { BorrowItem } from '@/types/borrow-item.types';

import { defineProps } from 'vue';

// define the props
const props = defineProps<BorrowItem>();
</script>

<template>
    <Card>
        <CardHeader>
            <div>{{ props.name }}</div>
        </CardHeader>
        <CardContent>
            <div>{{ props.department +  props.apc_item_id }}</div>
        </CardContent>
    </Card>
</template>
