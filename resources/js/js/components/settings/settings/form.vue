<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{title}} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <form class="form" method="post">

                        <div class="row mb-5">
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">المفتاح</label>
                                <input readonly type="text" class="form-control form-control-solid" v-model="form.key" />
                                <span class="text-muted fw-light">
                                    <p>هذا الحقل للقراءة فقط لا يمكن تغييره</p>
                                </span>
                                <span class="text-danger fw-light" v-for="error of v$.form.key.$errors"
                                      :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-4 fv-row">
                                <label class="required fs-5 fw-bold mb-2">القيمة</label>
                                <input type="text" class="form-control form-control-solid" v-model="form.value" />
                                <span class="text-danger fw-light" v-for="error of v$.form.value.$errors"
                                    :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-5 fv-row">
                                <label class=" fs-5 fw-bold mb-2">الوصف </label>
                                <input type="text" class="form-control form-control-solid" v-model="form.notes" />
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class=" fs-5 fw-bold mb-2"> الحالة</label>
                            <div class="d-flex flex-stack">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <span class="form-check-label fw-bold text-muted">غير فعال</span>
                                    <input class="form-check-input" v-model="form.is_active"
                                        type="checkbox" />
                                    <span class="form-check-label fw-bold text-muted">فعال</span>
                                </label>
                            </div>
                        </div>

                        <div class="d-flex flex-center">
                            <button type="submit" class="btn btn-primary" @click.prevent="submit">
                                <span class="indicator-label" :class="{'visually-hidden':loading}">حفظ</span>
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
import { required } from '@vuelidate/validators'
import shared from "../../../src/shared";
import api from "../../../src/api";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
export default {
    name: "appSettingsForm",
    components: {ValidationServerErrors},
    setup() {
        return { v$: useVuelidate() }
    },
    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            form: { is_active: true },
            loading: false,
            api_url: "/api/settings",
            edit_route:"editSettings",
            title: 'قيمة جديدة',
            errors:[],
        }
    },
    validations() {
        return {
            form: {
                key: { required },
                value: { required }
            }
        }
    },
    async created() {
        api.vw=this;
        if (this.$router.currentRoute.value.name == this.edit_route) {
            this.form = (await shared.show(this.api_url, this.$route.params.id));
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
                await api.add();
            }
        },
    },

}
</script>


