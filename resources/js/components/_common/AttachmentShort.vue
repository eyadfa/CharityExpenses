<template>
    <div class=" p-2 fv-row border-gray-300 ">
        <label class="mb-2">المرفقات </label>
        <div class="col-12 fv-row">
            <label class="required fs-5 fw-bold mb-2">وصف الملف</label>
            <input type="text" v-model="form.details" class="form-control form-control-solid" />
            <span v-for="error of v$.form.details.$errors" :key="error.$uid"
                  class="text-danger fw-light">
                      <p>{{ msg(error) }}</p>
                </span>
        </div>
        <div class="row">
            <div class="col-9 fv-row">
                <label class="required fs-5 fw-bold mb-2">الملف</label>
                <file-upload :max-size="5" accept="*" @file-uploaded="uploadFile"></file-upload>
                <span v-for="error of v$.form.file.$errors" :key="error.$uid"
                      class="text-danger fw-light">
                      <p>{{ msg(error) }}</p>
                </span>
            </div>
            <div class="col-md-3 ">
                <button class="btn btn-primary btn-icon mt-10 btn-sm " @click.prevent="add">
                    <span class="fa fa-plus" ></span>
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
            <tr v-for="(c , index) in attachments">
                <td>{{ index}}</td>
                <td> {{c.details}}</td>
                <td>
                    <button v-if="c.path != null" @click.prevent="_download(c.path)" class="btn btn-sm" >
                        <span class="fas fa-search text-primary "></span>
                    </button>
                    <button class="btn btn-sm" @click.prevent="_delete(c.id)">
                        <span class="fas fa-trash text-danger "></span>
                    </button>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

</template>

<script>
import fileUpload from "./FileUpload";
import {useVuelidate} from '@vuelidate/core';
import {email, minLength, numeric, required} from '@vuelidate/validators';
import shared from "../../src/shared";
import permissions from "../../mixins/Permissions";
export default {
    name: "AttachmentShort",
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    components:{fileUpload},
    data(){
        return {
            form:{},
            attachments:[],
        }
    },
    validations() {
        return {
            form: {
                details: {required},
                file: {required},
            }
        }
    },
    props: {
        ls:[],
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
    watch: {
        ls(newLs, oldLs) {
            if(newLs != null){
                this.attachments = newLs;
            }else{
                this.attachments=[];
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
        uploadFile(file){
            this.form.file=file.file;
        },
        async add(){
            if(!this.canAdd){
                shared.alert("لا يمكنك اضافة مرفق");
                return;
            }
            const result = await this.v$.form.$validate()
            if (!result) {
                return
            }

            let id = this.attachments.length + 1;
            this.form.id = id;
            this.attachments.push(this.form);
            this.form={};
            this.$emit("set-outputs" , this.attachments)
        },
        _delete(item_id) {
            if(!this.canDelete){
                shared.alert("لا يمكنك حذف مرفق");
                return;
            }
            let updatedList = this.attachments.filter((el) => el.id !== item_id);
            this.attachments = updatedList;
            this.$emit("set-outputs" , this.attachments)
        },
        fileUploaded(file){
            this.form.file= file.file;
        },
        _download(path){
            shared.download(path);
        }
    }
}
</script>
