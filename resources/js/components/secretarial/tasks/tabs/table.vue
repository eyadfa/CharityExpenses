<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">

            <div class="me-4 btn-group">
                <button :disabled="!can('tasks_search')" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                    <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                    البحث
                </button>
                    <div class="dropdown-menu w-800px w-md-800px" >
                        <div class="separator border-gray-200"></div>
                        <form method="post"  >
                            <div class="px-7 py-5">

                                <div class="row">

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">  العنوان:</label>
                                        <input type="text" v-model="form.title" class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">  التفاصيل :</label>
                                        <input type="text" v-model="form.details"  class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-3">
                                        <code-select :main_cd="116" title="مصدر التكليف" v-model:sub_cd="form.commissioning_source_cd"
                                                     :is_searchable="true" :is_required="false" />
                                    </div>

                                    <div class="mb-10 col-md-3">
                                        <code-select :main_cd="113" v-model:sub_cd="form.priority_cd" title="الأولوية"
                                                     :is_searchable="true" :is_required="false"/>
                                    </div>
                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold">  تم التكليف بواسطة:</label>
                                        <input type="text" v-model="form.commissioner"  class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold">  الحالة:</label>
                                        <select v-model="form.is_finished"  class="form-select form-select-solid">
                                            <option value="-1">الكل</option>
                                            <option value="1">منجز</option>
                                            <option value="0">غير منجز</option>
                                        </select>
                                    </div>


                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold"> تاريخ البداية- من  :</label>
                                        <input type="date" v-model="form.start_date__from"  class="form-control form-control-solid"/>
                                    </div>
                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold"> تاريخ البداية- الى  :</label>
                                        <input type="date" v-model="form.start_date__to"  class="form-control form-control-solid"/>
                                    </div>


                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold"> تاريخ الاستحقاق- من  :</label>
                                        <input type="date" v-model="form.due_date__from"  class="form-control form-control-solid"/>
                                    </div>
                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold"> تاريخ الاستحقاق- الى  :</label>
                                        <input type="date" v-model="form.due_date__to"  class="form-control form-control-solid"/>
                                    </div>


                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold"> تاريخ الاغلاق- من  :</label>
                                        <input type="date" v-model="form.finished_at__from"  class="form-control form-control-solid"/>
                                    </div>
                                    <div class="mb-10 col-md-3">
                                        <label class="form-label fw-bold"> تاريخ الاغلاق- الى  :</label>
                                        <input type="date" v-model="form.finished_at__to"  class="form-control form-control-solid"/>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">تفريغ</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true" @click.prevent="search">بحث</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <action-buttons
                    :add-title="add_title"
                    :add-url="add_url.path"
                    :show-print="false"
                    :export-to-excel-action="exportToExcel"
                    add-perms="tasks_add"
                    export-to-excel-perms="tasks_export_to_excel"
                />


            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="flex flex-content-center">
            <div class="col-md-10 d-flex justify-content-center">
                <div class="bg-light-primary ps-5 pt-3 pe-5 border-dashed border border-primary rounded  ">
                    <label class="form-label fw-boldest">   عدد  السجلات :</label>
                    <label class="form-label fw-boldest">   {{ total }}</label>
                </div>
            </div>
        </div>
        <div class="card-body py-3">
                <el-table :data="results" stripe="true" height="250" style="width: 100%">
                    <el-table-column prop="title" label="العنوان"  />
                    <el-table-column prop="details" label="التفاصيل"/>
                    <el-table-column prop="start_date" label="تاريخ البداية" width="120" />
                    <el-table-column prop="due_date" label="تاريخ الاستحقاق" width="120" />
                    <el-table-column prop="finished_at" label="تاريخ الاغلاق" width="120" />
                    <el-table-column prop="priority.desc_ar" label=" الأهمية" width="120" />
                    <el-table-column prop="priority.desc_ar" label=" الحالة" width="120" >
                        <template #default="scope">
                            <span  v-if="scope.row.is_finished" class="badge rounded-pill bg-success">منجز</span>
                            <span v-else class="badge rounded-pill bg-warning"> غير منجز</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="creator.name" label=" أنشأت بواسطة" width="120" />
                    <el-table-column prop="source.desc_ar" label=" مصدر التكليف" width="120" />
                    <el-table-column prop="commissioner" label=" تم التكليف بواسطة" width="120" />
                    <el-table-column prop="created_at" label=" تاريخ الانشاء" width="120" />
                    <el-table-column fixed="right" label="Operations" width="120" >
                        <template #default="scope">
                            <div class="btn-group" role="group">
                                <router-link  v-show="!scope.row.is_finished && can('tasks_edit')" :to="{name: 'editTask', params: { id: scope.row.id }}" class="btn btn-primary">
                                    <i class="far fa-edit"></i>
                                </router-link>

                                <router-link v-show="can('taks_handle')" :to="{name: 'taskDetails', params: { id: scope.row.id }}" class="btn btn-warning">
                                    <i class="fas fa-cogs"></i>
                                </router-link>

                            </div>
                        </template>
                    </el-table-column>
                </el-table>
        </div>
        <!--begin::Body-->
    </div>
    <div class="overflow-auto">


        <el-divider></el-divider>

        <div class="d-flex flex-center">
            <el-pagination
                style="direction: ltr"
                background
                layout="prev, pager, next"
                @current-change="search(1)"
                :page-size="100"
                :total="total">
            </el-pagination>
        </div>
    </div>
</template>

<script>

import CodeSelect from "../../../_common/codeSelect";
import api from "../../../../src/api";
import ActionButtons from "../../../_common/actionButtons";
export default {
    name: "tasksTable",
    components: {ActionButtons, CodeSelect},
    data() {
        return {
            title: 'ادارة المهام ',
            add_title:'مهمة جديدة',
            form: {is_finished: -1,commissioning_source_cd:-1,priority_cd:-1},
            results: [],
            add_url: this.$router.resolve({name: 'addTask'}),
            api_url: "/api/tasks",
            currentPage: 1,
            total:0,
        }

    },
    created() {
        api.vw=this;
        this.search();
    },

    methods: {
        search(next) {
            api.search(next)
        },
        exportToExcel() {
            api.exportToExcel()
        },


    }
}
</script>


