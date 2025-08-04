<template>

    <div v-loading="loading" class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <div class="row mb-5">


                        <div class="col-md-5 fv-row">
                            <label class="required fs-5 fw-bold mb-2"> الفريق</label>
                            <el-select v-model="form.name" filterable placeholder="اختر..." class="form-control" >
                                <el-option
                                    v-for="item in teams"
                                    :key="item.id"
                                    :label="item.full_name"
                                    :value="item"
                                />
                            </el-select>
                            <span v-for="error of v$.form.name.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                        </div>

                        <div class="col-md-5 fv-row">
                            <label class="required fs-5 fw-bold mb-2"> الملف</label>
                            <file-upload max-size="5"/>
                            <span v-for="error of v$.form.address.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                <p>{{ msg(error) }}</p>
                            </span>
                        </div>
                        <div class="d-flex flex-center">
                            <button class="btn btn-primary" type="submit" @click.prevent="submit()">
                                <span class="indicator-label">حفظ</span>
                            </button>
                            <button class="btn btn-light me-3" @click.prevent="$router.back()">تراجع</button>
                        </div>
                    </div>
                </div>

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

                            <el-table-column align="right" label="الفريق" sortable  prop="name"  />
                            <el-table-column align="right" label="بند المصروف" sortable  prop="name"  />
                            <el-table-column align="right" label=" سعر الوحدة"  sortable prop="address"   />
                            <el-table-column align="right" label=" المبلغ" sortable  prop="priority.desc_ar" />
                            <el-table-column align="right" label=" العملة" sortable  prop="start_date" />
                            <el-table-column align="right" label="سعر الصرف"  sortable prop="end_date" />
                            <el-table-column align="right" label="المبلغ الاجمالي "  sortable prop="end_date" />
                            <el-table-column align="right" label="تاريخ الصرف "  sortable prop="end_date" />
                            <el-table-column align="right" label=" طريقة الصرف"  sortable prop="end_date" />
                            <el-table-column align="right" label=" ملاحظات"  sortable prop="created_at" />
                            <el-table-column align="right" label="تم الادخال بواسطة"  sortable prop="created_at" />
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
            </div>
        </div>
    </div>

</template>


<script>
import shared from "../../src/shared";
import api from "../../src/api";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import CodeSelect from "../_common/codeSelect";
import ValidationServerErrors from "../_common/ValidationServerErrors";
import {Files} from "@element-plus/icons-vue";
import FileUpload from "../_common/FileUpload";

export default {
    name: "importExpensesForm",
    components: {FileUpload, Files, ValidationServerErrors, CodeSelect},
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    validations() {
        return {
            form: {
                name: {required},
                address: {required},
                priority_cd: {required},
                start_date: {required},
                end_date: {required},
                details: {required},
            }
        }
    },
    data() {
        return {
            title: "استيراد ملف المصروفات",
            form: {},
            edit_route: "editُExpenses",
            loading: false,
            api_url: "/api/expenses",
            errors:[],
            teams:[],
        }
    },
    async created() {
        api.vw = this;
        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.form = await api.show(this.$route.params.id)
        }
    },
    methods: {
        async submit() {
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            if (this.$router.currentRoute.value.name === this.edit_route) {
                await api.update();
            } else {
                await api.store();
            }
        },
    },

}
</script>


