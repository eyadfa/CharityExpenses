<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">

                <div class="row mb-5">


                    <div class="col-md-5 fv-row">
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
                        <code-select v-model:sub_cd="form.priority_cd" :main_cd="113" title="بند المصروف"/>
                    </div>

                    <div class="col-md-5 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> الكمية</label>
                        <input v-model="form.address" class="form-control form-control-solid" type="number"/>
                    </div>

                    <div class="col-md-5 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> سعر الوحدة</label>
                        <input v-model="form.address" class="form-control form-control-solid" type="number"/>
                    </div>
                    <div class="col-md-5 fv-row">
                        <code-select v-model:sub_cd="form.priority_cd" :main_cd="113" title="العملة"/>
                    </div>


                    <div class="col-md-5 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> سعر الصرف</label>
                        <input v-model="form.address" class="form-control form-control-solid" type="number"/>
                    </div>

                    <div class="col-md-5 fv-row">
                        <label class=" fs-5 fw-bold mb-2">المبلغ الكلي</label>
                        <input disabled v-model="form.address" class="form-control form-control-solid" type="number"/>
                    </div>



                    <div class="col-md-2 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> تاريخ الصرف </label>
                        <input v-model="form.start_date" class="form-control form-control-solid"
                               type="datetime-local"/>
                    </div>
                    <div class="col-md-5 fv-row">
                        <code-select v-model:sub_cd="form.priority_cd" :main_cd="113" title="نوع الصرف"/>
                    </div>

                    <div class="col-md-4 fv-row">
                        <label class="fs-5 fw-bold mb-2"> ملاحظات</label>
                        <textarea v-model="form.notes" class="form-control form-control-solid" rows="3"></textarea>
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
    name: "agendaTable",
    components: {ActionButtons},
    data() {
        return {
            title: 'تقرير المصروفات',
            add_title:' بند جديد',
            form:{},
            api_url: "/api/agenda",
            loading:false,
            total: 0,
            currentPage:1,
            results:[],
            teams:[],
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


