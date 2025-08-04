<template>


    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
            style="background-color: #F2C98A">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                <!--begin::Content-->
                <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="../../demo1/dist/index.html" class="py-9">
                        <img alt="Logo" src="assets/media/logos/logo-3.svg" class="h-70px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">مرحبا بكم</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="fw-bold fs-2" style="color: #986923;">قم بتسجيل الدخول
                        <br />لادارة ومتابعة المهام الخاصة بك
                    </p>
                    <!--end::Description-->
                </div>
                <!--end::Content-->
                <!--begin::Illustration-->
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                    style="background-image: url(assets/media/illustrations/checkout.png)"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" method="POST">
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">تسجيل الدخول</h1>
                            <!--end::Title-->
                            <span class="text-danger fw-light" v-if="error" >
                                <p>{{ error }}</p>
                            </span>
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">اسم المستخدم</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid " name="email" required
                                autocomplete="email" autofocus type="text" v-model="email" />
                            <!--end::Input-->

                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">كلمة االمرور</label>
                                <!--end::Label-->

                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid " name="password" required
                                autocomplete="current-password" type="password" v-model="password" />
                            <!--end::Input-->


                        </div>
                        <!--end::Input group-->
                        <div class="form-group row pb-2">
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        تذكرني
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" @click="handleSubmit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">تسجيل الدخول</span>
                                <span class="indicator-progress">الرجاء الانتظار...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->

                        </div>
                        <!--end::Actions-->


                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Body-->
    </div>


</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            error: null
        }
    },
    mounted() {
        document.body.classList.add('bg-body');
        document.body.classList.remove('header-fixed');
        document.body.classList.remove('header-tablet-and-mobile-fixed');
        document.body.classList.remove('aside-enabled');
        document.body.classList.remove('aside-fixed');
    },
    destroyed() {
        document.body.classList.remove('bg-body');
        document.body.classList.add('header-fixed');
        document.body.classList.add('header-tablet-and-mobile-fixed');
        document.body.classList.add('aside-enabled');
        document.body.classList.add('aside-fixed');
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            if (this.password.length > 0) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('api/login', {
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            console.log(response.data)
                            if (response.data.success) {
                                window.Laravel.isLoggedIn = true;
                                window.Laravel.user = response.data.user;
                                this.$router.go('/dashboard');

                            } else {
                                this.error = response.data.message

                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedIn) {
            return next('dashboard');
        }
        next();
    }
}
</script>
