<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">

            <div class="me-4 btn-group">
                <button :disabled="denies('fin_salaries_fixed_search')" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                    <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                    البحث
                </button>

                <div class="dropdown-menu w-450px w-md-500px" >
                    <div class="separator border-gray-200"></div>
                    <form method="post" id="departments_search_form" >
                        <div class="px-7 py-5">

                            <div class="row">

                                <div class="col-md-6 fv-row">
                                    <label class=" fs-5 fw-bold mb-2">دورة الراتب </label>
                                    <div class="d-flex align-items-center">
                                        <select class="form-select" v-model="form.month">
                                            <option v-for="c in 12" :key="c" :value="c">{{c}}</option>
                                        </select>
                                        <input v-model="form.year" type="number" placeholder="سنة" class="form-control "  />
                                    </div>
                                </div>


                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">تفريغ</button>
                                <button @click.prevent="search" type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">بحث</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>

                <action-buttons
                    :add-url="add_url.path"
                    :add-title="add_title"
                    add-perms="fin_salaries_fixed_add"
                    export-to-excel-perms="fin_salaries_fixed_export_to_excel"
                    print-perms="fin_salaries_fixed_print"
                    :export-to-excel-action="exportToExcel"
                    :print-action="print"
                />

            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-3">

            <div class="overflow-auto">
                <el-table
                    :stripe="true"
                    :data="results"
                    id="data_table"
                    height="400"
                    style="width: 100%">

                    <el-table-column align="right" label="اسم الموظف"   prop="employee.full_name"  />
                    <el-table-column align="right" label="دورة الراتب"   prop="round"  />
                    <el-table-column align="right" label="الراتب"   prop="salary" />
                    <el-table-column align="right" label="العملة"   prop="currency.desc_ar"   />
                    <el-table-column align="right" label="قيمة خصم القرض"   prop="loan_discount" />
                    <el-table-column align="right" label="سداد سلفة "   prop="deduction_discount" />
                    <el-table-column align="right" label="خصميات أخرى "   prop="other_discounts" />
                    <el-table-column align="right" label=" علاوة طبيعة عمل "   prop="job_type_bonus" />
                    <el-table-column align="right" label="علاوة زوجة"   prop="wife_bonus" />
                    <el-table-column align="right" label="علاوة أبناء"   prop="sons_bonus" />
                    <el-table-column align="right" label="علاوة اختصاص "   prop="specialization_bonus" />
                    <el-table-column align="right" label="علاوة ادارية "   prop="administrative_bonus" />
                    <el-table-column align="right" label="علاوات أخرى "   prop="bonuses" />
                    <el-table-column align="right" label="صافي الراتب"   prop="grand_salary" />
                    <el-table-column align="right" label="ملاحظات"   prop="notes" />

                    <el-table-column align="right" label="تاريخ الاضافة"  sortable prop="created_at" />
                    <el-table-column fixed="right">
                        <template #default="scope">
                            <el-dropdown v-if="scope.row.is_financial_manager_certified == 0 " trigger="click">
                                <span class="el-dropdown-link btn btn-secondary btn-icon">
                                   <i class="fas fa-cogs"></i>
                                </span>
                                <template #dropdown>
                                    <el-dropdown-menu >

                                        <el-dropdown-item v-if="scope.row.is_certified == 0 && can('fin_salaries_fixed_edit')">
                                            <router-link :to="{name: 'editFinancialSalaries', params: { id: scope.row.id }}" class="dropdown-item">
                                                تعديل
                                            </router-link>
                                        </el-dropdown-item >

                                        <el-dropdown-item v-if="scope.row.is_certified == 0 && can('fin_salaries_fixed_delete')" >
                                            <a  class="dropdown-item" @click.prevent="_delete(scope.row.id)" >
                                                حذف
                                            </a>
                                        </el-dropdown-item>

                                        <el-dropdown-item  v-if="scope.row.is_certified == 0 && can('fin_salaries_fixed_certify')" >
                                            <a class="dropdown-item" @click.prevent="certify(scope.row.id)" >
                                                اعتماد المدقق
                                            </a>
                                        </el-dropdown-item>

                                        <el-dropdown-item >
                                            <a  v-if="scope.row.is_certified == 1
                                            && scope.row.is_financial_manager_certified ==0
                                            && can('fin_salaries_fixed_manager_certify')" class="dropdown-item" @click.prevent="manager_certify(scope.row.id)" >
                                                اعتماد المدير المالي
                                            </a>
                                        </el-dropdown-item>


                                    </el-dropdown-menu>
                                </template>
                            </el-dropdown>

                        </template>
                    </el-table-column>
                </el-table>


                <div class="d-flex flex-center">
                    <el-pagination
                        :page-size="100"
                        :total="total"
                        style="direction: ltr"
                        background
                        layout="prev, pager, next"
                        @current-change="search(1)">
                    </el-pagination>
                </div>
            </div>
        </div>
        <!--begin::Body-->
    </div>
</template>

<script>

import shared from "../../../../../src/shared";
import api from "../../../../../src/api";
import {ElMessage, ElMessageBox} from "element-plus";
import ActionButtons from "../../../../_common/actionButtons";

export default {
    name: "FinFixedEmployeesSalariesTable",
    components: {ActionButtons},
    data() {
        return {
            title: 'رواتب الموظفين ',
            add_title:' اعداد سند الرواتب',
            add_url: this.$router.resolve({name:'addFinancialSalaries'}),
            loading:false,
            api_url:"/api/financial/salary/fixed",
            form:{},
            total: 0,
            results:[],
        }
    },
    async created() {
        api.vw=this;
        await this.search();
    },

    methods: {
        async search(next) {
            await api.search(next)
        },
        _delete(_id) {
            api._delete(_id)
        },
        exportToExcel(){
            api.exportToExcel()
        },
        certify(sanad_id){

            ElMessageBox.prompt('في حالة اعتماد السندلا يمكنك التعديل عليه', 'اعتماد السند', {
                confirmButtonText: 'اعتماد',
                cancelButtonText: 'الغاء',
                center:true,
                type: 'warning',
            })
                .then(async ({value}) => {
                    let res = await shared.certify(this.api_url , sanad_id,{id: sanad_id,notes:value});
                    ElMessage({
                        type: 'success',
                        message: `تمت عملية الاعتماد بنجاح`,
                    });
                    await this.search();
                })
        },

        manager_certify(sanad_id) {

            ElMessageBox.prompt('في حالة اعتماد السند لا يمكن التعديل عليه', 'اعتماد المدير المالي', {
                confirmButtonText: 'اعتماد',
                cancelButtonText: 'الغاء',
                center: true,
                type: 'warning',
            })
                .then(async ({value}) => {
                    let res = await shared.post(this.api_url + "/mcertify/" +  sanad_id, {id: sanad_id, notes: value});
                    if(res.status){
                        ElMessage({
                            type: 'success',
                            message: `تمت عملية الاعتماد بنجاح`,
                        })
                        await this.search();
                    }else{
                        ElMessage({
                            type: 'error',
                            message: res.message,
                        })
                    }

                })
        },
        print(){
            shared.print("data_table");
        }
    },
}
</script>


