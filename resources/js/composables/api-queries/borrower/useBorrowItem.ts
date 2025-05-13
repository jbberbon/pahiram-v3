import { BorrowItem, BorrowItemListFilters } from '@/types/borrow-item.types';
import { ListWithPagination } from '@/types/type-builder.types';
// import { useQuery } from '@tanstack/vue-query';
import { useQuery } from '@tanstack/vue-query';
import { AxiosError, AxiosResponse } from 'axios';
import { fetchBorrowItems } from './services/fetch-borrow-items';

export const useBorrowItems = (filters?: BorrowItemListFilters) => {
    const spreadFilters = filters ? [...Object.values(filters)] : '';
    const queryKey = ['borrow-items', spreadFilters];
    return useQuery<AxiosResponse<ListWithPagination<BorrowItem>>, AxiosError>({
        queryKey: queryKey,
        queryFn: () => fetchBorrowItems(filters),
    });
};
