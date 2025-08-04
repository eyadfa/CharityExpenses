<template>
    <div class="card ">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">{{title}}</span>
                <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-6">

            <div v-show="canAdd" class="col-md-12  p-2 fv-row">
                <div class="row">
                    <div class="col-md-12 fv-row">
                        <label class="required fs-5 fw-bold mb-2"> الاسم</label>
                        <input type="text"  v-model="form.follower" class="form-control form-control-solid " v-show="!form.is_internal" />
                        <el-select v-model="form.follower" filterable placeholder="اختر..." class="form-control" v-show="form.is_internal">
                            <el-option
                                v-for="item in employees"
                                :key="item.id"
                                :label="item.full_name"
                                :value="item"
                            />
                        </el-select>
                        <span v-for="error of v$.form.follower.$errors" :key="error.$uid"
                              class="text-danger fw-light">
                              <p>{{ msg(error) }}</p>
                        </span>
                    </div>
                    <div class="col-8 pt-10">
                        <label class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-20px w-20px" type="checkbox" v-model="form.is_internal" value="true">
                            <span class="form-check-label fw-bold">من القائمة</span>
                        </label>
                    </div>
                    <div class="col-md-2 ">
                        <button class="btn btn-primary btn-icon mt-10 btn-sm " @click.prevent="add"><span class="fa fa-plus"></span> </button>
                    </div>
                </div>
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">

                    <!--begin::Table body-->
                    <tbody>
                    <tr v-for="c in members">
                        <td>
                            <div class="d-flex align-items-center">

                                <div class="d-flex justify-content-start flex-column">
                                    <a  class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{c.name}}</a>
                                </div>
                            </div>
                        </td>

                        <td class="text-end">
                            <select @change="updateTeam()" v-model="c.status" class="form-select form-select-solid">
                                <option value="1">حاضر</option>
                                <option value="2">غائب</option>
                                <option value="3">متأخر</option>
                                <option value="4">معتذر </option>
                            </select>
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
</template>

<script>
import {useVuelidate} from "@vuelidate/core";

import {minLength, numeric, required} from '@vuelidate/validators';
import shared from "../../src/shared";
import permissions from "../../mixins/Permissions";
export default {
    name: "internalTeam",
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    props: {
        title: {
            type: String,
            required:true,
        },
        team:{
            type: Array, // Correctly define the type as Array
            default: () => [] // Provide a default value if necessary
        },
        add_perm:{
            type:String,
            default:null
        },
        is_closed:{
            type:Boolean,
            default:false,
        },
    },
    watch: {
        team(newTeam, oldTeam) {
            if(newTeam != null){
                this.members = newTeam;
            }else{
                this.members=[];
            }
        }
    },
    data(){
        return {
            form:{is_internal:""},
            employees:[],
            members:[],
        }
    },
    validations() {
        return {
            form: {
                follower: {required},
            }
        }
    },
    async created() {
        let employees  = await shared.employees();
        this.employees  =employees;
        this.members = this.team;
        //this.members = [];
    },
    computed: {
        canAdd() {
            return (this.add_perm === null || permissions.methods.can(this.add_perm)) && !this.is_closed;
        },
    },
    methods:{
        async add(){
            const result = await this.v$.form.$validate()
            if (!result) {
                return
            }
            var name ="";
            var number ="";
            if(this.form.is_internal ==1 ){
                name = this.form.follower.full_name;
                number = this.form.follower.id;
            }else{
                name = this.form.follower;
                number  = 0;
            }
            if(this.members == null){
                this.members=[];
            }
            let id = this.members.length + 1;
            this.members.push({id: id, name: name, number: number , status:0});
            this.form={};
            this.v$.form.$reset();
            this.$emit("team-updated", this.members)
        },
        _delete(item_id) {
            let updatedList = this.members.filter((el) => el.id !== item_id);
            this.members = updatedList;
            this.$emit("team-updated", this.members);
        },
        updateTeam(){
            this.$emit("team-updated", this.members)
        }
    },

}
</script>

