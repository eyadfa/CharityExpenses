<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
                <div class="card-toolbar col-12 d-block">

                    <div class="me-4 btn-group" >
                        <button class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fas fa-filter svg-icon-gray-500 me-1"></span>
                            البحث
                        </button>
                        <div class="dropdown-menu w-450px w-md-500px" >

                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <form method="post" id="departments_search_form" >
                                <div class="px-7 py-5">

                                    <div class="row">

                                        <div class="mb-10 col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">  العنوان:</label>
                                            <!--end::Label-->
                                            <input type="text" v-model="form.title" class="form-control form-control-solid"/>

                                        </div>


                                        <div class="mb-10 col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">  الرابط:</label>
                                            <!--end::Label-->
                                            <input type="text" v-model="form.related_url" class="form-control form-control-solid"/>

                                        </div>



                                        <div class="mb-10 col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">الحالة :</label>
                                            <!--end::Label-->
                                            <select v-model="form.status" class="form-select form-select-solid">
                                                <option value="-1">الكل</option>
                                                <option value="0">جديد</option>
                                                <option value="1">تمت قرائته</option>
                                            </select>
                                        </div>

                                    </div>
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">تفريغ</button>
                                        <button type="submit"  @click.prevent="search"  class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">بحث</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
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
                    <el-table-column label="العنوان" prop="title" />
                    <el-table-column label="الرابط"  >
                        <template #default="scope">
                            <div class="btn-group" role="group">

                                <button class="btn btn-info" @click="_read(scope.row)">
                                    عرض الرابط
                                </button>

                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column label="التفاصيل" prop="body" />
                    <el-table-column label="تاريخ الارسال" prop="created_at" />
                    <el-table-column label=" الحالة" >
                        <template #default="scope">
                            <el-button v-if="scope.row.status ==1"  type="success">تمت قرائته</el-button>
                            <el-button v-else  type="danger">جديد</el-button>
                        </template>
                    </el-table-column>
                    <el-table-column label=" تاريخ الحالة" prop="updated_at" />

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
import shared from "../../../../src/shared";

export default {
    name: "notificationsTable",
    data() {
        return {
            title: 'التنبيهات  ',
            api_url:"/api/notifications",
            results:[],
            form:{status:-1},
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
        async _read(c){
          await shared.post("/api/notifications/seen" , {id:c.id});
          window.location.href=c.related_url;
        },
    },
}
</script>


