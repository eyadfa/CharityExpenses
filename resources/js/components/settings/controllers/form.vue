<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <form id="kt_modal_departments_form" class="form" method="post">
                        <div class="row mb-5">
                            <div class="col-md-4 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الاسم</label>
                                <input v-model="form.name" class="form-control form-control-solid" type="text"/>
                                <span v-for="error of v$.form.name.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-8 fv-row">
                                <label class="fs-5 fw-bold mb-2">الوصف</label>
                                <input v-model="form.caption" class="form-control form-control-solid" type="text"/>
                            </div>


                            <div class="col-md-2 fv-row">
                                <label class="required fs-5 fw-bold mb-2"> الحالة</label>
                                <div class="d-flex flex-stack">

                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <span class="form-check-label fw-bold text-muted">غير فعال</span>
                                        <input v-model="form.is_active" checked="checked" class="form-check-input"
                                               type="checkbox" value="1"/>
                                        <span class="form-check-label fw-bold text-muted">فعال</span>
                                    </label>
                                </div>
                            </div>

                        </div>


                        <div class="d-flex flex-center">
                            <button class="btn btn-primary" type="submit" @click.prevent="submit">
                                <span :class="{'visually-hidden':loading}" class="indicator-label">حفظ</span>
                                <div :class="{'visually-hidden': !loading}" class="spinner-border text-light"></div>
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
import {minLength, required} from '@vuelidate/validators'
import api from "../../../src/api";
import shared from "../../../src/shared";
import ValidationServerErrors from "../../_common/ValidationServerErrors";

export default {
    name: "ِaddControllerForm",
    components: {ValidationServerErrors},
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            title: " النماذج الرئيسية",
            edit_route: "editController",
            api_url:"/api/controllers",
            form: {is_active: true},
            loading: false,
            errors:[],
        }
    },

    async created() {
        api.vw=this;
        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.form = (await api.show(this.$route.params.id));
        }
    },
    validations() {
        return {
            form: {
                name: {required, min: minLength(3)},
            }
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


