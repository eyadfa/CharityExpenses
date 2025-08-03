<template>
    <div  v-loading="loading" class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">
                <div  class="me-4 btn-group">
                    <button :disabled="!can('departments_search')" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fas fa-filter svg-icon-gray-500 me-1"> </span>
                        البحث
                    </button>
                    <div class="dropdown-menu w-450px w-md-500px" >
                        <div class="separator border-gray-200"></div>
                        <form method="post" id="departments_search_form" >
                            <div class="px-7 py-5">
                                <div class="row">
                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الاسم :</label>
                                        <input type="text" v-model="form.name_ar" class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> العنوان :</label>
                                        <input type="text" v-model="form.address" class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الهاتف :</label>
                                        <input type="text" v-model="form.phone" class="form-control form-control-solid"/>
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
                    add-perms="departments_add"
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
                    <el-table-column label="الاسم" prop="name_ar" />
                    <el-table-column label="الاسم English" prop="name_en" />
                    <el-table-column label="الوصف" prop="description" />
                    <el-table-column label="العنوان" prop="address" />
                    <el-table-column label="اسم المدير" prop="manager.full_name" />
                    <el-table-column label=" الحالة" >
                        <template #default="scope">
                            <el-button :disabled="!can('departments_activation')" v-if="scope.row.is_active ==1" @click.prevent="_deactivate(scope.row.id)" type="success">فعال</el-button>
                            <el-button :disabled="!can('departments_activation')" v-else @click.prevent="_activate(scope.row.id)" type="danger">غير فعال</el-button>
                        </template>
                    </el-table-column>
                    <el-table-column label=" تاريخ الاضافة" prop="created_at" />
                    <el-table-column fixed="right" label="Operations" >
                        <template #default="scope">
                            <div class="btn-group" role="group">
                                <router-link v-show="can('departments_edit')" :to="{name: 'editDepartment', params: { id: scope.row.id }}"
                                             class="btn btn-primary">
                                    <i class="far fa-edit"></i>
                                </router-link>
                                <button v-show="can('departments_delete')" class="btn btn-danger" @click="_delete(scope.row.id)">
                                    <i class="far fa-trash-alt" />
                                </button>

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
        name: "departmentsTable",
        components: {ActionButtons},
        data() {
            return {
                title: 'ادارة  الأقسام',
                add_title: ' قسم  جديد',
                add_url: this.$router.resolve({name: 'addDepartment'}),
                api_url:"/api/departments",
                results:[],
                form:{},
                total:0,
                currentPage:1,
                loading:false,
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
            _delete(_id){
                api._delete(_id)
            },
            async _activate(id) {
                await api.activate(id);
            },
            async _deactivate(id) {
                await api.deactivate(id);
            },

        },
    }
</script>


