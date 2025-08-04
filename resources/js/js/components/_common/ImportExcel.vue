<template>
    <el-dialog
        v-model="visible"
        :title="title"
        center
        :destroy-on-close="true"
        :close-on-click-modal="false"
        @closed=""
    >
        <div class="row mb-5">
            <div class=" fv-row">
                <file-upload max-size="5" accept="xls,xlsx" @file-uploaded="setFile" />
                <span v-for="error of v$.file.$errors" :key="error.$uid"
                      class="text-danger fw-light">
                        <p>{{ msg(error) }}</p>
                    </span>
            </div>

            <div class="d-flex flex-center">
                <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                    <span  class="indicator-label" :class="{'visually-hidden':loading}">اضافة</span>
                    <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
                    <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
                </button>
            </div>
        </div>
    </el-dialog>
</template>

<script>
import shared from "../../src/shared";
import FileUpload from "../../components/_common/FileUpload";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";

export default {
    name: "import_excel",
    components: {FileUpload},
    props: {
        upload_url:{
            required: true
        },
        title:{
            required:true,
            default:"استيراد بيانات"
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
            file:{required}
        }
    },
    data(){
        return {
            loading:false,
            file:null,
            visible:false,
        }
    },
    methods: {
        async submit() {
            await this.v$.file.$touch();
            if (this.v$.file.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return false;
            }

            this.loading = true;
            let res = await shared.storeMultiPart(this.upload_url,this.getformData());
            if (res.status) {
                shared.success(res.message);
                this.visible=false;
            }else{
                shared.alert(res.message);
            }
            this.loading = false
            return res.status;
        },
        setFile(file){
            this.file = file;
        },
        getformData(){
            let form_data = new FormData();
            if (this.file != null) {
                form_data.append("file", this.file.file);
            }
            return form_data;
        },
        show(){
            this.visible=true;
        }

    },

}
</script>

