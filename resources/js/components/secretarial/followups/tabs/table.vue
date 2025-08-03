<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">

            <div class="me-4 btn-group">
                <button :disabled="!can('followup_search')" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                    <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                    البحث
                </button>
                    <div class="dropdown-menu  w-800px" >
                        <div class="separator border-gray-200"></div>
                        <form method="post" id="departments_search_form" >
                            <div class="px-7 py-5">

                                <div class="row">

                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold">  العنوان:</label>
                                        <input type="text" v-model="form.title" class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold"> الشخص المكلف</label>
                                        <select v-model="form.follower_id" class="form-select form-select-solid">
                                            <option value="-1">الكل</option>
                                            <option  v-for="(c , index) in employees" :value="c.id" :key="c.id"> {{ c.full_name}}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <code-select :main_cd="115" title="متعلقة بـ" :is_required="false" :is_searchable="true"
                                                     v-model:sub_cd="form.related_to" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <code-select :main_cd="116" title="مصدر التكليف" :is_required="false" :is_searchable="true"
                                                     v-model:sub_cd="form.commissioning_source_cd" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">جهة التكليف</label>
                                        <input type="text" class="form-control form-control-solid" v-model="form.commissioner" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">تاريخ  الاستحقاق - من:</label>
                                        <input  type="date" v-model="form.due_date__from" class="form-control form-control-solid" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">تاريخ  الاستحقاق - إلى:</label>
                                        <input  type="date" v-model="form.due_date__to" class="form-control form-control-solid" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">تاريخ  الاغلاق - من:</label>
                                        <input  type="date" v-model="form.finished_at__from" class="form-control form-control-solid" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">تاريخ  الاغلاق - إلى:</label>
                                        <input  type="date" v-model="form.finished_at__to" class="form-control form-control-solid" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">تاريخ  الانشاء - من:</label>
                                        <input  type="date" v-model="form.created_at__from" class="form-control form-control-solid" />
                                    </div>

                                    <div class="col-md-3 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">تاريخ  الانشاء - إلى:</label>
                                        <input  type="date" v-model="form.created_at__to" class="form-control form-control-solid" />
                                    </div>

                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold">  حالةالاغلاق:</label>
                                        <select  class="form-select form-select-solid" v-model="form.is_finished">
                                            <option   value="-1" >الكل</option>
                                            <option   value="1" >مغلق</option>
                                            <option   value="0" >جار العمل</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label class=" fs-5 fw-bold mb-2"> نص المتابعة</label>
                                        <input  type="text" v-model="form.details" class="form-control form-control-solid" />
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">تفريغ</button>
                                    <button type="submit" @click.prevent="search" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">بحث</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <action-buttons
                    :add-title="add_title"
                    :add-url="add_url.path"
                    :export-to-excel-action="exportToExcel"
                    :print-action="print"
                    add-perms="followup_add"
                    export-to-excel-perms="followup_export_to_excel"
                    print-perms="followups_print"
                />



            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div id="print_div" class="card-body py-3">
            <div class="flex flex-content-center">
                <div class="col-md-10 d-flex justify-content-center">
                    <div class="bg-light-primary ps-5 pt-3 pe-5 border-dashed border border-primary rounded  ">
                        <label class="form-label fw-boldest">   عدد  السجلات :</label>
                        <label class="form-label fw-boldest">   {{ total }}</label>
                    </div>
                </div>
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">

                <el-table  :data="results" height="500" :stripe="true" style="width: 100%">
                    <el-table-column label="العنوان" prop="title" />
                    <el-table-column label="التفاصيل" prop="details" />
                    <el-table-column label="متعلقة ب" prop="related.desc_ar" />
                    <el-table-column label="نوع التكليف" prop="sourcex.desc_ar" />
                    <el-table-column label="تم التكليف بواسطة" prop="commissioner" />
                    <el-table-column label="الشخص المكلف بها" prop="follower.full_name" />
                    <el-table-column label="أنشأت بواسطة" prop="creator.full_name" />
                    <el-table-column label=" الحالة" >
                        <template #default="scope">
                            <span v-if="scope.row.is_finished" class="badge rounded-pill bg-success">مغلق</span>
                            <span v-else class="badge rounded-pill bg-warning">جار العمل</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="ملاحظات الاغلاق" prop="finish_note" />
                    <el-table-column label=" تاريخ الانشاء" prop="created_at" />
                    <el-table-column label=" تاريخ الاستحقاق" prop="due_date" />
                    <el-table-column label=" تاريخ الاغلاق" prop="finished_at" />
                    <el-table-column fixed="right" label="Operations" >
                        <template #default="scope">
                            <div class="btn-group" role="group">
                                <router-link v-show="can('followup_handle')" :to="{name: 'followupDetails', params: { id: scope.row.id }}" class="btn btn-warning">
                                    <i class="fas fa-cogs"></i>
                                </router-link>

                            </div>
                        </template>
                    </el-table-column>
                </el-table>

                <el-divider></el-divider>

                <div class="d-flex flex-center">
                    <el-pagination
                        :page-size="100"
                        :total="total"
                        background
                        layout="prev, pager, next"
                        @current-change="search(1)">
                    </el-pagination>
                </div>
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
</template>

<script>

import CodeSelect from "../../../_common/codeSelect";
import shared from "../../../../src/shared";
import api from "../../../../src/api";
import ActionButtons from "../../../_common/actionButtons";
export default {
    name: "followups",
    components: {ActionButtons, CodeSelect},
    data() {
        return {
            title: 'المتابعات ',
            add_title:'متابعة جديدة',
            add_url: this.$router.resolve({name:'addFollowup'}),
            form: {is_finished:0,commissioning_source_cd:-1,related_to:-1},
            employees: [],
            results: [],
            api_url: "/api/followups",
            total:0,
            currentPage:1,
        }
    },
    async created() {
        api.vw=this;
        this.employees = await shared.employees();
        await this.search();
    },
    methods: {
        async search(next) {
            await api.search(next);
        },
        exportToExcel(){
            api.exportToExcel();
        },
        print(){
            shared.print("print_div");
        },
    }
}
</script>


