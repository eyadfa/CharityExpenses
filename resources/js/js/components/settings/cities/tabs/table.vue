<template>
    <div v-loading="loading" class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">

            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">  {{ title }}</span>
            </h3>
            <div class="card-toolbar col-12 d-block">
                <div  class="me-4 btn-group">
                    <button :disabled="!can('cities_search')" aria-expanded="false"
                            class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder dropdown-toggle" data-bs-toggle="dropdown" type="button">
                        <span class="fas fa-filter svg-icon-gray-500 me-1"> </span>
                        البحث
                    </button>
                    <div class="dropdown-menu  w-450px w-md-500px">
                        <div class="separator border-gray-200"></div>
                        <form id="departments_search_form" method="post">
                            <div class="px-7 py-5">
                                <div class="row">

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الدولة:</label>
                                        <select v-model="form.country_id" class="form-select form-select-solid"
                                                data-placeholder="اختر...">
                                            <option value="-1">الكل</option>
                                            <option v-for="c in countries" :value="c.id">{{ c.name }}</option>
                                        </select>
                                    </div>

                                    <div class="mb-10 col-md-6">
                                        <label class="form-label fw-bold"> الاسم:</label>
                                        <input v-model="form.name" class="form-control form-control-solid" type="text"/>
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

                <action-buttons
                    :add-url="add_url.path"
                    :add-title="add_title"
                    :show-print="false"
                    :show-export-to-excel="false"
                    add-perms="cities_add"
                />


            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->

        <div class="card-body py-3">
            <div class="flex flex-content-center">
                <div class="col-md-10 d-flex justify-content-center">
                    <div class="bg-light-primary ps-5 pt-3 pe-5 border-dashed border border-primary rounded  ">
                        <label class="form-label fw-boldest"> عدد السجلات :</label>
                        <label class="form-label fw-boldest"> {{ total }}</label>
                    </div>
                </div>
            </div>

            <div class="overflow-auto">
                <el-table :data="results" height="500" stripe style="width: 100%">
                    <el-table-column label="الدولة" prop="country.name"/>
                    <el-table-column label="المدينة" prop="name"/>
                    <el-table-column label=" عاصمة">
                        <template #default="scope">
                            <span v-if="scope.row.capital" class="badge rounded-pill bg-success text-light">
                                <i class="fas fa-check text-light"></i>
                            </span>
                        </template>
                    </el-table-column>
                    <el-table-column label=" الحالة">
                        <template #default="scope">
                            <el-button :disabled="!can('cities_activation')"  v-if="scope.row.is_active ==1" type="success"
                                       @click.prevent="_deactivate(scope.row.id)">فعال
                            </el-button>
                            <el-button :disabled="!can('cities_activation')" v-else type="danger" @click.prevent="_activate(scope.row.id)">غير فعال
                            </el-button>
                        </template>
                    </el-table-column>
                    <el-table-column label=" تاريخ الاضافة" prop="created_at"/>
                    <el-table-column fixed="right" label="Operations">
                        <template #default="scope">
                            <div class="btn-group" role="group">
                                <router-link v-show="can('cities_edit')"  :to="{name: 'editCity', params: { id: scope.row.id }}"
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
    name: "citiesTable",
    components: {ActionButtons},
    data() {
        return {
            title: 'ادارة بيانات المدن',
            add_title: 'مدينة جديدة',
            add_url: this.$router.resolve({name: 'addCity'}),
            results: [],
            form: {},
            api_url: "/api/cities",
            countries: [],
            currentPage: 1,
            loading: false,
            total: 0,

        }
    },
    async created() {
        api.vw=this;
        this.countries = await shared.countries()
        await this.search();
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
    },
}
</script>


