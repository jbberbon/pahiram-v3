<script lang="ts" setup>
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { BORROW_PURPOSES } from '@/lib/constants/borrow-purposes';
import { BorrowRequestSchema } from '@/lib/schema/submit-borrow-request-form';
import { toTypedSchema } from '@vee-validate/zod';
import { Field, Form } from 'vee-validate';
import { z } from 'zod';

const props = defineProps<{
    class?: string;
}>();

type BorrowRequestType = z.infer<typeof BorrowRequestSchema>;
const onSubmit = (values: any) => {
    console.log('Form submitted with values:', values);
    // This will be fully typed and safe
    const validatedValues = BorrowRequestSchema.parse(values) as BorrowRequestType;
    console.log('Form submitted with values:', validatedValues);

    // Now you have full TypeScript support
    console.log(validatedValues.endorser);
    console.log(validatedValues.purpose);
};
</script>

<template>
    <Form
        @submit="onSubmit"
        :validation-schema="toTypedSchema(BorrowRequestSchema)"
        :initial-values="{
            endorser: '',
            purpose: '',
            specific_purpose: '',
            items: [],
        }"
        id="borrow-form"
        class="flex w-full flex-col gap-3 sm:border sm:dark:border-neutral-900"
        :class="props.class"
    >
        <h3 class="flex h-[40px] items-center font-semibold">Request details</h3>
        <!-- Endorser -->
        <!-- TODO!!!!: USE SHADCN COMBOBOX -->
        <div class="flex flex-col gap-2">
            <label for="endorser" class="text-sm font-medium">Endorser</label>
            <Field name="endorser" v-slot="{ field, errorMessage }">
                <Input v-bind="field" id="endorser" />
                <span class="text-sm leading-none text-red-500">{{ errorMessage }}</span>
            </Field>
        </div>

        <!-- General Purpose Dropdown -->
        <div class="flex flex-col gap-2">
            <label for="purpose" class="text-sm font-medium">Purpose</label>
            <Field name="purpose" v-slot="{ value, handleChange, errorMessage }">
                <Select :modelValue="value" @update:modelValue="handleChange" class="focus:border-blue-500 focus:ring-2">
                    <SelectTrigger>
                        <SelectValue placeholder="Select purpose" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem v-for="[key, purpose] in Object.entries(BORROW_PURPOSES)" :key="key" :value="purpose.key">
                            {{ purpose.name }}
                        </SelectItem>
                    </SelectContent>
                </Select>
                <span class="text-sm leading-none text-red-500">{{ errorMessage }}</span>
            </Field>
        </div>

        <!-- Specified Purpose -->
        <div class="flex flex-col gap-2">
            <label for="specific_purpose" class="text-sm font-medium">Specific purpose</label>
            <Field name="specific_purpose" v-slot="{ field, errorMessage }">
                <Textarea v-bind="field" id="specific_purpose" placeholder="Type your purpose here." />
                <span class="text-sm leading-none text-red-500">{{ errorMessage }}</span>
            </Field>
        </div>
    </Form>
</template>
