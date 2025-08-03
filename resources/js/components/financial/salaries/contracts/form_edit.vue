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
                                    <select :disabled="true" class="form-select" v-model="form.month">
                                        <option v-for="c in 12" :key="c" :value="c">{{c}}</option>
                                    </select>
                                    <input :disabled="true" v-model="form.year" type="number" placeholder="سنة" class="form-control "  />
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
                            <tr>
                                <td>{{form.employee.full_name}}</td>
                                <td>{{form.employee.id_card}}</td>
                                <td>{{form.employee.salary}}</td>
                                <td>{{form.employee.currency.desc_ar}}</td>
                                <!-- loan_discount input with validation errors -->
                                <td>
                                    <input type="number" class="form-control" v-model="form.loan_discount" />
                                    <span v-if="v$.form.loan_discount.$error" class="text-danger">
                                                <p v-for="error in v$.form.loan_discount.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                </td>

                                <!-- deduction_discount input with validation errors -->
                                <td>
                                    <input type="number" class="form-control" v-model="form.deduction_discount" />
                                    <span v-if="v$.form.deduction_discount.$error" class="text-danger">
                                                <p v-for="error in v$.form.deduction_discount.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                </td>

                                <!-- Discount input with validation errors -->
                                <td>
                                    <input type="number" class="form-control" v-model="form.other_discounts" />
                                    <span v-if="v$.form.other_discounts.$error" class="text-danger">
                                                <p v-for="error in v$.form.other_discounts.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                </td>

                                <!-- bonuses input with validation errors -->
                                <td>
                                    <input type="number" class="form-control" v-model="form.bonuses" />
                                    <span v-if="v$.form.bonuses.$error" class="text-danger">
                                                <p v-for="error in v$.form.bonuses.$errors" :key="error.$uid">{{ msg(error) }}</p>
                                            </span>
                                </td>

                                <!-- Notes input with validation errors -->
                                <td>
                                    <input type="text" class="form-control" v-model="form.notes" />
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
                loan_discount: { required, numeric, minValue: minValue(0) },
                deduction_discount:  { required, numeric, minValue: minValue(0) },
                other_discounts:  { required, numeric, minValue: minValue(0) },
                bonuses:  { required, numeric, minValue: minValue(0) }
            }
        }
    },
    data() {
        return {
            title: "اعداد سند الراتب",
            form: {employee:{currency:{}},loan_discount:{},deduction_discount:{},other_discounts:{}, bonuses:{} , notes:{} , salary:{}, currency_cd:{}},
            edit_route: "editFinancialContractSalaries",
            loading: false,
            api_url: "/api/financial/salary/contract",
            employees:[],
            errors:[],
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
            }
        },
    },

}
</script>


