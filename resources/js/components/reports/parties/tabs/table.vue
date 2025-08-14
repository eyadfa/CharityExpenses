<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">


                        <form method="post" id="departments_search_form" >
                            <div class="px-7 py-5">

                                <div class="row">
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
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="option1" id="checkbox1" checked>
                                            <label class="form-check-label" for="checkbox1">
                                                المصروفات/الفواتير
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="option2" id="checkbox2" checked>
                                            <label class="form-check-label" for="checkbox2">
                                                المدفوعات
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-md-2 fv-row">
                                        <label class=" fs-5 fw-bold mb-2"> تاريخ الصرف - من </label>
                                        <input v-model="form.start_date" class="form-control form-control-solid"
                                               type="datetime-local"/>
                                    </div>

                                    <div class="col-md-2 fv-row">
                                        <label class=" fs-5 fw-bold mb-2"> تاريخ الصرف - إلى </label>
                                        <input v-model="form.start_date" class="form-control form-control-solid"
                                               type="datetime-local"/>
                                    </div>
                                    <div class="col-md-4 fv-row">
                                        <code-select :is_searchable="true" v-model:sub_cd="form.priority_cd" :main_cd="8" title="نوع الصرف"/>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">تفريغ</button>
                                    <button type="submit" @click.prevent="search" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">بحث</button>
                                </div>
                            </div>
                        </form>

                <action-buttons
                    :show-add="false"
                    add-perms="agenda_add"
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

                    <el-table-column align="right" label="التاريخ" sortable  prop="date"  />
                    <el-table-column align="right" label=" طريقة الدفع"  sortable prop="way"   />
                    <el-table-column align="right" label="الجهة المرتبطة"  sortable prop="agent"   />
                    <el-table-column align="right" label=" مصروفات/ شيكل" sortable  prop="in" />
                    <el-table-column align="right" label=" دفعات/ شيكل" sortable  prop="out" />
                    <el-table-column align="right" label="بند المصروف" sortable  prop="notes" />
                    <el-table-column align="right" label="ملاحظات" sortable  prop="notes" />


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
    name: "reportsPartiesTable",
    components: {ActionButtons},
    data() {
        return {
            title: 'تقارير الجهات المرتبطة',
            add_title:' بند جديد',
            form:{},
            api_url: "/api/parties",
            loading:false,
            total: 0,
            currentPage:1,
            results:[],
        }
    },
    created() {
        api.vw=this;
        this.search();
        this.results=[
            {date: '2025-08-01', way: 'نقداً', agent: 'أحمد صالح', in: '1500', out: '0', notes: 'دفعة مقدمة مستلمة'},
            {date: '2025-08-02', way: 'تطبيق', agent: 'منى حسن', in: '0', out: '750', notes: 'إيجار المكتب'},
            {date: '2025-08-03', way: 'تطبيق', agent: 'خالد عمر', in: '0', out: '320', notes: 'شراء قرطاسية'},
            {date: '2025-08-04', way: 'نقداً', agent: 'سارة يونس', in: '2000', out: '0', notes: 'دفعة لمشروع عميل'},
            {date: '2025-08-05', way: 'تطبيق', agent: 'يوسف علي', in: '0', out: '1200', notes: 'شراء معدات'},
            {date: '2025-08-06', way: 'تطبيق', agent: 'هلا محمود', in: '0', out: '500', notes: 'مصاريف تسويق'},
            {date: '2025-08-07', way: 'نقداً', agent: 'عمر فتحي', in: '800', out: '0', notes: 'دفعة جزئية مقابل خدمات'}
        ];
        this.total=7;
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


