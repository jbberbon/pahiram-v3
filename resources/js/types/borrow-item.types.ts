export type Department = 'BMO' | 'ITRO' | 'ESLO';

export interface BorrowItem {
    id: string;
    name: string;
    is_required_supervisor_approval: boolean;
    department: Department;
    images: string[];
    available_count: number;
    description: string;
}

export interface BorrowItemReservation extends BorrowItem {
    start_date?: string; // ISO string
    end_date?: string; // ISO string
    reserved_count?: number;
}

export type GroupedBorrowItemPerOffice = Record<Department, BorrowItemReservation[]>

export interface BorrowItemListFilters {
    department?: string;
    search?: string;
    per_page?: number;
    page?: number;
}
