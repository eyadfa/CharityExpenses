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
            <!--begin::Toolbar-->
            <div class="card-toolbar">

            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-6">

            <div class="col-md-12  p-2 fv-row">
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
                            <select v-model="c.status" class="form-select form-select-solid">
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
export default {
    name: "externalTeam",
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
        team:[]
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
            form:{},
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

    methods:{
        async add(){
            const result = await this.v$.$validate()
            if (!result) {
                return
            }
            var name = this.form.follower;
            let id = this.members.length + 1;
            this.members.push({id: id, name: name, status:0});
            this.form={};
            this.$emit("team-updated", this.members)
        },
        delete(item_id) {
            let updatedList = this.members.filter((el) => el.id !== item_id);
            this.members = updatedList;
            this.$emit("team-updated", this.members);
        },

        setOutput(outputs){
            this.form.outputs = outputs;
        },
        setTeam(team){
            this.form.team = team;
        }
    },

}
</script>
