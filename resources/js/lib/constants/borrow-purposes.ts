// Define the type for the PURPOSE_CONSTANTS object
type Purpose = {
    key: string;
    name: string;
    description: string;
};
type PurposeConstants = {
    [key: string]: Purpose;
};

export const BORROW_PURPOSES: PurposeConstants = {
    ACADEMIC_REQUIREMENT: {
        key: 'ACADEMIC_REQUIREMENT',
        name: 'Academic requirement',
        description: 'For general academic projects, assignments, or coursework',
    },
    ORG_ACTIVITY: {
        key: 'ORG_ACTIVITY',
        name: 'Organization activity',
        description: 'For org or club-related events and activities',
    },
    UPSKILLING: {
        key: 'UPSKILLING',
        name: 'Upskilling',
        description: 'For skill development',
    },
    HOBBY: {
        key: 'HOBBY',
        name: 'Hobby',
        description: 'For hobbies or leisure activities',
    },
    SPECIAL_EVENT: {
        key: 'SPECIAL_EVENT',
        name: 'Special event',
        description: 'For special events or occasions',
    },
    OTHERS: {
        key: 'OTHERS',
        name: 'Others',
        description: 'Borrower will indicate his specific purpose',
    },
} as const;

// Extract keys as a tuple of string literals
export const BORROW_PURPOSE_KEYS = Object.keys(BORROW_PURPOSES) as Array<keyof typeof BORROW_PURPOSES>;

export const PURPOSE_OPTIONS_CONSTANTS = Object.entries(BORROW_PURPOSES).map(([key, { name }]) => ({
    value: key,
    label: name,
}));
