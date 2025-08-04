<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">

                <div  class="me-4 btn-group" >
                    <button :disabled="!can('permissions_search')" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                        البحث
                    </button>
                    <div class="dropdown-menu w-450px w-md-500px" >

                        <div class="separator border-gray-200"></div>
                        <form method="post" id="departments_search_form" >
                            <div class="px-7 py-5">

                                <div class="row">

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الاسم :</label>
                                        <input type="text" v-model="form.title" class="form-control form-control-solid"/>
                                    </div>


                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">تفريغ</button>
                                    <button type="submit" @click.prevent="search()" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">بحث</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <action-buttons
                    :add-url="add_url.path"
                    :add-title="add_title"
                    :show-print="false"
                    :show-export-to-excel="false"
                    add-perms="permissions_add"
                />


            </div>
        </div>
        <!--end::Header-->
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
                <el-table :data="results" height="500" :stripe="true" style="width: 100%">
                    <el-table-column label="النموذج الرئيسي" prop="controller.name" />
                    <el-table-column label="النموذج الفرعي" prop="page.name" />
                    <el-table-column label="الاسم" prop="title" />
                    <el-table-column label="التوظيح" prop="caption" />
                    <el-table-column label=" تاريخ الاضافة" prop="created_at" />
                    <el-table-column fixed="right" label="---" >
                        <template #default="scope">
                            <div class="btn-group" role="group">
                                <router-link v-show="can('permissions_edit')" :to="{name: 'editPermission', params: { id: scope.row.id }}"
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
    </div>
</template>

<script>

    import api from "../../../../src/api";
    import ActionButtons from "../../../_common/actionButtons";

    export default {
        name: "permissionsTable",
        components: {ActionButtons},
        data() {
            return {
                title: 'ادارة الصلاحيات ',
                add_title: 'صلاحية جديدة',
                add_url: this.$router.resolve({name: 'addPermission'}),
                api_url:"/api/permissions",
                results:[],
                total:0,
                form:{}
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
    }

}
</script>


