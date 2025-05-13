import backendApiClient from '@/config/backend-api-client';
import { getBorrowItems } from '@/lib/endpoints/borrow-item.endpoints';
import { BorrowItem, BorrowItemListFilters } from '@/types/borrow-item.types';
import { ListWithPagination } from '@/types/type-builder.types';
import { AxiosResponse } from 'axios';

export const fetchBorrowItems = async (filters?: BorrowItemListFilters): Promise<AxiosResponse<ListWithPagination<BorrowItem>>> => {
    let queryString = '';
    // Check if filters are provided and build the query string
    if (filters) {
        const params = new URLSearchParams();
        if (filters.department) {
            params.append('department', filters.department);
        }
        if (filters.search) {
            params.append('search', filters.search);
        }
        if (filters.page) {
            params.append('page', filters.page.toString());
        }
        if (filters.per_page) {
            params.append('per_page', filters.per_page.toString());
        }
        queryString = params.toString ? `?${params.toString()}` : '';
    }

    // Build the final endpoint with / without query parameters
    const finalEndpoint = getBorrowItems + queryString;
    return await backendApiClient.get<ListWithPagination<BorrowItem>>(finalEndpoint);
};
