<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">

                    <validation-server-errors :errors="server_errors" />
                    <div class="row mb-5">

                        <div class="col-md-12 fv-row">
                            <label class="required fs-5 fw-bold mb-2">العنوان </label>
                            <input v-model="form.title" class="form-control form-control-solid" type="text"/>
                            <span v-for="error of v$.form.title.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                        </div>

                        <div class="col-md-2 fv-row">
                            <code-select :main_cd="116" v-model:sub_cd="form.commissioning_source_cd" title="مصدر التكليف"/>
                            <span v-for="error of v$.form.commissioning_source_cd.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                        </div>

                        <div class="col-md-3 fv-row">
                            <label class="required mb-2">الجهةالتي قامت بالتكليف </label>
                            <input v-model="form.commissioner" class="form-control form-control-solid" type="text"/>
                            <span v-for="error of v$.form.commissioner.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                        </div>

                        <div class="col-md-2 fv-row">
                            <label>تاريخ البداية:</label>
                            <input v-model="form.start_date" class="form-control form-control-solid" type="date"/>
                            <span v-for="error of v$.form.start_date.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                        </div>
                        <div class="col-md-2 fv-row">
                            <label>تاريخ الاستحقاق :</label>
                            <input v-model="form.due_date" class="form-control form-control-solid" type="date"/>
                            <span v-for="error of v$.form.due_date.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                        </div>

                        <div class="col-md-2 fv-row">
                            <code-select :main_cd="113" v-model:sub_cd="form.priority_cd" title="الأولوية"/>
                            <span v-for="error of v$.form.priority_cd.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                        </div>

                        <div class="col-md-12 fv-row">
                            <label class="required fs-5 fw-bold mb-2"> التفاصيل </label>
                            <textarea v-model="form.details" class="form-control form-control-solid"
                                      rows="5"></textarea>
                            <span v-for="error of v$.form.details.$errors"
                                  :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                        </div>
                        <div   v-show="!is_edit" class="col-md-6 fv-row border-gray-300 border-end-dashed border-gray-300 border-start-dashed">
                            <label> فريق العمل:</label>
                            <div class="row">
                                <div class="col-md-8 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">الاسم</label>
                                    <input v-show="!form.is_internal" v-model="emp.name" class="form-control form-control-solid "
                                           type="text"/>
                                    <select v-show="form.is_internal" v-model="emp.number" class="form-select form-select-solid">
                                        <option v-for="item in employees" :value="item" :key="item.id">{{ item.full_name}}</option>
                                    </select>
                                    <span v-show="errors.emp_name != ''" class="text-danger fw-light">
                                        <p>{{ errors.emp_name }}</p>
                                    </span>
                                </div>
                                <div class="col-2 pt-10">
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input v-model="form.is_internal" class="form-check-input h-20px w-20px"
                                               type="checkbox" value="true">
                                        <span class="form-check-label fw-bold">داخلي</span>
                                    </label>
                                </div>
                                <div class="col-md-2 ">
                                    <button class="btn btn-primary btn-icon mt-10 btn-sm " @click.prevent="addTeamMember">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>

                            <table class="table-striped table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>....</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in form.team" :key="item.id">
                                    <td>{{ item.participant_name}}</td>
                                    <td>
                                        <button class="btn btn-sm" @click.prevent="removeTeamMember(item.id)">
                                            <span class="fas fa-trash text-danger "></span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div v-show="!is_edit" class="col-md-6 fv-row border-gray-300 border-end-dashed ">
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
                                <div class="col-md-7 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">الوصف</label>
                                    <input v-model="file_desc" class="form-control form-control-solid" type="text"/>
                                    <span v-show="errors.file_desc != ''" class="text-danger fw-light">
                                        <p>{{ errors.file_desc }}</p>
                                    </span>
                                </div>
                                <div class="col-md-2 fv-row">
                                    <button class="btn btn-primary mt-10 btn-sm btn-icon"
                                            @click.prevent="addAttachment"><span
                                        class="fa fa-plus"></span></button>
                                </div>
                            </div>

                            <table class="table-striped table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th>الملف</th>
                                    <th>الوصف</th>
                                    <th>....</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="f in form.attachments" :key="f.id">
                                    <td>{{ f.file.name }}</td>
                                    <td>{{ f.desc }}</td>
                                    <td>
                                        <div class="row">
                                            <button class="btn btn-sm col-6" @click.prevent="removeAttachment(f.id)">
                                                <span class="fas fa-trash text-danger "></span>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </div>


                    </div>

                    <div class="d-flex flex-center">
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
import Multiselect from '@vueform/multiselect';

import {useVuelidate} from '@vuelidate/core'
import {required} from '@vuelidate/validators'
import shared from "../../../src/shared";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
import api from "../../../src/api";

export default {
    name: "taskForm",
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    components: {
        ValidationServerErrors,
        Multiselect
    },
    data() {
        return {
            title: "  مهمة جديدة",
            form: {"id": 0, "name": "", "is_internal": false, attachments: [], team: []},
            errors: {file: "", file_desc: "", emp_name: ""},
            edit_route: "editTask",
            base_route: "tasks",
            api_url: "/api/tasks",
            file: null,
            file_desc: "",
            emp:{name:"" , number:""},
            is_edit:false,
            employees:[],
            server_errors:[]

        }
    },
    validations() {
        return {
            form: {
                title: {required},
                commissioner: {required},
                commissioning_source_cd: {required},
                start_date: {required},
                due_date: {required},
                details: {required},
                priority_cd: {required},
            }
        }
    },
    async created() {
        api.vw=this;
        this.employees = await shared.employees();
        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.this.form = await api.show(this.$route.params.id)
            this.is_edit =true;
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
                await api.update();
            } else {
                await this.add();
            }

        },

        async add() {
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }

            let formData = new FormData();
            for (const prop in this.form) {
                if(prop !=="attachments" && prop !="team"){
                    formData.append(prop, this.form[[prop]]);
                }

            }
            formData.append("team" , JSON.stringify(this.form["team"]));
            let len= this.form.attachments.length;
            for (var x = 0; x < len; x++) {
                formData.append("fileToUpload[]", this.form.attachments[x].file);
                formData.append("file_desc[]", this.form.attachments[x].desc);
            }


            let res = await shared.storeMultiPart(this.api_url, formData);
            shared.notify(res.message,res.status)
            if (res.status) {
                this.$router.back();
            }else{
                this.server_errors=res.data;
            }
            this.loading = false
        },

        addTeamMember() {
            this.errors = {file: "", file_desc: "", emp_name: ""};
            var val = this.caller_name;
            let id = this.form.team.length + 1;
            if(this.form.is_internal == 1){
                var val = this.emp.number;
                if(val == null || val ==""){
                    this.errors.emp_name = "لا يمكن ترك القيمة فارغة";
                    return;
                }
                this.form.team.push({id: id, participant_name: val.full_name, participant_id: val.id , is_internal:1 });
            }else{
                var val = this.emp.name;
                if (val == null || val == "") {
                    this.errors.emp_name = "لا يمكن ترك القيمة فارغة";
                    return;
                }
                this.form.team.push({id: id, participant_name: val, participant_id: 0 , is_internal:0 });
            }
            this.emp ={name:"" , number:""};

        },
        removeTeamMember(item_id) {
            let updatedList = this.form.team.filter((el) => el.id !== item_id);
            this.form.contacts = updatedList;
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
        addAttachment() {
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
            let id = this.form.attachments.length + 1;
            this.form.attachments.push({id: id, file: this.file, desc: this.file_desc});
            this.file_desc = "";
            this.file = null;
        },
        removeAttachment(item_id) {
            let updatedList = this.form.attachments.filter((el) => el.id !== item_id);
            this.form.attachments = updatedList;
        },

    },

}
</script>


