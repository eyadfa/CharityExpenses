<template>
    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <div class="row mb-5">
                        <div class="row">
                            <div class="col-md-3 fv-row bg-light-primary border border-gray-300 border-end-dashed border-1">
                                <label class="required fs-5 fw-bold mb-2">دورة الصرف</label>
                                <div class="d-flex align-items-center">
                                    <select class="form-select" v-model="form.month">
                                        <option v-for="c in 12" :key="c" :value="c">{{ c }}</option>
                                    </select>
                                    <input v-model="form.year" type="number" placeholder="سنة" class="form-control" />
                                </div>
                                <span v-for="error in v$.form.year.$errors" :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                                <span v-for="error in v$.form.month.$errors" :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                        </div>

                        <table id="departments_table" class="table table-row-dashed table-row-gray-300 table-striped gs-0 gy-4">
                            <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>الرقم الوظيفي</th>
                                <th>الراتب</th>
                                <th>العملة</th>
                                <th>علاوة طبيعة العمل</th>
                                <th>علاوة زوجة</th>
                                <th>علاوة أبناء</th>
                                <th>علاوة اختصاص</th>
                                <th>علاوة ادارية</th>
                                <th>قيمة خصم القرض</th>
                                <th>سداد سلفة</th>
                                <th>خصميات أخرى</th>
                                <th>علاوات أخرى</th>
                                <th>ملاحظات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="c in employees" :key="c.id">
                                <td>{{ c.full_name }}</td>
                                <td>{{ c.id_card }}</td>
                                <td>{{ c.salary }}</td>
                                <td>{{ c.currency.desc_ar }}</td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.job_type_bonus[c.id]" />
                                    <span v-if="v$.form.job_type_bonus[c.id].$errors" class="text-danger fw-light">
                                            <p v-for="error in v$.form.job_type_bonus[c.id].$errors" :key="error.$uid"  >{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.wife_bonus[c.id]" />
                                    <span v-if="v$.form.wife_bonus[c.id].$errors" class="text-danger fw-light">
                                            <p v-for="error in v$.form.wife_bonus[c.id].$errors" :key="error.$uid" >{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.sons_bonus[c.id]" />
                                    <span v-if="v$.form.sons_bonus[c.id].$errors" class="text-danger fw-light">
                                            <p v-for="error in v$.form.sons_bonus[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.specialization_bonus[c.id]" />
                                    <span  v-if="v$.form.specialization_bonus[c.id].$errors" class="text-danger fw-light">
                                            <p v-for="error in v$.form.specialization_bonus[c.id].$errors" :key="error.$uid" >{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.administrative_bonus[c.id]" />
                                    <span v-if="v$.form.administrative_bonus[c.id].$errors" class="text-danger fw-light">
                                            <p  v-for="error in v$.form.administrative_bonus[c.id].$errors" :key="error.$uid" >{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.loan[c.id]" />
                                    <span v-if="v$.form.loan[c.id].$errors" class="text-danger fw-light">
                                            <p v-for="error in v$.form.loan[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.deduction[c.id]" />
                                    <span v-if="v$.form.deduction[c.id].$errors" class="text-danger fw-light">
                                            <p  v-for="error in v$.form.deduction[c.id].$errors" :key="error.$uid" >{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.discount[c.id]" />
                                    <span v-if="v$.form.discount[c.id].$errors" class="text-danger fw-light">
                                            <p v-for="error in v$.form.discount[c.id].$errors" :key="error.$uid" >{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.bonus[c.id]" />
                                    <span v-if="v$.form.bonus[c.id].$errors" class="text-danger fw-light">
                                            <p  v-for="error in v$.form.bonus[c.id].$errors" :key="error.$uid" >{{ msg(error) }}</p>
                                        </span>
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="form.notes[c.id]" />
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
import codeSelect from "../../../_common/codeSelect";
import { useVuelidate } from "@vuelidate/core";
import { between, required, numeric, minValue } from "@vuelidate/validators";
import shared from "../../../../src/shared";
import ValidationServerErrors from "../../../_common/ValidationServerErrors";
import api from "../../../../src/api";

export default {
    name: "FinFixedEmployeesSalariesForm",
    components: { ValidationServerErrors, codeSelect },
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    validations() {
        return {
            form: {
                month: { required },
                year: {
                    required,
                    between: between(new Date().getFullYear(), new Date().getFullYear(), "YYYY"),
                },
                job_type_bonus: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                wife_bonus: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                sons_bonus: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                specialization_bonus: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                administrative_bonus: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                loan: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                deduction: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                discount: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                bonus: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
            },
        };
    },
    data() {
        return {
            title: "اعداد سند الراتب",
            errors: [],
            edit_route: "editFinancialBeneficiariesSrf",
            loading: false,
            api_url: "/api/financial/salary/fixed",
            employees: [],
            form: {
                loan:{},
                deduction:{},
                discount:{},
                bonus:{} ,
                notes:{} ,
                salary:{},
                currency_cd:{},
                job_type_bonus:{},
                wife_bonus:{},
                sons_bonus:{},
                specialization_bonus:{},
                administrative_bonus:{},
                errors:[],
            },
        };
    },
    async created() {
        api.vw = this;
        this.employees = await shared.employees(-1, 2);
        this.employees.forEach((e) => {
            this.form.salary[e.id] = e.salary;
            this.form.currency_cd[e.id] = e.currency_cd;
        });
        if (this.$router.currentRoute.value.name == this.edit_route) {
            this.form = (await shared.show(this.api_url, this.$route.params.id));
        }
    },
    methods: {
        async submit() {
            this.errors = [];
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
           await api.store();
        },
    },
};
</script>
