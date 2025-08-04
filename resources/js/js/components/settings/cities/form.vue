<template>

    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors"/>
                    <form class="form" method="post">

                        <div class="row mb-5">

                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2"> الدولة</label>
                                <select v-model="form.country_id" class="form-select form-select-solid"
                                        data-placeholder="اختر...">
                                    <option v-for="c in countries" :value="c.id">{{ c.name }}</option>
                                </select>
                                <span v-for="error of v$.form.country_id.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div :class="{ 'is-invalid': v$.form.name.$errors.length }"
                                 class="col-md-4 fv-row is-invalid">
                                <label class="required fs-5 fw-bold mb-2">المدينة</label>
                                <input v-model="form.name" class="form-control form-control-solid" type="text"/>
                                <span v-for="error of v$.form.name.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class="fs-5 fw-bold mb-2"> العاصمة</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <span class="form-check-label fw-bold text-muted"> لا</span>
                                        <input v-model="form.capital"  class="form-check-input" type="checkbox"/>
                                        <span class="form-check-label fw-bold text-muted">نعم</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 fv-row">
                                <label class="fs-5 fw-bold mb-2"> الحالة</label>
                                <div class="d-flex flex-stack">

                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <span class="form-check-label fw-bold text-muted">غير فعال</span>
                                        <input v-model="form.is_active"  class="form-check-input"
                                               type="checkbox"/>
                                        <span class="form-check-label fw-bold text-muted">فعال</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex flex-center">
                            <button class="btn btn-primary" type="submit" @click.prevent="submit()">
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
import shared from "../../../src/shared";
import api from "../../../src/api";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
export default {
    name: "cityForm",
    components: {ValidationServerErrors},
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            loading: false,
            title: "مدينة جديدة",
            api_url:"/api/cities",
            edit_route:"editCity",
            form: {is_active: true, capital: true, country_id: "", name: ""},
            countries: [],
            errors:[],
        }
    },
    validations() {
        return {
            form: {
                country_id: {required},
                name: {required, min: minLength(3)}
            }
        }
    },
    async created() {
        api.vw= this;
        this.countries = await shared.countries();
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


