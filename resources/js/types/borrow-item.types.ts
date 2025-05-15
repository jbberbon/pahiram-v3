export interface BorrowItem {
    id: string;
    name: string;
    is_required_supervisor_approval: boolean;
    department: "BMO" | "ITRO" | "ESLO";
    images: string[];
    count: number;
    description: string;
}

export interface BorrowItemListFilters {
    department?: string;
    search?: string;
    per_page?: number;
    page?: number;
}