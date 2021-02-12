import axios from 'axios'


// create axios instance
const api = axios.create({
    baseURL: process.env.VUE_APP_API_URL,
    headers: {
        'Accept': `application/json, text/plain, */*`,
        'Content-type': `application/json;charset=utf-8`
    },
    withCredentials: true
})

api.interceptors.response.use(
    response => {
        return response;
    },
    error => {

        // if (error.response && error.response.status !== undefined) {
        //     if (error.response.status === 401) {
        //         alert.error(error);
        //         if (router.history.current.path !== '/login') {
        //             store.dispatch(AUTH_LOGOUT)
        //             router.push({name: 'Login'});
        //         }
        //     }
        //
        //     if (error.response.status === 422) {
        //         store.dispatch(SET_ERRORS, error.response.data.errors)
        //     }
        // }

        return Promise.reject(error);
    }
);

export default api

