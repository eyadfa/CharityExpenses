<template>
    <div class="col-md-12  p-2 fv-row border-gray-300 border-end-dashed border-gray-300 border-start-dashed">
        <label class="mb-2">{{title}}</label>
        <div v-show="canAdd" class="row">
            <div class="col-12 fv-row">
                <label class="required fs-5 fw-bold mb-2">المخرج</label>
                <input type="text" v-model="form.title" class="form-control form-control-solid" />
                <span v-for="error of v$.form.title.$errors" :key="error.$uid"
                      class="text-danger fw-light">
                      <p>{{ msg(error) }}</p>
                </span>
            </div>
            <div class="col-md-8 fv-row">
                <label class="required fs-5 fw-bold mb-2">يتابع بواسطة</label>
                <input type="text" v-model="form.follower" class="form-control form-control-solid " v-show="!form.is_internal" />

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
            <div class="col-2 pt-10">
                <label class="form-check form-check-custom form-check-solid me-10">
                    <input class="form-check-input h-20px w-20px" type="checkbox" v-model="form.is_internal"  name="communication[]" value="true">
                    <span class="form-check-label fw-bold">داخلي</span>
                </label>
            </div>
            <div class="col-md-2 ">
                <button class="btn btn-primary btn-icon mt-10 btn-sm " @click.prevent="add()"><span class="fa fa-plus"></span> </button>
            </div>
        </div>

        <table class="table-striped table table-bordered table-responsive">
            <thead>
            <tr>
                <th>البند</th>
                <th>يتابع بواسطة</th>
                <th>....</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="c in outputs" :key="c.id">
                <td>{{ c.title}}</td>
                <td>{{ c.name }}</td>
                <td>
                    <button v-show="canDelete" class="btn btn-sm"  @click.prevent="_delete(c.id)">
                        <span class="fas fa-trash text-danger "></span>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>

</template>

<script>
import shared from "../../src/shared";
import {useVuelidate} from '@vuelidate/core'
import {email, minLength, numeric, required} from '@vuelidate/validators'
import permissions from "../../mixins/Permissions";

export default {
    name: "outputsWithFollowups",
    emits: ['set-outputs','_store' , '_destroy'],
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
        ls:{
            type: Array, // Correctly define the type as Array
            default: () => [] // Provide a default value if necessary
        },
        api_url:{
            type:String,
            required:true,
        },
        editable_mode:{
            type:Boolean,
            default:false,
        },
        initial_form:{
            required:true
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
            form:{is_internal:""},
            employees:[],
            outputs:[],
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
    validations() {
        return {
            form: {
                title: {required},
                follower: {required},

            }
        }
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
    async created() {
        let employees  = await shared.employees();
        this.employees  =employees;
    },
    methods:{
        async add(){
            if(!this.canAdd){
                shared.alert("لا يمكنك الاضافة ");
                return;
            }
            const result = await this.v$.form.$validate()
            if (!result) {
                return
            }
            var name ="";
            var number ="";
            if(this.form.is_internal ==1 ){
                if(this.form.follower.id == undefined){
                    shared.alert("يجب اختيار اسم الشخص المكلف بالمتابعة من القائمة")
                    return;
                }
                name = this.form.follower.full_name;
                number = this.form.follower.id;
            }else{
                name = this.form.follower;
                number  = 0;
            }
            let id = - (this.outputs.length ) - 1;
            let obj = {id: id, name: name, number: number , title:this.form.title}
            this.outputs.push(obj);
            this.form={};

            this.v$.form.$reset();
            this.$emit("set-outputs" , this.outputs)
           // this.$emit("_store" , obj)
            this._store(obj)
        },
        _delete(item_id) {
            if(!this.canDelete){
                shared.alert("لا يمكنك الاضافة ");
                return;
            }
            let updatedList = this.outputs.filter((el) => el.id !== item_id);
            this.outputs = updatedList;
            this.$emit("set-outputs" , this.outputs)
            if(item_id > 0){
                shared._delete(item_id,this.api_url,this , "هل أنت متأكد من حذف المخرج والمتابعة التابعة له",false)
                this.$emit("_destroy" , item_id)
            }

        },
        async storeBulk(){
            if(!this.canAdd){
                //shared.alert("لا يمكنك الاضافة ");
                return;
            }
            console.log("storeBulk")
            if(this.outputs == null){
                return;
            }
            console.log( this.initial_form);
            let obj = this.initial_form;
            for (const item of this.outputs) {
                obj.output = item.title;
                obj.followed_by = item.number;
                obj.follower_name = item.name;
                obj.follower_type = item.number > 0;
                await shared.store(this.api_url , obj )
            }
            console.log("bulk done")
        },
        _store(item){
            if(this.editable_mode){
                let obj = this.initial_form;
                obj.output = item.title;
                obj.followed_by = item.number;
                obj.follower_name = item.name;
                obj.follower_type = item.number > 0;
                shared.store(this.api_url , obj )
            }

        }
    },

}
</script>


