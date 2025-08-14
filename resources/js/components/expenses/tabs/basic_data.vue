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


                        <div class="col-md-4 fv-row">
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
                        <div class="col-md-4 fv-row">
                            <label class="required fs-5 fw-bold mb-2"> الجهة المرتبطة</label>
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

                        <div class="col-md-4 fv-row">
                            <code-select v-model:sub_cd="form.priority_cd" :main_cd="4" title="بند المصروف"/>
                            <span v-for="error of v$.form.priority_cd.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                        </div>


                        <div class="col-md-4 fv-row">
                            <label class="required fs-5 fw-bold mb-2">المبلغ الاجمالي بالشيكل</label>
                            <input disabled v-model="form.address" class="form-control form-control-solid" type="number"/>
                            <span v-for="error of v$.form.address.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                <p>{{ msg(error) }}</p>
                            </span>
                        </div>



                        <div class="col-md-4 fv-row">
                            <label class="required fs-5 fw-bold mb-2"> تاريخ الصرف </label>
                            <input v-model="form.start_date" class="form-control form-control-solid"
                                   type="date"/>
                            <span v-for="error of v$.form.start_date.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                        </div>
                        <div class="col-md-4 fv-row">
                            <code-select v-model:sub_cd="form.priority_cd" :main_cd="8" title="نوع الصرف"/>
                            <span v-for="error of v$.form.address.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                <p>{{ msg(error) }}</p>
                            </span>
                        </div>


                        <div class="col-md-8 fv-row">
                            <label class="fs-5 fw-bold mb-2"> ملاحظات</label>
                            <textarea v-model="form.notes" class="form-control form-control-solid" rows="3"></textarea>
                        </div>
                        <div class="col-md-8 fv-row">
                            <label class="fs-5 fw-bold mb-2"> الفاتورة</label>
                            <file-upload ></file-upload>
                        </div>
                    </div>


                    <div v-show="!wizard" class="d-flex flex-center">
                        <button class="btn btn-primary" type="submit" @click.prevent="submit()">
                            <span class="indicator-label">حفظ</span>
                        </button>
                        <button class="btn btn-light me-3" @click.prevent="$router.back()">تراجع</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
import shared from "../../../src/shared";
import api from "../../../src/api";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import CodeSelect from "../../_common/codeSelect";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
import FileUpload from "../../_common/FileUpload";

export default {
    name: "expensesBasicDataForm",
    components: {FileUpload, ValidationServerErrors, CodeSelect},
    props: {
        wizard:{
            type:Boolean,
            default:false,
        },
    },
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
                currency_cd: {required},
                exchange: {required},
                amount: {required},
            }
        }
    },
    data() {
        return {
            title: "البيانات الأساسية",
            form: {currency_cd:1,exchange: 1, amount:1},
            edit_route: "editAgenda",
            loading: false,
            api_url: "/api/agenda",
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


