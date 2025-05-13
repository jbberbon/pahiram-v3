export interface BorrowItem {
    name: string;
    apc_item_id: string;
    is_required_supervisor_approval: boolean;
    department: string
    images: string[];
}

export interface BorrowItemListFilters {
    department?: string;
    search?: string;
    per_page?: number;
    page?: number;
}