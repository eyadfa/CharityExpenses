<template>
    <el-dialog
        v-model="visible"
        :append-to-body="true"
        center
        :close-on-click-modal="false"
    >
        <display :file-url="display_path" ></display>
    </el-dialog>
</template>

<script>
import display from "./display";
export default {
    name: "displayModal",
    components:{display},
    data() {
        return {
            display_path:null,
            visible:false,
        }
    },
    methods:{
        show(file_path){
            this.display_path=file_path;
            this.visible=true;
        }
    }
}
</script>


