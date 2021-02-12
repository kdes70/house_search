import request from "@/plugins/request";

export function ApiGetHouse(params) {

    if (params !== undefined) {
        params = Object.fromEntries(Object.entries(params).filter(([_, v]) => v != null && v !== ""));
    }

    return request.get('houses', {params: params});
}

export const house = {
    ApiGetHouse
};