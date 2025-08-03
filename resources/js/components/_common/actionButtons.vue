<template>
    <div>
        <!-- Print Button-->
        <el-popover
            placement="top-start"
            :width="200"
            effect="dark"
            trigger="hover"
            :disabled="can(printPerms)"
            :content="error_msg"
        >
            <template #reference>
                <button
                    type="button"
                    v-show="showPrint"
                    class="btn btn-sm    float-end ms-2 me-2"
                   :class="can(printPerms) ?'btn-light-warning' :'btn-light'"
                    @click.prevent="onPrint"
                >
                    <span class="svg-icon svg-icon-3 fas fa-print"></span>
                    طباعة
                </button>
            </template>
        </el-popover>

        <!-- Export To Excel Button-->
        <el-popover
            placement="top-start"
            :width="200"
            effect="dark"
            trigger="hover"
            :disabled="can(exportToExcelPerms)"
            :content="error_msg"
        >
            <template #reference>
                <button
                    type="button"
                    v-show="showExportToExcel"
                    @click.prevent="onExportToExcel"
                    class="btn btn-sm  float-end ms-2 me-2"
                    :class="can(printPerms) ?'btn-light-success' :'btn-light'"
                >
                    <span class="svg-icon svg-icon-3 fas fa-file-excel"></span>
                    Excel
                </button>
            </template>
        </el-popover>


        <!-- Add Button-->
        <el-popover
            placement="top-start"
            :width="200"
            effect="dark"
            trigger="hover"
            :disabled="can(addPerms)"
            :content="error_msg"
        >
            <template #reference>
                <button
                    type="button"
                    v-show="showAdd"
                    class="btn btn-sm  float-end"
                    :class="can(addPerms) ?'btn-light-primary' :'btn-light'"
                    @click.prevent="onAdd"
                >
                    <span class="svg-icon svg-icon-3 fas fa-plus"></span>
                    {{ addTitle }}
                </button>
            </template>
        </el-popover>

        <!-- Import From Excel Button-->
        <el-popover
            placement="top-start"
            :width="200"
            effect="dark"
            trigger="hover"
            :disabled="can(importPerms)"
            :content="error_msg"
        >
            <template #reference>
                <button
                    type="button"
                    v-show="showImport"
                    class="btn btn-sm float-end ms-2 me-2"
                    @click.prevent="onImportFromExcel"
                    :class="can(importPerms) ?'btn-light-warning' :'btn-light'"
                >
                    <span class="svg-icon svg-icon-3 fas fa-print"></span>
                    استيراد بيانات
                </button>
            </template>
        </el-popover>
    </div>
</template>

<script>
import permissions from "../../mixins/Permissions";
import shared from "../../src/shared";

export default {
    name: "ActionButtons",
    props: {
        addUrl: {
            type: String,
            defualt: ""
        },
        addTitle: {
            type: String,
            default:"اضافة"
        },

        printAction: {
            type: Function,
            default: () => () => {}
        },
        exportToExcelAction: {
            type: Function,
            default: () => () => {}
        },
        importExcelModalAction: {
            type: Function,
            default: () => () => {}
        },
        showAdd: {
            type: Boolean,
            default: true
        },
        showPrint: {
            type: Boolean,
            default: true
        },
        showImport: {
            type: Boolean,
            default: false
        },
        showExportToExcel: {
            type: Boolean,
            default: true
        },
        addPerms: {
            type: String,
            default: null
        },
        printPerms: {
            type: String,
            default: null
        },
        importPerms: {
            type: String,
            default: null
        },
        exportToExcelPerms: {
            type: String,
            default: null
        },
    },
    data() {
        return {
            error_msg:"لا يوجد لديك صلاحية",
        }
    },
    methods: {
        onPrint() {
            if(!permissions.methods.can(this.printPerms)){
                shared.alert(this.error_msg)
                return;
            }
            this.printAction();
        },
        onExportToExcel() {
            if(!permissions.methods.can(this.exportToExcelPerms)){
                shared.alert(this.error_msg)
                return;
            }
            this.exportToExcelAction();
        },
        onAdd() {
            if(!permissions.methods.can(this.addPerms)){
                shared.alert(this.error_msg)
                return;
            }
            this.$router.push(this.addUrl);
        },
        onImportFromExcel() {
            if(!permissions.methods.can(this.importPerms)){
                shared.alert(this.error_msg)
                return;
            }
            this.importExcelModalAction();
        },
    }
}
</script>
