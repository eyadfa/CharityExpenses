<template>

    <div class="row gy-5 g-xl-8" v-loading="loading">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <form class="form" method="post">
                        <div class="row mb-5">
                            <div class="col-md-4 fv-row">
                                <label class="required fs-5 fw-bold mb-2">اسم الجهة المرتبطة</label>
                                <input v-model="form.name" class="form-control form-control-solid" type="text"/>
                                <span v-for="error of v$.form.name.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-4 fv-row">
                                <code-select v-model:sub_cd="form.activity_cd" :main_cd="4" title="نوع النشاط "/>
                                <span v-for="error of v$.form.activity_cd.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-4 fv-row">
                                <label class="required fs-5 fw-bold mb-2">رقم جوال للتواصل</label>
                                <input v-model="form.mobile" class="form-control form-control-solid" type="text"/>
                                <span v-for="error of v$.form.mobile.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-4 fv-row">
                                <label class="required fs-5 fw-bold mb-2">اسم المدير</label>
                                <input v-model="form.manager_name" class="form-control form-control-solid" type="text"/>
                                <span v-for="error of v$.form.manager_name.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-4 fv-row">
                                <code-select v-model:sub_cd="form.status_cd" :main_cd="6" title="الحالة"/>
                                <span v-for="error of v$.form.status_cd.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-4 fv-row">
                                <label class="fs-5 fw-bold mb-2">ملاحظات</label>
                                <textarea v-model="form.notes" class="form-control form-control-solid" />
                            </div>
                        </div>
                        <div class="d-flex flex-center">
                            <button class="btn btn-primary" type="submit" @click.prevent="submit">
                                <span class="indicator-label">حفظ</span>
                                <span class="indicator-progress">جاري الحفظ...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button class="btn btn-light me-3" @click.prevent="$router.back()">تراجع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</template>


<script>

import {useVuelidate} from '@vuelidate/core'
import {maxLength, minLength, required} from '@vuelidate/validators'
import shared from "../../../src/shared";
import api from "../../../src/api";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
import CodesForm from "../codes/form";
import CodeSelect from "../../_common/codeSelect";

export default {
    name: "partiesForm",
    components: {CodeSelect, ValidationServerErrors},
    setup() {
        return {v$: useVuelidate()}
    },

    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            title: "جهة مرتبطة جديدة",
            form: {status_cd: 1,activity_cd:1 },
            api_url:"/api/parties",
            edit_route:"editParty",
            errors:[],
            loading:false,
        }
    },
    validations() {
        return {
            form: {
                name: {required},
                mobile: {required, min: minLength(10), max: maxLength(15)},
                manager_name: {required},
                activity_cd: {required},
                status_cd: {required},
            }
        }
    },
    async created() {
        api.vw=this;
        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.form = await api.show(this.$route.params.id)
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


