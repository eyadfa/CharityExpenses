<template>


    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid" v-if="isLoggedIn">
        <!--begin::Aside-->
        <Asidex />
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" style="" class="header align-items-stretch">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Aside mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                            id="kt_aside_mobile_toggle">
                            <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                            <span class="svg-icon svg-icon-2x mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                                        <path
                                            d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Aside mobile toggle-->
                    <!--begin::Mobile logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="./" class="d-lg-none">
                            <img alt="Logo" src="assets/media/logos/logo-3.svg" class="h-30px" />
                        </a>
                    </div>
                    <!--end::Mobile logo-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <!--begin::Navbar-->
                        <navBar />
                        <!--end::Navbar-->
                        <!--begin::Topbar-->
                        <top-bar />
                        <!--end::Topbar-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container">

                        <div id="app">

                            <div class="container">

                                <router-view />
                            </div>
                        </div>



                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
    <div v-else>
        <router-view />
    </div>

</template>

<script>
import { computed, onMounted } from 'vue';
import Asidex from "./partials/aside-menu";
import topBar from "./partials/header/top-bar";
import navBar from "./partials/header/nav-bar";
import { useStore } from 'vuex';


export default {
    name: "App",
    setup() {
        const store = useStore();

        onMounted(async () => {
            try {
                await store.dispatch('fetchDataFromServer');
            } catch (error) {
                // Handle error if necessary
            }
        });
    },
    data() {
        return {
            isLoggedIn: false,
        }
    },
    components: { Asidex, topBar, navBar },
    created() {
        //document.title = this.title;
        if (window.Laravel.isLoggedIn) {
            this.isLoggedIn = true;
            //console.log(window.Laravel.user);
        }
    },
    watch: {
        $route: {
            handler() {
                /*axios.get('/api/abilities').then(response => {
                    window.Laravel.abilities = response.data.data;
                })*/
            },
            immediate: true
        }
    },


}
</script>
<style>
.el-table td div.cell {
    word-break: break-word !important;
    padding: 0 2px;
}
.el-table th div.cell {
    word-break: break-word !important;
    padding: 0 2px;
}
.el-step__title {
    word-break: keep-all !important;
}
</style>
