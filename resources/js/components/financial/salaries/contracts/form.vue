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
                            <div class="row">
                                <div class="col-md-3 fv-row bg-light-primary border border-gray-300 border-end-dashed border-1">
                                    <label class="required fs-5 fw-bold mb-2">  دورة الصرف </label>
                                    <div class="d-flex align-items-center">
                                        <select class="form-select" v-model="form.month">
                                            <option v-for="c in 12" :key="c" :value="c">{{c}}</option>
                                        </select>
                                        <input v-model="form.year" type="number" placeholder="سنة" class="form-control "  />
                                    </div>
                                    <span v-for="error of v$.form.year.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                    <span v-for="error of v$.form.month.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>
                            </div>

                            <table id="departments_table" class="table table-row-dashed table-row-gray-300 table-striped gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                <tr>
                                    <th> اسم الموظف </th>
                                    <th>الرقم الوظيفي</th>
                                    <th> الراتب </th>
                                    <th> العملة </th>
                                    <th>قيمة خصم القرض</th>
                                    <th> سداد سلفة</th>
                                    <th>خصميات أخرى</th>
                                    <th>علاوات أخرى</th>
                                    <th>ملاحظات</th>
                                </tr>

                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <tr v-for="c in employees">
                                         <td>{{ c.full_name}}</td>
                                         <td>{{c.id_card}}</td>
                                         <td>{{c.salary}}</td>
                                         <td>{{c.currency.desc_ar}}</td>
                                        <!-- Loan input with validation errors -->
                                        <td>
                                            <input type="number" class="form-control" v-model="form.loan[c.id]" />
                                            <span v-if="v$.form.loan[c.id].$error" class="text-danger">
                                                <p v-for="error in v$.form.loan[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                        </td>

                                        <!-- Deduction input with validation errors -->
                                        <td>
                                            <input type="number" class="form-control" v-model="form.deduction[c.id]" />
                                            <span v-if="v$.form.deduction[c.id].$error" class="text-danger">
                                                <p v-for="error in v$.form.deduction[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                        </td>

                                        <!-- Discount input with validation errors -->
                                        <td>
                                            <input type="number" class="form-control" v-model="form.discount[c.id]" />
                                            <span v-if="v$.form.discount[c.id].$error" class="text-danger">
                                                <p v-for="error in v$.form.discount[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                        </td>

                                        <!-- Bonus input with validation errors -->
                                        <td>
                                            <input type="number" class="form-control" v-model="form.bonus[c.id]" />
                                            <span v-if="v$.form.bonus[c.id].$error" class="text-danger">
                                                <p v-for="error in v$.form.bonus[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                        </td>

                                        <!-- Notes input with validation errors -->
                                        <td>
                                            <input type="text" class="form-control" v-model="form.notes[c.id]" />
                                            <span v-if="v$.form.notes[c.id].$error" class="text-danger">
                                                <p v-for="error in v$.form.notes[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!--end::Table body-->
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
import {useVuelidate} from "@vuelidate/core";
import {between, required, numeric, minValue } from "@vuelidate/validators";
import shared from "../../../../src/shared";
import ValidationServerErrors from "../../../_common/ValidationServerErrors";
import api from "../../../../src/api";

export default {
    name: "FinContractsEmployeesSalariesForm",
    components:{ValidationServerErrors, codeSelect},
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
                year: { required, between: between(new Date().getFullYear(), new Date().getFullYear(), 'YYYY') },
                loan: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(0) };
                    return rules;
                }, {}),
                deduction: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(0) };
                    return rules;
                }, {}),
                discount: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(0) };
                    return rules;
                }, {}),
                bonus: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(0) };
                    return rules;
                }, {}),
                notes: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required };
                    return rules;
                }, {})

            }
        }
    },
    data() {
        return {
            title: "اعداد سند الراتب",
            form: {loan:{},deduction:{},discount:{}, bonus:{} , notes:{} , salary:{}, currency_cd:{}},
            edit_route: "editFinancialBeneficiariesSrf",
            loading: false,
            api_url: "/api/financial/salary/contract",
            employees:[],
            errors:[],
        }
    },

    async created() {
        api.vw=this;
        this.employees = await shared.employees(-1,5);
        this.employees.forEach((e) =>{
            this.form.salary[e.id] = e.salary;
            this.form.currency_cd[e.id] = e.currency_cd;
        })
    },
    methods: {

        async submit() {
            this.errors=[];
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            await api.store();
        },
    },

}
</script>


