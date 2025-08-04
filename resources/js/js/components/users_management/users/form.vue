<template>

    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">

                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <form class="form" method="post"  enctype="multipart/form-data">

                        <div class="row mb-5">

                            <div class="col-md-9 row">
                                <div class="col-md-4 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">الاسم</label>
                                    <input type="text"  v-model="form.name" class="form-control form-control-solid" />
                                    <span class="text-danger fw-light" v-for="error of v$.form.name.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>

                                <div class="col-md-4 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">اسم المستخدم</label>
                                    <input type="text" v-model="form.email" class="form-control form-control-solid" />
                                    <span class="text-danger fw-light" v-for="error of v$.form.email.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>

                                <div class="col-md-4 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">الرقم الوظيفي </label>
                                    <el-select
                                        v-model="form.related_emp_id"
                                        filterable
                                        default-first-option
                                        :reserve-keyword="false"
                                        placeholder="الوصف الوظيفي" >
                                        <el-option
                                            v-for="item in employees"
                                            :key="item.id"
                                            :label="item.full_name"
                                            :value="item.id"
                                        />
                                    </el-select>
                                    <span class="text-danger fw-light" v-for="error of v$.form.related_emp_id.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>



                                <div class="col-md-4 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">القسم </label>
                                    <select v-model="form.department_id" class="form-select form-select-solid">
                                        <option value="-1">اختر القسم....</option>
                                        <option v-for="f of deps" :value="f.id">{{ f.name_ar}}</option>
                                    </select>
                                </div>

                                <div class="col-md-4 fv-row" v-if="!is_edit">
                                    <label class="required fs-5 fw-bold mb-2">كلمة المرور </label>
                                    <input type="password" v-model="form.password" class="form-control form-control-solid" />
                                    <span class="text-danger fw-light" v-for="error of v$.form.password.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>

                                <div class="col-md-4 fv-row" v-if="!is_edit">
                                    <label class="required fs-5 fw-bold mb-2">كلمة المرور مرة أخرى </label>
                                    <input type="password" v-model="form.repassword" class="form-control form-control-solid" />
                                    <span class="text-danger fw-light" v-for="error of v$.form.repassword.$errors" :key="error.$uid">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                                </div>

                                <div class="col-md-4 fv-row">
                                    <label class="required fs-5 fw-bold mb-2"> الحالة</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <span class="form-check-label fw-bold text-muted">غير فعال</span>
                                            <input class="form-check-input" v-model="form.is_active" type="checkbox" value="1"
                                                   checked="checked" />
                                            <span class="form-check-label fw-bold text-muted">فعال</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <file-upload ref="imgRef" accept="*" :max-size="5"
                                             @file-uploaded="setImage"></file-upload>
                                <span v-for="error of v$.form.file.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="d-flex flex-center">
                        <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                            <span class="indicator-label" :class="{'visually-hidden':loading}">حفظ</span>
                            <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
                            <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
                        </button>
                        <button @click.prevent="$router.back()" class="btn btn-light me-3">تراجع</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</template>



<script>

import { useVuelidate } from '@vuelidate/core'
import { required, minLength , sameAs , numeric } from '@vuelidate/validators'
import shared from "../../../src/shared";
import api from "../../../src/api";
import FileUpload from "../../_common/FileUpload";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
    export default {
        name: "users",
        components: {
            ValidationServerErrors,
            FileUpload
        },
        data(){
            return {
                title: "مستخدم جديد",
                loading:false,
                form: { is_active:true },
                edit_route:"editUser",
                base_route : "users",
                api_url: "/api/users",
                imageFile: null,
                isImageUploading: false,
                deps:[],
                employees:[],
                is_edit:false,
                errors:[],
            }
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
                    email: {required},
                    related_emp_id: {required},
                    password: this.is_edit? {} : {required , min:minLength(8)},
                    repassword:this.is_edit? {} : {required , same:sameAs(this.form.password)},
                    name: {required, min: minLength(3)},
                    file:this.is_edit? {} : {required},
                }
            }
        },
        async created() {
            api.vw=this;
            this.deps = await  shared.departments();
            this.employees = await shared.employees();
            if (this.$router.currentRoute.value.name === this.edit_route) {
                this.form = await shared.show(this.api_url, this.$route.params.id)
                this.$refs.imgRef.setImage(this.form.image_path)
                this.is_edit=true;
            }
        },
        methods: {
            async submit() {
                this.errors=[];
                this.v$.form.$touch();
                if (this.v$.form.$invalid) {
                    shared.alert("يوجد بيانات مفقودة");
                    return;
                }
                if (this.$router.currentRoute.value.name === this.edit_route) {
                    await api.updateMultiPart();
                } else {
                    await api.storeMultiPart();
                }
            },

            setImage(file) {
                this.file = file;
                this.form.file=file.file;
            }
        }

    }
</script>


<style scoped>
.np-image-preview {
    padding: 20px;
    background: #eee;
    border-radius: 16px;
    margin: 10px;
}

.np-image-upload-picker {
    padding: 20px;
    background: #eee;
    border-radius: 16px;
    margin: 10px;
}

img.np-preview {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 5px;
    height: 200px;
    border-radius: 16px;
    margin: 10px;
}
.np-upload-btn {
    margin: 10px;
    border: 0px !important;
    font-size: 18px;
    padding: 16px 60px !important;
    font-weight: 300;
    color: #fff;
    border-radius: 30px;
}

.np-upload-btn-confirm {
    background: rgb(0, 163, 73) !important;
}

.np-upload-btn-cancel {
    background: rgb(122, 0, 31) !important;
}

.np-upload-in-progress {
    background: #eee !important;
    margin: 10px;
    border: 0px !important;
    font-size: 18px;
    padding: 16px 60px !important;
    font-weight: 300;
    color: #000;
    border-radius: 30px;
}
</style>
