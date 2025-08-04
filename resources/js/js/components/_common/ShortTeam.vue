<template>

    <div class="card ">

        <!--begin::Body-->
        <div class="card-body pt-6">
            <label>{{title}}</label>
            <div v-show="canAdd" class="col-md-12  p-2 fv-row">
                <div class="row">
                    <div class="col-md-10 fv-row">
                        <label class="required fs-5 fw-bold mb-2"> الاسم</label>
                        <input type="text"  v-model="form.follower" class="form-control form-control-solid "  />
                        <span v-for="error of v$.form.follower.$errors" :key="error.$uid"
                              class="text-danger fw-light">
                              <p>{{ msg(error) }}</p>
                        </span>
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
                            <button v-show="canDelete" class="btn btn-sm"  @click.prevent="_delete(c.id)" >
                                <span class="fas fa-trash text-danger "></span>
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
    </div>
</template>

<script>

import {useVuelidate} from "@vuelidate/core";
import {minLength, numeric, required} from '@vuelidate/validators';
import permissions from "../../mixins/Permissions";
export default  {
    name: "shortTeam",
    emits:["set-team"],
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
            type:Array,
            default:[],
        },

        add_perm:{
            type:String,
            default:null
        },
        delete_perm:{
            type:String,
            default:null
        },
        is_closed:{
            type:Boolean,
            default:false,
        },
    },
    data(){
        return {
            form:{},
            members:[]
        }
    },
    created() {
        this.members = this.team;
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
    validations() {
        return {
            form: {
                follower: {required},
            }
        }
    },
    computed: {
        canAdd() {
            return (this.add_perm === null || permissions.methods.can(this.add_perm)) && !this.is_closed;
        },
        canDelete(){
            return (this.delete_perm === null || permissions.methods.can(this.delete_perm)) && !this.is_closed;
        }
    },
    methods:{
        async add(){
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                return;
            }
            if(this.members == null){
                this.members=[];
            }

            var name = this.form.follower;
            let id = this.members.length + 1;
            this.members.push({id: id, name: name, status:0});
            this.form={};
            this.$emit("set-team", this.members)
            this.v$.form.$reset();
        },
        _delete(item_id) {
            console.log(item_id);
            let updatedList = this.members.filter((el) => el.id !== item_id);
            this.members = updatedList;
            this.$emit("set-team", this.members);
        },


    },

}
</script>


