<template>
    <div class="card card-flush mt-5 ">
        <!--begin::Header-->

        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800"> المرفقات</span>
                <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-6">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="p-0 pb-3 min-w-150px text-start">الاسم</th>
                        <th class="p-0 pb-3 min-w-150px text-start">تاريخ التحميل</th>
                        <th class="p-0 pb-3 min-w-150px text-start">تفاصيل</th>
                        <th class="p-0 pb-3 w-50px text-end">عرض</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    <tr v-for="(item, index) in attachments" :key="index">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                        {{ item.path }}</a>
                                    <span
                                        class="text-gray-400 fw-semibold d-block fs-7"> {{
                                            item.creator.name
                                        }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-start">{{ item.created_at }}</td>
                        <td class="text-start">{{ item.note }}</td>

                        <td class="text-end">
                            <button v-show="can('task_view_attachments')" class="btn btn-sm col-6" @click.prevent="download(item.path)">
                                <span class="fas fa-search "></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--end: Card Body-->
        <div v-show="!is_finished && can('tasks_add_attachemnts')" class="card-footer pt-5">
            <label> المرفقات:</label>
            <validation-server-errors :errors="errors" />
            <div class="row">
                <div class="col-md-3 fv-row">
                    <label class="required fs-5 fw-bold mb-2">الملف</label>
                    <input class="form-control form-control-solid" type="file"
                           @change="handleFileChange($event)"/>
                    <span v-for="error of v$.form.file.$errors"
                          :key="error.$uid" class="text-danger fw-light">
                        <p>{{ msg(error) }}</p>
                    </span>
                </div>
                <div class="col-md-8 fv-row">
                    <label class="required fs-5 fw-bold mb-2">الوصف</label>
                    <input v-model="form.file_desc" class="form-control form-control-solid" type="text"/>

                    <span v-for="error of v$.form.file_desc.$errors"
                          :key="error.$uid" class="text-danger fw-light">
                        <p>{{ msg(error) }}</p>
                    </span>
                </div>
                <div class="col-md-1 fv-row">
                    <button  class="btn btn-primary mt-10 btn-sm btn-icon"
                             @click.prevent="addAttachment"><span
                        class="fa fa-plus"></span></button>
                </div>
            </div>


        </div>

    </div>

</template>

<script>
import api from "../../../../src/api";
import shared from "../../../../src/shared";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import ValidationServerErrors from "../../../_common/ValidationServerErrors";

export default {
    name: "taskAttachments",
    components: {ValidationServerErrors},
    props:{
        is_finished: {
            type: Boolean,
            required: true
        },
        attachments: {
            type: Array,
            default: []
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
                file: {required},
                file_desc: {required},
            }
        }
    },
    data() {
        return {
            title: "مرفقات المهمة",
            form: {},
            api_url: "/api/tasks/attachment/",
            errors:[],
            attachments: this.attachments // Initialize local reactive property
        }
    },


    async created() {
    },

    methods: {
        download(attachment_path) {
            shared.download(attachment_path)
        },

        async addAttachment() {
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            let formData = new FormData();
            formData.append("fileToUpload", this.form.file);
            formData.append("file_desc", this.form.file_desc);

            let res =  await shared.storeMultiPart(this.api_url + `${this.$route.params.id}` ,formData)
            if(res.status){
                shared.success("تم حفظ المرفق بنجاح")
                this.attachments = res.data;
                this.form = {};
            }
            this.v$.form.$reset();

        },


        handleFileChange(e) {
            // Check if file is selected
            if (e.target.files && e.target.files[0]) {
                // Get uploaded file
                const file = e.target.files[0];
                this.form.file = file;
            }
        },


    },

}
</script>


