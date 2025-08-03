<template>
    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row bg-light-primary border border-gray-300 border-end-dashed border-1">
                            <label class="required fs-5 fw-bold mb-2">دورة الصرف</label>
                            <div class="d-flex align-items-center">
                                <select :disabled="true" class="form-select" v-model="form.month">
                                    <option v-for="c in 12" :key="c" :value="c">{{ c }}</option>
                                </select>
                                <input :disabled="true" v-model="form.year" type="number" placeholder="سنة" class="form-control" />
                            </div>
                        </div>

                        <table class="table table-row-dashed table-row-gray-300 table-striped gs-0 gy-4">
                            <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>رقم الهوية</th>
                                <th>عدد الساعات</th>
                                <th>سعر الساعة</th>
                                <th>العملة</th>
                                <th>ملاحظات</th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ form.employee.full_name }}</td>
                                <td>{{ form.employee.id_card }}</td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.hour_no" />
                                    <span v-if="v$.form.hour_no.$error" class="text-danger">
                                            <p v-for="error in v$.form.hour_no.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.hour_payments" />
                                    <span v-if="v$.form.hour_payments.$error" class="text-danger">
                                            <p v-for="error in v$.form.hour_payments.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <code-select :is_required="false" :main_cd="56" :display_title="false" v-model:sub_cd="form.currency_cd" />
                                    <span v-if="v$.form.currency_cd.$error" class="text-danger">
                                            <p v-for="error in v$.form.currency_cd.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="form.notes" />
                                    <span v-if="v$.form.notes.$error" class="text-danger">
                                            <p v-for="error in v$.form.notes.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-center">
                        <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                            <span class="indicator-label">حفظ</span>
                        </button>
                        <button @click.prevent="$router.back()" class="btn btn-light me-3">تراجع</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { required, numeric, minValue, between } from "@vuelidate/validators";
import ValidationServerErrors from "../../../_common/ValidationServerErrors";
import codeSelect from "../../../_common/codeSelect";
import api from "../../../../src/api";
import shared from "../../../../src/shared";

export default {
    name: "FinHourlyEmployeeSalaryForm",
    components: { ValidationServerErrors, codeSelect },
    setup() {
        return { v$: useVuelidate() };
    },
    validations() {
        return {
            form: {
                hour_no: { required, numeric, minValue: minValue(1) },
                hour_payments: { required, numeric, minValue: minValue(0.01) },
                currency_cd: { required },
                notes: { required },
            }
        };
    },
    data() {
        return {
            title: "اعداد سند الراتب",
            form: {},
            employee: {},
            errors: [],
            api_url: "/api/financial/salary/hourly"
        };
    },
    async created() {
        api.vw=this;
        this.form = await shared.show(this.api_url, this.$route.params.id);
    },
    methods: {
        async submit() {
            this.errors = [];
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            await api.update();
        },
    }
};
</script>

