<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">

            <div class="me-4 btn-group">
                <button :disabled="!can('agenda_search')" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                    <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                    البحث
                </button>
                    <div class="dropdown-menu w-450px w-md-500px" >
                        <div class="separator border-gray-200"></div>
                        <form method="post" id="departments_search_form" >
                            <div class="px-7 py-5">

                                <div class="row">
                                    <div class="col-md-6 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">  عنوان البند</label>
                                        <input v-model="form.name"  type="text" class="form-control form-control-solid"  />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label class=" fs-5 fw-bold mb-2"> المكان</label>
                                        <input v-model="form.address"  type="text" class="form-control form-control-solid"  />
                                    </div>


                                    <div class="col-md-6 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">تاريخ البداية من </label>
                                        <input v-model="form.start_date__from" type="date" class="form-control form-control-solid"  />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-5 fw-bold mb-2">تاريخ البداية إلى </label>
                                        <input v-model="form.start_date__to"  type="date" class="form-control form-control-solid"  />
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
                    :add-url="add_url.path"
                    :add-title="add_title"
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

                    <el-table-column align="right" label="البند" sortable  prop="name"  />
                    <el-table-column align="right" label=" المكان"  sortable prop="address"   />
                    <el-table-column align="right" label=" الأهمية" sortable  prop="priority.desc_ar" />
                    <el-table-column align="right" label=" تاريخ البداية" sortable  prop="start_date" />
                    <el-table-column align="right" label=" تاريخ النهاية "  sortable prop="end_date" />

                    <el-table-column align="right" label="تاريخ الاضافة"  sortable prop="created_at" />
                    <el-table-column fixed="right">
                        <template #default="scope">
                            <router-link v-show="can('agenda_edit')" :to="{name: 'editAgenda', params: { id: scope.row.id }}" class="btn btn-primary">
                                <i class="far fa-edit"></i>
                            </router-link>

                            <button v-show="can('agenda_delete')" class="btn btn-danger" @click.prevent="_delete(scope.row.id)" >
                                <i class="far fa-trash-alt"/>
                            </button>
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
import shared from "../../../../src/shared";
import api from "../../../../src/api";
import ActionButtons from "../../../_common/actionButtons";
export default {
    name: "reportsTeamsTable",
    components: {ActionButtons},
    data() {
        return {
            title: 'تقارير الفرق',
            add_title:' بند جديد',
            add_url: this.$router.resolve({name:'addAgenda'}),
            form:{},
            api_url: "/api/agenda",
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


