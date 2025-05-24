import { z } from 'zod';
import { BORROW_PURPOSE_KEYS } from '../constants/borrow-purposes';

// Base Item schema
export const ItemSchema = z.object({
    item_group_id: z.string(), // Validates as UUID
    quantity: z.number({ invalid_type_error: 'Quantity must be a number' }).min(1, 'Quantity must be at least 1'),
    // .max(3, {message: "Max qty is 3"}),
    start_date: z
        .string()
        .refine((date) => !isNaN(Date.parse(date)), {
            message: 'Invalid start date format',
        })
        .refine((date) => new Date(date) > new Date(), {
            message: 'Start date should not be in the past',
        }),
    return_date: z
        .string()
        .refine((date) => !isNaN(Date.parse(date)), {
            message: 'Invalid return date format',
        })
        .refine((date) => new Date(date) > new Date(), {
            message: 'Return date should not be in the past',
        }),
});

// Refined schema with validation for date logic
export const SuperRefineItemSchema = ItemSchema.superRefine((data, ctx) => {
    const startDate = new Date(data.start_date);
    const returnDate = new Date(data.return_date);

    if (returnDate <= startDate) {
        ctx.addIssue({
            code: z.ZodIssueCode.custom,
            path: ['return_date'],
            message: 'Return date must be after the start date',
        });
    }
});

const PurposeSchema = z
    .union([z.enum(BORROW_PURPOSE_KEYS as [string, ...string[]]), z.literal('')])
    .refine((purpose) => purpose !== '', { message: 'Please select a purpose' });

// Define the main schema
export const BorrowRequestSchema = z.object({
    endorsed_by: z.string().email().optional(), // `endorsed_by` is not required
    purpose: PurposeSchema, // Validates against a list of purposes
    user_defined_purpose: z.string().min(5, 'Purpose must be atleast 5 characters.').max(50, 'Purpose must be atmost 50 characters.'), // Validates as a non-empty string
    items: z.array(SuperRefineItemSchema).min(1, 'At least one item is required'), // Validates as an array with at least one item
});

// Infer the types
export type TBorrowRequestFormValues = z.infer<typeof BorrowRequestSchema>;
