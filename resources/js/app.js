
import {createApp} from 'vue'

require('./bootstrap')
import App from './App.vue'
import axios from 'axios'
import router from './router'
 import VueSweetalert2 from "vue-sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';
import Permissions from "./mixins/Permissions";
import MenuItemx from "./partials/MenuItemx";
import codeSelect from "./components/_common/codeSelect";
import fileUpload from "./components/_common/FileUpload";

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import VueApexCharts from "vue3-apexcharts";


import { createStore } from 'vuex';
import shared from "./src/shared";
// Make sure to import createStore

// Create the Vuex store instance
const store = createStore({
    state: {
        serverData: null,
        userPermissions:null
    },
    mutations: {
        setServerData(state, data) {
            state.serverData = data;
        },
        setUserPermissions(state, data) {
            state.userPermissions = data;
        },
    },
    actions: {
        async fetchDataFromServer({ commit }) {
            try {
                let data = await shared.activeCodes();
                commit('setServerData', data);
            } catch (error) {
                console.error('Error fetching data:', error);
                throw error;
            }
        },
    },
});

const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.component('MenuItemx', MenuItemx);
app.component('codeSelect', codeSelect);
app.component('fileUpload', fileUpload);
app.use(router)
app.use(store)
app.use(VueSweetalert2)
app.use(ElementPlus)
app.use(VueApexCharts)
app.mixin(Permissions)
app.mount('#app')



