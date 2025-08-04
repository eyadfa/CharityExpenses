<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">

                <div class="me-4 btn-group" >
                    <button  :disabled="!can('users_search')" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                        البحث
                    </button>
                    <div class="dropdown-menu w-450px w-md-500px" >

                        <div class="separator border-gray-200"></div>
                        <form method="post" id="departments_search_form" >
                            <div class="px-7 py-5">
                                <div class="row">

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الاسم:</label>
                                        <input type="text" v-model="form.name" class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">  اسم المستخدم:</label>
                                        <input type="text" v-model="form.email" class="form-control form-control-solid"/>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold">  القسم :</label>
                                        <select v-model="form.department_id" class="form-select form-select-solid">
                                            <option value="-1" selected>الكل</option>
                                            <option v-for="f of departments" :value="f.id">{{ f.name_ar}}</option>
                                        </select>
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
                add-perms="users_add"
            />


            </div>
        </div>
        <!--end::Header-->

        <div class="card-body py-3">
            <validation-server-errors :errors="errors" />
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
                    <el-table-column label="الاسم" prop="name" sortable/>
                    <el-table-column label="اسم المستخدم" prop="email" />
                    <el-table-column label="القسم" prop="department.name_ar" sortable />
                    <el-table-column label="الرقم الوظيفي " prop="related_emp_id" />
                    <el-table-column label=" الحالة" >
                        <template #default="scope">
                            <el-button :disabled="!can('users_activation')" v-if="scope.row.is_active ==1" @click.prevent="_deactivate(scope.row.id)" type="success">فعال</el-button>
                            <el-button :disabled="!can('users_activation')" v-else @click.prevent="_activate(scope.row.id)" type="danger">غير فعال</el-button>
                        </template>
                    </el-table-column>
                    <el-table-column label=" تاريخ الاضافة" prop="created_at" />
                    <el-table-column fixed="right" label="Operations" >
                        <template #default="scope">
                            <el-dropdown trigger="click">
                                <span class="el-dropdown-link btn btn-secondary btn-icon">
                                   <i class="fas fa-cogs"></i>
                                </span>
                                <template #dropdown #default="z">
                                    <el-dropdown-menu>

                                        <el-dropdown-item v-if="can('users_edit')"  >
                                            <router-link :to="{name: 'editUser', params: { id: scope.row.id }}" >
                                                 تعديل
                                            </router-link>

                                        </el-dropdown-item>

                                        <el-dropdown-item v-if="can('users_permissions')">
                                            <router-link :to="{name: 'userPermissions', params: { id: scope.row.id }}" >
                                                صلاحيات المستخدم
                                            </router-link>
                                        </el-dropdown-item>


                                        <el-dropdown-item v-if="can('users_change_password')">
                                            <a class="text-primary"  @click="_changePassword(scope.row.id)">
                                                 تغيير كلمة المرور
                                            </a>
                                        </el-dropdown-item>

                                        <el-dropdown-item v-if="can('users_delete')">
                                            <a  class="text-danger" @click="_delete(scope.row.id)">
                                                حذف
                                            </a>
                                        </el-dropdown-item>


                                    </el-dropdown-menu>
                                </template>
                            </el-dropdown>
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

    import CodeSelect from "../../../_common/codeSelect";
    import shared from "../../../../src/shared";
    import api from "../../../../src/api";
    import {ElMessageBox} from "element-plus";
    import ValidationServerErrors from "../../../_common/ValidationServerErrors";
    import ActionButtons from "../../../_common/actionButtons";
    export default {
        name: "functions",
        components: {ActionButtons, ValidationServerErrors, CodeSelect},
        data() {
            return {
                title: 'ادارة  المستخدمين',
                add_title: ' مستخدم  جديد',
                api_url:"/api/users",
                add_url: this.$router.resolve({name: 'addUser'}),
                form:{contract_type:-1, user_position:-1, is_active:-1},
                results:[],
                departments:[],
                currentPage:1,
                total:0,
                errors:[],
            }
        },
       async created() {
            api.vw=this;
            this.departments = await shared.departments();
            this.search();
        },
        methods:{
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
            _changePassword(user_id){
                this.errors = [];
                ElMessageBox.prompt('الرجاء ادخال كلمة المرور الجديدة', 'تغيير كلمة المرور', {
                    confirmButtonText: 'تغيير كلمة المرور',
                    cancelButtonText: 'الغاء',
                    center:true,
                    inputErrorMessage: 'القيمة المدخلة غير صحيحة',
                })
                    .then(async ({value}) => {
                        var res =  await shared.post(this.api_url + "/change_password", {id: user_id, password: value});
                        if(res.status){
                            shared.success(res.message)
                        }else{
                            shared.alert(res.message);
                            this.errors= res.data;
                        }

                    })
                    .catch(() => {

                    })

            },
        }

    }
</script>


