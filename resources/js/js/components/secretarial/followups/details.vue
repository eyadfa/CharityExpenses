<template>

    <div class="row gy-5 g-xl-9">
        <div class="col-8">

            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ form.title }} </h2>

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                                @click.prevent="$router.back()">
                            <i class="fa-sharp fa-solid fas fa-arrow-left"></i>
                        </button>

                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <div class="card-body">


                    <div class="row mb-5">


                        <div class="col-md-3 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7">تاريخ البداية </span>
                            <span class=" fw-bold d-block fs-6">{{ form.created_at }} </span>
                        </div>
                        <div class="col-md-3 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7">تاريخ الاستحقاق </span>
                            <span class=" fw-bold d-block fs-6">{{ form.due_date }} </span>
                        </div>

                        <div class="col-md-3 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7">متعلق بــ </span>
                            <span class=" fw-bold d-block fs-6">{{ form.related.desc_ar }} </span>
                        </div>

                        <div class="col-md-3 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7">مصدر التكليف</span>
                            <span class=" fw-bold d-block fs-6">{{ form.sourcex.desc_ar }} </span>
                        </div>
                        <hr/>

                        <div class="col-md-6 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7"> تم التكليف بواسطة </span>
                            <span class=" fw-bold d-block fs-6">{{ form.commissioner }} </span>
                        </div>
                        <div class="col-md-3 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7"> الحالة </span>
                            <span class=" fw-bold d-block fs-6">
                                    <span v-if="form.is_finished" class="badge rounded-pill bg-light-dark">مغلق</span>
                                    <span v-else class="badge rounded-pill bg-warning">جار العمل</span>
                                </span>
                        </div>

                        <div class="col-md-3 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7">تاريخ الاغلاق </span>
                            <span class=" fw-bold d-block fs-6">{{ form.finished_at }} </span>
                        </div>
                        <hr/>
                        <div class="col-md-12 fv-row">
                            <span class="text-muted fw-bolder d-block fs-7"> التفاصيل </span>
                            <span class=" fw-bold d-block fs-6">{{ form.details }} </span>
                        </div>


                    </div>

                </div>
            </div>

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
                            <tr v-for="(item, index) in form.attachments" :key="index">
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
                                    <button v-show="can('followup_attachment_view')" class="btn btn-sm col-6" @click.prevent="download(item.path)">
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
                <div v-show="!form.is_finished && can('followup_attachment_add')" class="card-footer pt-5">
                    <label> المرفقات:</label>
                    <div class="row">
                        <div class="col-md-3 fv-row">
                            <label class="required fs-5 fw-bold mb-2">الملف</label>
                            <input class="form-control form-control-solid" type="file"
                                   @change="handleFileChange($event)"/>
                            <span v-show="errors.file != ''" class="text-danger fw-light">
                                        <p>{{ errors.file }}</p>
                                    </span>
                        </div>
                        <div class="col-md-8 fv-row">
                            <label class="required fs-5 fw-bold mb-2">الوصف</label>
                            <input v-model="file_desc" class="form-control form-control-solid" type="text"/>
                            <span v-show="errors.file_desc != ''" class="text-danger fw-light">
                                        <p>{{ errors.file_desc }}</p>
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


            <div class="card mt-5">
                <div class="card-header card-header-stretch">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800"> ملاحظات</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                    </h3>
                </div>
                <div class="card-body">


                    <div class="row mb-5">

                        <!--begin::Table-->
                        <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-150px text-start"></th>
                                <th class="p-0 pb-3 min-w-150px text-start"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr v-for=" r in form.replies">
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ r.note }}</a>
                                            <span
                                                class="text-gray-400 fw-semibold d-block fs-7 text-start">{{ r.creator.name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-0 pb-3 w-50px text-end text-gray-400">
                                    {{ r.created_at }}
                                </td>

                            </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                        <hr/>

                    </div>
                    <div v-show="!form.is_finished && can('followup_add_note')">
                            <div class="col-md-12 fv-row" >
                                    <textarea v-model="form_reply.note" class="form-control form-control-solid"
                                              rows="3"></textarea>
                            </div>
                            <div class="d-flex flex-end"  >
                                <button   class="btn btn-success" type="submit" @click.prevent="reply">
                                    <span class="indicator-label">اضافة</span>
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">

            <div class="card card-flush ">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800"> المكلف بالمتابعة</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->

                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-6">

                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">

                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ form.follower.full_name }}</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7"></span>
                                        </div>
                                    </div>
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
            </div>

            <div class="card mt-5">
                <div class="card-header card-header-stretch">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">  انهاء المهمة </span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                    </h3>
                </div>
                <div class="card-body">
                    <div v-show="form.is_finished == 1" class="row mb-5">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-striped align-middle gs-0 gy-3 my-0">
                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ form.finish_note}} </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="text-gray-400 fw-semibold d-block fs-7">{{  form.finished_at}}</span>
                                </td>
                            </tr>


                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                        <!--end::Table-->
                    </div>
                    <hr/>

                    <div  class="row mb-5">
                        <div  class="col-md-12 fv-row">
                            <label class="form-label fw-bold"> تعليق الاغلاق:</label>
                            <textarea class="form-control form-control-solid" rows="3" v-model="form_finish.note"></textarea>
                        </div>
                        <div v-show="!form.is_finished  && can('followup_close')" class="d-flex flex-end">
                            <button class="btn btn-success" type="submit" @click.prevent="finish">
                                <span class="indicator-label"> اغلاق/ انهاء المتابعة</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</template>


<script>

import shared from "../../../src/shared";
import api from "../../../src/api";

export default {
    name: "followupDetails",
    data() {
        return {
            title: "تفاصيل المتابعة",
            form: {related:{}, sourcex:{}, follower:{}},
            api_add_attachment: "/api/followup/attachment/",
            file: null,
            form_finish: {"note": ""},
            form_reply: {"reply": ""},
            replies: [],
            errors:{},
            base_route: "followups",
            api_url: "/api/followups"
        }
    },
    async created() {
        api.vw=this;
        this.form  = (await api.show(this.$route.params.id))
        console.log(this.form.attachments)
    },

    methods: {
        download(attachment_path) {
            shared.download(attachment_path)
        },
        reply() {
            this.form_reply.id = this.$route.params.id;
            api.reply(this.form_reply);
        },
        finish() {
            this.form_finish.id = this.$route.params.id;
            api.finish(this.form_finish);
        },

        async addAttachment() {
            this.errors = {file: "", file_desc: "", emp_name: ""}
            let f = false;
            if (this.file == null) {
                this.errors.file = "يجب اختيار ملف";
                f = true;
            }
            if (this.file_desc == null || this.file_desc == "") {
                this.errors.file_desc = "هذا الحقل مطلوب";
                f = true;
            }
            if (f) {
                return;
            }

            let formData = new FormData();
            formData.append("fileToUpload", this.file);
            formData.append("file_desc", this.file_desc);

            let res =  await shared.storeMultiPart(this.api_add_attachment + `${this.$route.params.id}` ,formData)
            if(res.status){
                shared.success("تم حفظ المرفق بنجاح")
                this.form.attachments = res.data;
                this.file_desc == "";
            }

        },


        handleFileChange(e) {
            // Check if file is selected
            this.file = null;
            if (e.target.files && e.target.files[0]) {
                // Get uploaded file
                const file = e.target.files[0];
                this.file = file;
            }
        },

    },

}
</script>


