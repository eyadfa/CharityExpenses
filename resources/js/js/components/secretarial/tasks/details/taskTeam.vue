<template>
    <div class="card card-flush ">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">فريق العمل</span>
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
                <table class="table table-striped">
                    <thead >
                    <tr>
                        <th>الاسم</th>
                        <th>النوع</th>
                    </tr>
                    </thead>
                    <!--begin::Table body-->
                    <tbody>
                    <tr v-for="(item ,index) in participants">
                        <td  class="text-start">{{ item.participant_name}}</td>
                        <td>
                            <span v-if="item.is_internal" class="text-gray-400 "> داخلي</span>
                        </td>
                    </tr>

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>

            <div v-show="!is_finished && can('tasks_add_team_member')"  class="row">
                <div class="col-md-8 fv-row">
                    <label class="required fs-5 fw-bold mb-2">الاسم</label>
                    <input v-show="!form.is_internal" v-model="form.emp_name" class="form-control form-control-solid "
                           type="text"/>
                    <select v-show="form.is_internal" v-model="form.emp_obj" class="form-select form-select-solid">
                        <option v-for="item in employees" :value="item" :key="item.id">{{ item.full_name}}</option>
                    </select>
                    <span v-for="error of v$.form.emp_name.$errors"
                          :key="error.$uid" class="text-danger fw-light">
                        <p>{{ msg(error) }}</p>
                    </span>
                    <span v-for="error of v$.form.emp_obj.$errors"
                          :key="error.$uid" class="text-danger fw-light">
                        <p>{{ msg(error) }}</p>
                    </span>
                </div>
                <div class="col-3 pt-10">
                    <label class="form-check form-check-custom form-check-solid me-10">
                        <input v-model="form.is_internal" class="form-check-input h-20px w-20px"
                               type="checkbox" value="true">
                        <span class="form-check-label fw-bold">داخلي</span>
                    </label>
                </div>
                <div class="col-md-1 ">
                    <button class="btn btn-primary btn-icon mt-10 btn-sm " @click.prevent="addTeamMember">
                        <span class="fa fa-plus"></span>
                    </button>
                </div>
            </div>
            <!--end::Table container-->
        </div>
        <!--end: Card Body-->
    </div>
</template>

<script>
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import shared from "../../../../src/shared";

export default {
    name: "taskTeam",
    props:{
        is_finished: {
            type: Boolean,
            required: true
        },
        participants: {
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
                emp_name: this.form.is_internal ?{}:{required},
                emp_obj: this.form.is_internal ?{required}:{},
            }
        }
    },
    data() {
        return {
            title: "مرفقات المهمة",
            form: {is_internal:0},
            api_url: "/api/tasks/participant/",
            errors:[],
            employees:[],
            participants: this.participants // Initialize local reactive property
        }
    },


    async created() {
        this.employees= await shared.employees();
    },

    methods: {
        async addTeamMember() {
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            if (this.form.is_internal == 1) {
                this.form_team = {participant_name: this.form.emp_obj.full_name, participant_id: this.form.emp_obj.id, is_internal: 1};
            } else {
                this.form_team = {participant_name: this.form.emp_name, participant_id: 0, is_internal: 0};
            }
            let res=   (await shared.store(this.api_url + this.$route.params.id, this.form_team ));
            if(res.status){
                this.participants= res.data;
            }else{
                this.errors=res.data;
            }
            this.v$.form.$reset();
            this.form={};


        },



    },
}
</script>


