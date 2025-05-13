import { Pagination } from "./pagination.types";

export interface ListWithPagination<T> {
    data: T[];
    pagination: Pagination;
}