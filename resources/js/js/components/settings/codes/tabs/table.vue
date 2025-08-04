<template>
    <div class="card card-xl-stretch mb-5 " v-loading="loading">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block ">

                <div  class="me-4 btn-group">
                    <button :disabled="!can('codes_search')" aria-expanded="false"
                            class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle" data-bs-toggle="dropdown" type="button">
                        <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                        البحث
                    </button>
                    <div class="dropdown-menu w-450px w-md-500px">

                        <div class="separator border-gray-200"></div>
                        <form id="departments_search_form" method="post">
                            <div class="px-7 py-5">
                                <div class="row">

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">النموذج الرئيسي :</label>
                                        <select @change="setPages()" v-model="form.controller" class="form-select form-select-solid">
                                            <option value="-1">الكل</option>
                                            <option v-for="c in controllers" :value="c" >{{c.name}}</option>
                                        </select>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">النموذج الفرعي :</label>
                                        <select v-model="form.page_id" class="form-select form-select-solid">
                                            <option value="-1">الكل</option>
                                            <option v-for="c in pages" :value="c.id" >{{c.name}}</option>
                                        </select>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> اسم التصنيف:</label>
                                        <input v-model="form.desc_ar" class="form-control form-control-solid"
                                               type="text"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">الكود الرئيسي:</label>
                                        <input v-model="form.main_cd" class="form-control form-control-solid"
                                               type="number"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الكود الفرعي:</label>
                                        <input v-model="form.sub_cd" class="form-control form-control-solid"
                                               type="number"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">الحالة :</label>
                                        <select v-model="form.is_active" class="form-select form-select-solid">
                                            <option value="-1">الكل</option>
                                            <option value="0">غير فعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <button @click.prevent="form={}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true"
                                            type="reset">تفريغ
                                    </button>
                                    <button class="btn btn-sm btn-primary" data-kt-menu-dismiss="true" type="submit"
                                            @click.prevent="search()">بحث
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <action-buttons
                    :add-url="add_url.path"
                    :add-title="add_title"
                    add-perms="codes_store"
                    print-perms="codes_print"
                    export-to-excel-perms="codes_export_to_excel"
                    :export-to-excel-action="exportToExcel"
                    :print-action="print"
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

            <div class="overflow-auto">
                <el-table :data="results" id="data_table" height="500" stripe style="width: 100%">
                    <el-table-column label="النموذج الرئيسي" prop="controller.name" />
                    <el-table-column label="النموذج الفرعي" prop="page.name" />
                    <el-table-column label="التصنيف الرئيسي" prop="parent.desc_ar" />
                    <el-table-column label=" الكود الرئيسي" prop="main_cd" />
                    <el-table-column label=" الكود  الفرعي" prop="sub_cd" />
                    <el-table-column label="الاسم" prop="desc_ar" />
                    <el-table-column label=" الاسم English" prop="desc_en" />
                    <el-table-column label=" الحالة" >
                        <template #default="scope">
                            <el-button :disabled="!can('codes_activation')" v-if="scope.row.is_active ==1" @click.prevent="_deactivate(scope.row.id)" type="success">فعال</el-button>
                            <el-button :disabled="!can('codes_activation')" v-else @click.prevent="_activate(scope.row.id)" type="danger">غير فعال</el-button>
                        </template>
                    </el-table-column>
                    <el-table-column label=" تاريخ الاضافة" prop="created_at" />
                    <el-table-column fixed="right" label="Operations" >
                        <template #default="scope">
                            <div class="btn-group" role="group">
                                <router-link v-show="can('codes_edit')" :to="{name: 'editCode', params: { id: scope.row.id }}"
                                             class="btn btn-primary">
                                    <i class="far fa-edit"></i>
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
        </div>
        <!--begin::Body-->
    </div>
</template>

<script>

import shared from "../../../../src/shared";
import api from "../../../../src/api";
import ActionButtons from "../../../_common/actionButtons";

export default {
    name: "codesTable",
    components: {ActionButtons},
    data() {
        return {
            form: {controller_id:-1, page_id:-1,is_active:-1},
            results: [],
            title: 'ادارة ثوابت النظام',
            add_title: 'قيمة جديدة',
            add_url: this.$router.resolve({name: 'addCode'}),
            api_url:"/api/codes",
            currentPage: 1,
            loading:false,
            total: 0,
            controllers:[],
            pages:[],
        }
    },

    async created() {
        api.vw=this;
        this.controllers = (await shared.search("/api/controllers")).data;
        await this.search();
    },
    methods: {
        async _activate(id){
            await api.activate(id);
        },
        async _deactivate(id){
            await api.deactivate(id);
        },
        async search(next) {
            await api.search(next)
        },
        setPages(){
            this.form.controller_id =-1;
            this.pages=[];
            if(this.form.controller !== -1){
                this.form.controller_id= this.form.controller.id;
                this.pages= this.form.controller.functions;
            }
        },
        exportToExcel(){
            api.exportToExcel()
        },
        print(){
            shared.print("data_table");
        }
    },

}
</script>


