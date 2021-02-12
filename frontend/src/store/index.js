import Vue from 'vue'
import Vuex from 'vuex'
import {api} from "@/api";

Vue.use(Vuex)

function initialFilters() {
    return {
        name: null,
        price: null,
        bathrooms: null,
        bedrooms: null,
        garages: null,
        storeys: null,
        page: null,
    };
}

export default new Vuex.Store({
    state: {
        loading: false,
        houses: {
            data: [],
            meta: {},
            available_filters: []
        },
        tableColumn: [
            'Name',
            'Price',
            'Bathrooms',
            'Bedrooms',
            'Garages',
            'Storeys',
        ],
        filters: initialFilters()
    },
    getters: {
        loading: state => state.loading,
        getAvailableFilters: state => state.houses.available_filters,
        getFilters: state => state.filters,
        getHouses: state => state.houses.data,
        getHousesMeta: state => state.houses.meta,
        getTableColumn: state => state.tableColumn,
    },
    mutations: {
        setLoading: (state, payload) => {
            state.loading = payload
        },
        setHouses: (state, houses) => {
            state.houses = houses;
            state.filters.price = [houses.available_filters.minPrice, houses.available_filters.maxPrice];
        },
        setFilters: (state, filters) => {
            state.filters = filters;
        },
        clearFilters: (state) => {
            const defaultState = initialFilters();
            Object.keys(defaultState).forEach(key => {
                state.filters[key] = defaultState[key];
            });
        },
        setPage: (state, page) => {
            state.filters.page = page;
        }
    },
    actions: {
        fetchHouses: (context, params) => {
            context.commit('setLoading', true)
            return api.house.ApiGetHouse(params).then(response => {
                context.commit("setHouses", response.data);
                context.commit('setLoading', false)
            })
        },
        addFilters: (context, filters) => {
            context.commit("setFilters", filters);
            context.dispatch("fetchHouses", filters);
        },
        clearFilters: (context) => {
            context.commit("clearFilters");
            context.dispatch("fetchHouses");
        },
        getPage: (context, page) => {
            context.commit('setPage', page)
            context.dispatch("fetchHouses", context.state.filters);
        }
    },
    modules: {}
})
