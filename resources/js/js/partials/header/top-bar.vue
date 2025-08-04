<template>
    <div class="d-flex align-items-stretch flex-shrink-0">
        <!--begin::Toolbar wrapper-->
        <div class="d-flex align-items-stretch flex-shrink-0">
            <!--begin::Search-->

            <!--end::Search-->
            <!--begin::Activities-->

            <!--end::Activities-->
            <!--begin::Quick links-->

            <!--end::Quick links-->
            <!--begin::Chat-->

            <!--end::Chat-->
            <!--begin::Notifications-->
            <div class="d-flex align-items-center ms-1 ms-lg-3">
                <!--begin::Menu- wrapper-->
                <div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                    <!--begin::Svg Icon | path: icons/duotone/Code/Compiling.svg-->
                    <span class="svg-icon svg-icon-1 fas fa-bell  text-warning"></span>
                    <!--end::Svg Icon-->
                    <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" style="">
                    <!--begin::Heading-->
                    <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('assets/media/misc/pattern-1.jpg')">
                        <!--begin::Title-->
                        <h3 class="text-white fw-bold px-9 mt-10 mb-6">الاشعارات
                            <span class="fs-8 opacity-75 ps-3">24 اشعار</span></h3>
                        <!--end::Title-->
                        <!--begin::Tabs-->
                        <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
                            <li class="nav-item">
                                <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_3">الاشعارات</a>
                            </li>
                        </ul>
                        <!--end::Tabs-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Tab content-->
                    <div class="tab-content">

                        <!--begin::Tab panel-->
                        <div class="tab-pane fade  show active" id="kt_topbar_notifications_3" role="tabpanel">
                            <!--begin::Items-->
                            <div class="scroll-y mh-325px my-5 px-8">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack py-4" v-for="c in notifications">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <!--span class="w-70px badge badge-light-success me-4">200 OK</span-->
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a :href="c.related_url" class="text-gray-800 text-hover-primary fw-bold">{{c.title}}</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">{{ c.diff}}</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->

                            </div>
                            <!--end::Items-->
                            <!--begin::View more-->
                            <div class="py-3 text-center border-top">
                                <router-link class="btn btn-color-gray-600 btn-active-color-primary"
                                             :to="this.$router.resolve({name: 'notifications'})" >
                                    <span class="menu-title" >عرض الكل</span>
                                </router-link>
                            </div>
                            <!--end::View more-->
                        </div>
                        <!--end::Tab panel-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::Notifications-->
            <!--begin::User-->
            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                    <img src="/assets/media/avatars/150-26.jpg" alt="metronic" />
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="/assets/media/avatars/150-26.jpg" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex align-items-center fs-5">{{name}}
                                    <!--span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span-->
                                </div>
                                <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{department}}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5 ">
                        <div class="row">
                            <router-link class="menu-link" :to="this.$router.resolve({name: 'changePassword'})" >
                                <span class="menu-title" >تغيير كلمة المرور</span>
                            </router-link>

                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--begin::Menu item-->
                    <div class="menu-item px-5 ">
                        <div class="row">
                            <a class="menu-link px-5  " style="cursor: pointer;" @click="logout">تسجيل الخروج</a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::User -->
            <!--begin::Heaeder menu toggle-->
            <!--end::Heaeder menu toggle-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>

</template>

<script>
import shared from "../../src/shared";

export default {
    name: "top-bar",
    data() {
        return {
            name: null,
            department:null,
            notifications:[],
            total:0
        }
    },
    async created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name;
            this.department= window.Laravel.user.department.name_ar;
            let res  = await shared.search("/api/notifications" , {user_id:window.Laravel.user.id , status:0},1);
            this.notifications = res.data;
            this.total = res.total;
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.localStorage.removeItem('isLoggedIn');
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        window.localStorage.removeItem('isLoggedIn');
                        window.location.href = "/login"
                        console.error(error);
                    });
            })
        }
    },
}
</script>

]
