<template>
    <label class="mb-2">{{title}}</label>
    <div v-show="canAdd" class="row">
        <div class="col-11 fv-row">
            <label class="required fs-5 fw-bold mb-2">البند</label>
            <input type="text" v-model="form.title" class="form-control form-control-solid" />
            <span v-for="error of v$.form.title.$errors" :key="error.$uid"
                  class="text-danger fw-light">
                  <p>{{ msg(error) }}</p>
            </span>
        </div>
        <div class="col-md-1 ">
            <button class="btn btn-primary btn-icon mt-10 btn-sm " @click.prevent="add">
                <span class="fa fa-plus"></span>
            </button>
        </div>

    </div>

    <table class="table-striped table table-bordered table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>البند</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="c in outputs">
            <td>{{c.title}}</td>
            <td>
                <button v-show="canDelete" class="btn btn-sm" @click.prevent="_delete(c.id)" >
                    <span class="fas fa-trash text-danger "></span>
                </button>
            </td>
        </tr>

        </tbody>
    </table>

</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {email, minLength, numeric, required} from '@vuelidate/validators'
import permissions from "../../mixins/Permissions";
export default {
    name: "OutputsShort",
    props: {
        title: {
            type: String,
            required:true,
        },
        ls:{
            type:Array,
            default:[]
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
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    data(){
        return {
            form:{title:""},
            outputs:[]
        }
    },
    validations() {
        return {
            form: {
                title: {required},
            }
        }
    },
    created() {
        this.outputs = this.ls;
    },
    watch: {
        ls(newLs, oldLs) {
            if(newLs != null){
                this.outputs = newLs;
            }else{
                this.outputs=[];
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

            if(this.outputs == null){
                this.outputs=[];
            }


            let id = this.outputs.length + 1;
            this.form.id = id;
            this.outputs.push(this.form);
            this.form={};
            this.v$.form.$reset();
            this.$emit("set-outputs" , this.outputs)
        },
        _delete(item_id) {
            let updatedList = this.outputs.filter((el) => el.id !== item_id);
            this.outputs = updatedList;
            this.$emit("set-outputs" , this.outputs)
        },
    },

}
</script>

