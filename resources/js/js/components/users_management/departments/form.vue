<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5">  {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <form class="form" method="post" id="kt_modal_departments_form">
                        <div class="row mb-5">
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الاسم</label>
                                <input type="text" class="form-control form-control-solid"  v-model="form.name_ar" />
                                <span class="text-danger fw-light" v-for="error of v$.form.name_ar.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الاسم English</label>
                                <input type="text" class="form-control form-control-solid"  v-model="form.name_en" />
                                <span class="text-danger fw-light" v-for="error of v$.form.name_en.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الوصف</label>
                                <input type="text" class="form-control form-control-solid"  v-model="form.description" />
                                <span class="text-danger fw-light" v-for="error of v$.form.description.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label class="required fs-5 fw-bold mb-2">العنوان</label>
                                <input type="text" class="form-control form-control-solid"  v-model="form.address" />
                                <span class="text-danger fw-light" v-for="error of v$.form.address.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>


                            <div class="col-md-6">
                                <country-city v-model:country="form.country_id" v-model:city="form.city_id"  />
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="text-danger fw-light" v-for="error of v$.form.country_id.$errors" :key="error.$uid">
                                            <p>{{ msg(error) }}</p>
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-danger fw-light" v-for="error of v$.form.city_id.$errors" :key="error.$uid">
                                            <p>{{ msg(error) }}</p>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">  رئيس القسم</label>
                                <select v-model="form.manager_id" class="form-select form-select-solid">
                                    <option value="-1">اختر قيمة....</option>
                                    <option v-for="f of managers" :value="f.id">{{ f.full_name}}</option>

                                </select>
                            </div>


                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الهاتف</label>
                                <input type="text" class="form-control form-control-solid"  v-model="form.phone" />
                                <span class="text-danger fw-light" v-for="error of v$.form.phone.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>


                            <div class="col-md-2 fv-row">
                                <label class="required fs-5 fw-bold mb-2"> الحالة</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <span class="form-check-label fw-bold text-muted">غير فعال</span>
                                        <input class="form-check-input" v-model="form.is_active" name="status" type="checkbox" value="1"  />
                                        <span class="form-check-label fw-bold text-muted">فعال</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-center">
                            <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                                <span class="indicator-label" :class="{'visually-hidden':loading}">حفظ</span>
                                <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
                                <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
                            </button>
                            <button @click.prevent="$router.back()" class="btn btn-light me-3">تراجع</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->





</template>



<script>
import { useVuelidate } from '@vuelidate/core'
import { required, minLength , numeric  } from '@vuelidate/validators'
import CountryCity from "../../_common/countryCity";
import shared from "../../../src/shared";
import api from "../../../src/api";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
    export default {
        name: "departmentsForm",
        components: {ValidationServerErrors, CountryCity},
        setup() {
            return {v$: useVuelidate()}
        },
        validationConfig: {
            $dirty: true,
        },
        data() {
            return {
                title: " الأقسام",
                form: {"id": 0, "is_active":true},
                loading:false,
                managers:[],
                edit_route:"editDepartment",
                base_route : "departments",
                api_url: "/api/departments",
                errors:[],
            }
        },
        validations() {
            return {
                form: {
                    name_ar: {required},
                    name_en: {required},
                    address: {required},
                    phone: {required , numeric , min:minLength(6)},
                    country_id: {required},
                    city_id: {required},
                    description: {required},

                }
            }
        },
        async created() {
            api.vw=this;
            //this.managers = ( await shared.get('/api/users/managers')).data
            this.managers = await shared.employees();
            if (this.$router.currentRoute.value.name === this.edit_route) {
                this.form = await shared.show(this.api_url, this.$route.params.id)
            }
        },
        methods: {
            async submit() {
                this.v$.form.$touch();
                if (this.v$.form.$invalid) {
                    shared.alert("يوجد بيانات مفقودة");
                    return;
                }
                if (this.$router.currentRoute.value.name === this.edit_route) {
                    await api.update();
                } else {
                    await api.store();
                }

            },

        },

    }

</script>


