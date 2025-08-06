<template>

    <div class="card " v-loading="loading">
        <div class="card-header card-header-stretch">
            <h2 class="mt-5">  {{title}} </h2>
            <div class="d-flex flex-center">
                <button :disabled="!canAdd" type="submit" class="btn btn-primary" @click.prevent="show()">
                    <span class="indicator-label" :class="{'visually-hidden':loading}">اضافة</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <el-dialog
                v-model="visible"
                :title="title"
                center
                :destroy-on-close="true"
                :close-on-click-modal="false"
                @closed="search"
            >
                <div class="row mb-5">
                    <validation-server-errors :errors="errors"/>
                    <div class="col-md-4 fv-row">
                        <code-select v-model:sub_cd="form_details.fname" :main_cd="5" title="نوع البند"/>
                        <span v-for="error of v$.form_details.fname.$errors"
                              :key="error.$uid" class="text-danger fw-light">
                                        <p>{{ msg(error) }}</p>
                                    </span>
                    </div>

                    <div class="col-md-4 fv-row">
                        <label class="required fs-5 fw-bold mb-2"> الكمية</label>
                        <input v-model="form_details.sname" class="form-control form-control-solid" type="number"/>
                        <span v-for="error of v$.form_details.sname.$errors"
                              :key="error.$uid" class="text-danger fw-light">
                                <p>{{ msg(error) }}</p>
                            </span>
                    </div>

                    <div class="col-md-4 fv-row">
                        <label class="required fs-5 fw-bold mb-2"> سعر الوحدة</label>
                        <input v-model="form_details.thname" class="form-control form-control-solid" type="number"/>
                        <span v-for="error of v$.form_details.thname.$errors"
                              :key="error.$uid" class="text-danger fw-light">
                                <p>{{ msg(error) }}</p>
                            </span>
                    </div>
                    <div class="col-md-4 fv-row">
                        <code-select v-model:sub_cd="form_details.lname" :main_cd="1" title="العملة"/>
                        <span v-for="error of v$.form_details.lname.$errors"
                              :key="error.$uid" class="text-danger fw-light">
                                <p>{{ msg(error) }}</p>
                            </span>
                    </div>


                    <div class="col-md-4 fv-row">
                        <label class="required fs-5 fw-bold mb-2"> سعر الصرف</label>
                        <input v-model="form_details.dob" class="form-control form-control-solid" type="number"/>
                        <span v-for="error of v$.form_details.dob.$errors"
                              :key="error.$uid" class="text-danger fw-light">
                                <p>{{ msg(error) }}</p>
                            </span>
                    </div>

                    <div class="col-md-4 fv-row">
                        <label class="required fs-5 fw-bold mb-2">المبلغ الكلي</label>
                        <input disabled v-model="form_details.address" class="form-control form-control-solid" type="number"/>

                    </div>

                    <div class="col-md-8 fv-row">
                        <label class=" fs-5 fw-bold mb-2"> ملاحظات </label>
                        <textarea v-model="form_details.notes" rows="3" class="form-control form-control-solid"></textarea>
                    </div>

                </div>

                <div class="d-flex flex-center">
                    <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                        <span v-if="is_edit" class="indicator-label" :class="{'visually-hidden':loading}">حفظ التعديلات</span>
                        <span v-else class="indicator-label" :class="{'visually-hidden':loading}">اضافة</span>
                        <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
                        <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
                    </button>
                </div>
            </el-dialog>
            <hr/>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="departments_table" class="table table-row-dashed table-row-gray-300 table-striped gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                    <tr>
                        <th> البند </th>
                        <th>الكمية </th>
                        <th>سعر الوحدة</th>
                        <th>العملة</th>
                        <th>سعر الصرف</th>
                        <th>المبلغ الكلي  </th>
                        <th>ملاحظات  </th>
                        <th></th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    <tr v-for="c in results">
                        <td>{{ c.full_name }}</td>
                        <td>{{ c.relationship.desc_ar }}</td>
                        <td>{{ c.start_date}}</td>
                        <td>{{ c.end_date}}</td>
                        <td>{{ c.job_title}}</td>
                        <td>{{ c.job_title}}</td>
                        <td>{{ c.salary }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a v-show="canEdit" class="btn btn-primary" @click.prevent="edit(c)">
                                    <i class="far fa-edit"></i>
                                </a>

                                <button v-show="canDelete" class="btn btn-danger"  @click.prevent="_delete(c.id)">
                                    <i class="far fa-trash-alt"/>
                                </button>
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
    </div>
</template>

<script>
import codeSelect from "../../_common/codeSelect";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import shared from "../../../src/shared";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
import permissions from "../../../mixins/Permissions";
export default {
    name: "expensesDetailsForm",
    components:{ValidationServerErrors, codeSelect},
    props: {

        wizard: {
            type: Boolean,
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
            form_details: {
                fname: {required},
                sname: {required},
                thname: {required},
                lname: {required},
                dob: {required},
            }
        }
    },

    data() {
        return {
            title: " تفاصيل الفاتورة",
            loading:false,
            form_details:{},
            api_url: "/api/expenses/details",
            is_edit: false,
            results: [],
            visible:false,
            errors:[],
        }
    },
    computed:{
        canAdd(){
            let perm =  "fam_" + permissions.methods.getFamiliesPermPrefix(this.family_type_cd) + "_moel_add";
            return permissions.methods.can(perm);
        },
        canEdit(){
            let perm =  "fam_" + permissions.methods.getFamiliesPermPrefix(this.family_type_cd) + "_moel_edit";
            return permissions.methods.can(perm);
        },
        canDelete(){
            let perm =  "fam_" + permissions.methods.getFamiliesPermPrefix(this.family_type_cd) + "_moel_delete";
            return permissions.methods.can(perm);
        }
    },
    methods: {
        async submit() {
            this.errors=[];
            this.v$.form_details.$touch();
            if (this.v$.form_details.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return false;
            }
            var res = false;
            this.form_details.family_type_cd = this.family_type_cd;
            if (this.is_edit) {
                res = await this.update();
            } else {
                res = await this.add();
            }
            return res;
        },
        async update() {
            this.loading = true;
            let res = await shared.update(this.api_url, this.form_details.id, this.form_details);
            this.$swal(res.message);
            if (res.status) {
                this.v$.form_details.$reset();
                this.results=res.data;
                this.is_edit = false;
                this.form_details={};
                this.visible=false;

            }else{
                this.errors=res.data;
            }
            this.loading = false
            return res.status;
        },
        async add() {
            this.loading = true;
            this.form_details.family_id= this.family_id;
            this.form_details.family_type_cd = this.family_type_cd;
            let res = await shared.store(this.api_url,  this.form_details);
            this.$swal(res.message);
            if (res.status) {
                this.v$.form_details.$reset();
                this.results= res.data;
                this.form_details={};
                this.visible=false;
            }else{
                this.errors=res.data;
            }
            this.loading = false;
            return res.status;
        },
        async search() {
            this.results = (await shared.search(this.api_url, {family_id: this.family_id , family_type_cd:this.family_type_cd})).data;
        },
        edit(row) {
            this.form_details = row;
            this.is_edit = true;
            this.visible=true;
        },

        _delete(_id) {
            this.$swal({
                title: 'هل أنت متأكد من  الحذف؟',
                showDenyButton: true,
                confirmButtonText: 'حذف ',
                denyButtonText: 'لا',

            }).then(async (result) => {
                if (result.isConfirmed) {
                    this.loading = true;
                    let res = await shared.destroy(this.api_url, _id);
                    this.$swal(res.message);
                    if (res.status) {
                        await  this.search();
                    }
                    this.loading = false;

                }
            });
        },
        show(){
            this.visible=true;
        },
        init(res){
            this.results=res;
        }

    }

}
</script>


