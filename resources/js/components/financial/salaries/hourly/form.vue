<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                        <validation-server-errors :errors="errors"/>
                        <div class="row mb-5">
                            <div class="row">
                                <div class="col-md-6 fv-row bg-light-primary border border-gray-300 border-end-dashed border-1">
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
                                    <th> رقم الهوية</th>
                                    <th>عدد الساعات</th>
                                    <th>سعر الساعة</th>
                                    <th>العملة</th>
                                    <th>ملاحظات</th>
                                </tr>

                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <tr v-for="c in employees">
                                       <td>{{ c.full_name}}</td>
                                       <td>{{c.id_card}}</td>
                                       <td>
                                           <input type="number" class="form-control" v-model="form.hours[c.id]" />
                                           <span v-if="v$.form.hours[c.id].$error" class="text-danger">
                                               <p v-for="error in v$.form.hours[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                           </span>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" v-model="form.rates[c.id]"/>
                                           <span v-if="v$.form.rates[c.id].$error" class="text-danger">
                                               <p v-for="error in v$.form.rates[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                           </span>
                                       </td>
                                       <td>
                                           <code-select :is_required="false" :main_cd="56" :display_title="false" v-model:sub_cd="form.currency_cd[c.id]"/>
                                           <span v-if="v$.form.currency_cd[c.id].$error" class="text-danger">
                                               <p v-for="error in v$.form.currency_cd[c.id].$errors" :key="error.$uid">{{ msg(error) }}</p>
                                           </span>
                                       </td>
                                       <td>
                                           <input type="text" class="form-control" v-model="form.notes[c.id]"  />
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

import {useVuelidate} from "@vuelidate/core";
import {between,  required, numeric, minValue, helpers } from "@vuelidate/validators";
import shared from "../../../../src/shared";
import codeSelect from "../../../_common/codeSelect";
import api from "../../../../src/api";
import ValidationServerErrors from "../../../_common/ValidationServerErrors";

export default {
    name: "FinHourlyEmployeesSalariesForm",
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
                month: {required},
                year: {
                    required ,
                    numeric,
                    between: between(new Date().getFullYear(), new Date().getFullYear(), 'YYYY')
                },
                hours: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(1) };
                    return rules;
                }, {}),
                rates: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required, numeric, minValue: minValue(0.01) };
                    return rules;
                }, {}),
                currency_cd: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required };
                    return rules;
                }, {}),
                notes: this.employees.reduce((rules, employee) => {
                    rules[employee.id] = { required };
                    return rules;
                }, {}),

            }
        }
    },
    data() {
        return {
            title: "اعداد سند الراتب",
            form: {hours:{},rates:{},notes:{}, currency_cd:{}},
            edit_route: "editFinancialBeneficiariesSrf",
            loading: false,
            api_url: "/api/financial/salary/hourly",
            employees:[],
            errors:[],
        }
    },

    async created() {
        api.vw=this;
        this.employees = await shared.employees(-1,1);
    },
    methods: {
        async submit() {
            this.errors=[]
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
           await api.update();
        },
    },

}
</script>


