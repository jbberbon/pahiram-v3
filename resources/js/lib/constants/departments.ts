export const BMO = 'BMO';
export const ITRO = 'ITRO';
export const ESLO = 'ESLO';
export const FAO = 'FAO';
export const PLO = 'PLO';

export const ALL_DEPARTMENTS = {
    [BMO]: {
        name: 'BMO',
        fullName: 'Building Management Office',
    },
    [ITRO]: {
        name: 'ITRO',
        fullName: 'Information and Technology Resource Office',
    },
    [ESLO]: {
        name: 'ESLO',
        fullName: 'Engineering, Science and Laboratory Office',
    },
    [FAO]: {
        name: 'FAO',
        fullName: 'Finance and Accounting Office',
    },
    [PLO]: {
        name: 'PLO',
        fullName: 'Purchasing and Logistics Office',
    },
};

export const DEPARTMENT_COLORS: Record<string, string> = {
    [BMO]: 'bg-sky-500',
    [ITRO]: 'bg-teal-500',
    [ESLO]: 'bg-pink-400',
    [FAO]: 'bg-fuschia-500',
    [PLO]: 'bg-indigo-500',
};
