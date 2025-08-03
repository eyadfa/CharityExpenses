<template>
    <div class="card card-xl-stretch mb-5 " v-loading="loading">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block ">

                <div  class="me-4 btn-group">
                    <button :disabled="!can('system_settings_search')" aria-expanded="false"
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
                                        <label class="form-label fw-bold"> المفتاح:</label>
                                        <input v-model="form.key" class="form-control form-control-solid"
                                               type="text"/>
                                    </div>
                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الوصف:</label>
                                        <input v-model="form.notes" class="form-control form-control-solid"
                                               type="text"/>
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
                                    <button class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true"
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


            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">


            <div class="overflow-auto">
                <el-table id="print_div " :data="results" height="500" :stripe="true" style="width: 100%">
                    <el-table-column label="المفتاح" prop="key" />
                    <el-table-column label="القيمة" prop="value" />
                    <el-table-column label="الوصف" prop="notes" />
                    <el-table-column label=" الحالة" >
                        <template #default="scope">
                            <el-button :disabled="!can('system_settings__activation')" v-if="scope.row.is_active ==1" @click.prevent="_deactivate(scope.row.id)" type="success">فعال</el-button>
                            <el-button :disabled="!can('system_settings__activation')" v-else @click.prevent="_activate(scope.row.id)" type="danger">غير فعال</el-button>
                        </template>
                    </el-table-column>
                    <el-table-column label=" تاريخ الاضافة" prop="created_at" />
                    <el-table-column fixed="right" label="Operations" >
                        <template #default="scope">
                            <div class="btn-group" role="group">
                                <router-link v-show="can('system_settings_edit')" :to="{name: 'editSettings', params: { id: scope.row.id }}"
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
export default {
    name: "appSettings",
    data() {
        return {
            title: 'ادارة اعدادات النظام',
            add_title: 'قيمة جديدة',
            form:{},
            api_url: "/api/settings",
            loading:false,
            total: 0,
            results:[],
            currentPage:1,
        }
    },

    created() {
        api.vw=this;
        this.search();
    },
    methods: {
        async _activate(id) {
            await api.activate(id);
        },
        async _deactivate(id) {
            await api.deactivate(id);
        },
        async search(next) {
            await api.search(next);
        },
        print(){
            shared.print("print_div");
        }
    },
}
</script>


