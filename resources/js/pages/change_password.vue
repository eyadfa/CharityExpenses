<template>

    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">

                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <form class="form" method="post"  >

                        <div class="mb-5">

                            <div class="col-md-6 fv-row">
                                <label class="required fs-5 fw-bold mb-2">كلمة المرور الحالية</label>
                                <input type="password" v-model="form.old_password" class="form-control form-control-solid" />
                                <span class="text-danger fw-light" v-for="error of v$.form.old_password.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                            </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">كلمة المرور الجديدة</label>
                                    <input type="password" v-model="form.password" class="form-control form-control-solid" />
                                    <span class="text-danger fw-light" v-for="error of v$.form.password.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>

                                <div class="col-md-6 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">كلمة المرور مرة أخرى </label>
                                    <input type="password" v-model="form.password_confirmation" class="form-control form-control-solid" />
                                    <span class="text-danger fw-light" v-for="error of v$.form.password_confirmation.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>

                        </div>

                        <div class="d-flex flex-center">
                        <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                            <span class="indicator-label" :class="{'visually-hidden':loading}">تغيير كلمة المرور</span>
                            <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
                            <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
                        </button>
                        <button @click.prevent="$router.back()" class="btn btn-light me-3">تراجع</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</template>



<script>

import { useVuelidate } from '@vuelidate/core'
import { required, minLength , sameAs , numeric } from '@vuelidate/validators'
    export default {
        name: "changePassword",
        data(){
            return {
                title: "تغيير كلمة المرور",
                loading:false,
                base_route : "users",
                api_update:"/api/change_password/",
                form:{"old_password":"","password":"","password_confirmation":""},

            }
        },
        setup() {
            return {v$: useVuelidate()}
        },
        validationConfig: {
            $dirty: true,
        },

        validations() {
            return {
                form: {
                    old_password: {required },
                    password: {required , min:minLength(8)},
                    password_confirmation: {required , same:sameAs(this.form.password)},
                }
            }
        },

        methods: {
            async submit() {
                const result = await this.v$.$validate()
                if (!result) {
                    return;
                }
                 this.update();
            },

            update() {
                this.loading = true;
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post(this.api_update, this.form)
                        .then(response => {
                            this.$swal(response.data.message);
                            this.$router.back()
                        })
                        .catch(function (error) {
                            console.log(error.response.data.error);
                           new Swal(
                               error.response.data.error,
                               error.response.data.error,
                                'error'
                            );
                        }).finally(() => {
                        this.loading = false
                    });
                })
            },

        },
    }
</script>

