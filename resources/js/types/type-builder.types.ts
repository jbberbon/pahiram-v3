import { Pagination } from "./pagination.types";

export interface ListWithPagination<T> {
    items: T[];
    pagination: Pagination;
}