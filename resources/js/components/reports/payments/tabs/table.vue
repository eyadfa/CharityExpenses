<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">
                <div class="row mb-5">


                    <div class="col-md-4 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> الفريق</label>
                        <el-select multiple v-model="form.name" filterable placeholder="اختر..." class="form-control" >
                            <el-option
                                v-for="item in teams"
                                :key="item.id"
                                :label="item.full_name"
                                :value="item"
                            />
                        </el-select>
                    </div>
                    <div class="col-md-2 fv-row">
                        <label class=" fs-5 fw-bold mb-2">قيمة الدفعة - من </label>
                        <input v-model="form.address" class="form-control form-control-solid" type="number"/>
                    </div>

                    <div class="col-md-2 fv-row">
                        <label class=" fs-5 fw-bold mb-2">قيمة الدفعة - إلى </label>
                        <input v-model="form.address" class="form-control form-control-solid" type="number"/>
                    </div>

                    <div class="col-md-2 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> تاريخ الدفعة- من </label>
                        <input v-model="form.start_date" class="form-control form-control-solid"
                               type="datetime-local"/>
                    </div>

                    <div class="col-md-2 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> تاريخ الدفعة- إلى </label>
                        <input v-model="form.start_date" class="form-control form-control-solid"
                               type="datetime-local"/>
                    </div>
                    <div class="col-md-2 fv-row">
                        <code-select :is_searchable="true" v-model:sub_cd="form.priority_cd" :main_cd="8" title="نوع الصرف"/>
                    </div>

                </div>
                <action-buttons
                    :show-add="false"
                    print-perms="agenda_print"
                    :print-action="print"
                    export-to-excel-perms="agenda_export_to_excel"
                    :export-to-excel-action="exportToExcel"
                />



            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="flex flex-content-center">
                <div class="col-md-10 d-flex justify-content-center">
                    <div class="bg-light-primary ps-5 pt-3 pe-5 border-dashed border border-primary rounded  ">
                        <label class="form-label fw-boldest">   عدد  السجلات :</label>
                        <label class="form-label fw-boldest">   {{ total }}</label>
                    </div>
                </div>
            </div>

            <div id="print_div" class="overflow-auto">
                <el-table
                    :stripe="true"
                    :data="results"
                    height="400"
                    style="width: 100%">

                    <el-table-column align="right" label="الفريق" sortable  prop="team"  />
                    <el-table-column align="right" label=" المبلغ" sortable  prop="amount" />
                    <el-table-column align="right" label=" العملة" sortable  prop="currency" />
                    <el-table-column align="right" label="سعر الصرف"  sortable prop="exchange" />
                    <el-table-column align="right" label="المبلغ الاجمالي "  sortable prop="totol" />
                    <el-table-column align="right" label="تاريخ الدفعة"  sortable prop="srf_date" />
                    <el-table-column align="right" label=" طريقة الصرف"  sortable prop="srf_way" />
                    <el-table-column align="right" label=" ملاحظات"  sortable prop="notes" />
                    <el-table-column align="right" label="تم الادخال بواسطة"  sortable prop="created_by" />
                    <el-table-column align="right" label="تاريخ الاضافة"  sortable prop="created_at" />
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
import shared from "../../../../src/shared";
import api from "../../../../src/api";
import ActionButtons from "../../../_common/actionButtons";
export default {
    name: "reportsPaymentsTable",
    components: {ActionButtons},
    data() {
        return {
            title: 'تقارير المدفوعات',
            add_title:' بند جديد',
            form:{},
            api_url: "/api/payments",
            loading:false,
            total: 0,
            currentPage:1,
            results:[],
        }
    },
    created() {
        api.vw=this;
        this.search();
    },
    methods: {
        async search(next) {
            await api.search(next);
        },
        async _delete(_id) {
            await api._delete(_id);
        },
        exportToExcel(){
            api.exportToExcel()
        },
        print(){
            shared.print("print_div")
        }
    },
}
</script>


