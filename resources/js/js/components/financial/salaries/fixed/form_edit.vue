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
                                <th> علاوة طبيعة  العمل </th>
                                <th> علاوة زوجة </th>
                                <th> علاوة أبناء </th>
                                <th> علاوة اختصاص </th>
                                <th> علاوة ادارية </th>
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
                            <tr >
                                <td>{{ form.employee.full_name}}</td>
                                <td>{{form.employee.id_card}}</td>
                                <td>{{form.employee.salary}}</td>
                                <td>{{form.employee.currency.desc_ar}}</td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.job_type_bonus"/>
                                    <span v-for="error of v$.form.job_type_bonus.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.wife_bonus"/>
                                    <span v-for="error of v$.form.wife_bonus.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.sons_bonus"/>
                                    <span v-for="error of v$.form.sons_bonus.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.specialization_bonus"/>
                                    <span v-for="error of v$.form.specialization_bonus.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.administrative_bonus"/>
                                    <span v-for="error of v$.form.administrative_bonus.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.loan_discount" />
                                    <span v-for="error of v$.form.loan_discount.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.deduction_discount"/>
                                    <span v-for="error of v$.form.deduction_discount.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.other_discounts"/>
                                    <span v-for="error of v$.form.other_discounts.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td>
                                    <input type="number" class="form-control" v-model="form.bonuses"/>
                                    <span v-for="error of v$.form.bonuses.$errors" :key="error.$uid"
                                          class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </td>
                                <td><input type="text" class="form-control" v-model="form.notes"  /></td>
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
import {between, required, numeric,minValue} from "@vuelidate/validators";
import shared from "../../../../src/shared";
import ValidationServerErrors from "../../../_common/ValidationServerErrors";
import api from "../../../../src/api";

export default {
    name: "FinFixedEmployeesSalariesForm",
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
                job_type_bonus:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                wife_bonus:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                sons_bonus:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                specialization_bonus:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                administrative_bonus:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                loan_discount:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                deduction_discount:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                other_discounts:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },
                bonuses:  {
                        required,
                        numeric,
                        minValue: minValue(0),
                    },

            }
        }
    },
    data() {
        return {
            title: "اعداد سند الراتب",
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
            edit_route: "editFinancialSalaries",
            loading: false,
            api_url: "/api/financial/salary/fixed",
            employees:[],
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
            this.errors=[];
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


