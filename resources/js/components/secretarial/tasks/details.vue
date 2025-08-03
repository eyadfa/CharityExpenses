<template>

    <div class="row gy-5 g-xl-9">
        <div class="col-8">

            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ form.title }} </h2>

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->

                        <button
                            class="btn btn-icon-light btn-color-gray-400 btn-active-color-primary justify-content-end"
                            @click.prevent="$router.back()">
                            <i class="fa-sharp fa-solid fas fa-arrow-left"></i>
                        </button>


                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <div class="card-body">
                    <div class="min-h-screen flex items-center justify-center">
                        <div class="flex items-center justify-center mb-2">
                            <el-progress type="dashboard" :percentage="form.progress" :color="colors" />
                        </div>
                    </div>

                    <div class="row mb-5">


                        <div class="col-md-2 fv-row">
                            <label class=" fs-5 fw-bold mb-2">تاريخ البداية </label>
                            <span>{{ form.start_date }}</span>
                        </div>
                        <div class="col-md-2 fv-row">
                            <label class=" fs-5 fw-bold mb-2">تاريخ النهاية </label>
                            <span>{{ form.due_date }}</span>
                        </div>
                        <div class="col-md-2 fv-row">
                            <label class=" fs-5 fw-bold mb-2"> الأولوية </label>
                            <br/>
                            <span>{{ form.priority.desc_ar }}</span>
                        </div>

                        <div class="col-md-2 fv-row">
                            <label class=" fs-5 fw-bold mb-2"> الحالة </label>
                            <br/>
                            <span v-if="form.is_finished" class="badge rounded-pill bg-success">منجز</span>
                            <span v-else class="badge rounded-pill bg-warning"> غير منجز</span>
                        </div>
                        <div class="col-md-2 fv-row">
                            <label class=" fs-5 fw-bold mb-2">تاريخ الاغلاق </label>
                            <span>{{ form.finished_at }}</span>
                        </div>

                        <hr/>
                        <div class="col-md-12 fv-row">
                            <label class=" fs-5 fw-bold mb-2"> تفاصيل المهمة</label>
                            <br/>
                            <span>{{ form.details }}</span>
                        </div>

                    </div>

                </div>
            </div>

            <task-attachments :is_finished="form.is_finished" :attachments="form.attachments"/>
            <div class="card mt-5">
                <div class="card-header card-header-stretch">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800"> ملاحظات</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                    </h3>
                </div>
                <div class="card-body">


                    <div class="row mb-5">

                        <!--begin::Table-->
                        <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-150px text-start"></th>
                                <th class="p-0 pb-3 min-w-150px text-start"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr v-for="c in form.notes">
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                                {{ c.note }}</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7 text-start">
                                                    {{ c.creator.name }}
                                                </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-0 pb-3 w-50px text-end text-gray-400"> {{ c.created_at }}</td>
                            </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->

                    </div>
                    <div v-show="!form.is_finished && can('tasks_add_note')" class="row">
                        <hr/>

                        <div class="col-md-12 fv-row">
                            <textarea v-model="form_reply.note" class="form-control form-control-solid"
                                      rows="3"></textarea>
                        </div>

                        <div class="d-flex flex-end">
                            <button class="btn btn-success" type="submit" @click="addReply">
                                <span class="indicator-label">اضافة</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">

            <task-team :is_finished="form.is_finished" :participants="form.participants" />

            <div class="card mt-5">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800"> مهام تابعة</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div v-show="!form.is_finished" class="card-toolbar">
                        <router-link v-show="can('tasks_add_sub_tasks')" :to="{name: 'addSubTask', params: { id: form.id }}"
                                     class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end">
                            <span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1 fas fa-plus"></span>
                        </router-link>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <div class="card-body">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-striped align-middle gs-0 gy-3 my-0">

                        <!--begin::Table body-->
                        <tbody>
                        <tr v-for="(item , index) in form.sub_tasks">
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="d-flex justify-content-start flex-column">
                                        <a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ item.title}} </a>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">{{ item.due_date}}</span>
                                    </div>
                                </div>
                            </td>


                            <td class="text-end">
                                <span v-if="item.is_finished">{{ item.finished_at}}</span>
                                <el-dropdown v-else trigger="click">
                                <span class="el-dropdown-link btn btn-secondary btn-icon">
                                   <i class="fas fa-cogs"></i>
                                </span>
                                    <template #dropdown #default="scope">
                                        <el-dropdown-menu>

                                            <el-dropdown-item v-if="can('tasks_edit_sub_tasks')"  >
                                                <router-link :to="{name: 'editSubTask', params: { id: item.id }}" >
                                                    تعديل
                                                </router-link>
                                            </el-dropdown-item>

                                            <el-dropdown-item v-if="can('tasks_close_sub_tasks')" >
                                                <router-link :to="{name: 'finishSubTask', params: { id: item.id }}">
                                                    اغلاق
                                                </router-link>
                                            </el-dropdown-item>

                                        </el-dropdown-menu>
                                    </template>
                                </el-dropdown>

                            </td>
                        </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header card-header-stretch">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">  اغلاق المهمة</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6"></span>
                    </h3>
                </div>
                <div class="card-body">


                    <div class="row mb-5">
                        <div v-show="form.is_finished == 1" class="row mb-5">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-striped align-middle gs-0 gy-3 my-0">
                                <!--begin::Table body-->
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <a class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ form.finish_note}} </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="text-gray-400 fw-semibold d-block fs-7">{{  form.finished_at}}</span>
                                    </td>
                                </tr>


                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            <!--end::Table-->
                        </div>
                        <hr/>

                        <div v-show="form.is_finished ==0" class="row mb-5">
                            <div  class="col-md-12 fv-row">
                                <label class="form-label fw-bold"> تعليق الاغلاق:</label>
                                <textarea class="form-control form-control-solid" rows="3" v-model="form_finish.note"></textarea>
                            </div>
                            <div class="d-flex flex-end">
                                <button v-show="can('tasks_close_task')" class="btn btn-success" type="submit" @click.prevent="finish">
                                    <span class="indicator-label"> اغلاق/ انهاء المتابعة</span>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</template>


<script>

import shared from "../../../src/shared";
import api from "../../../src/api";
import TaskAttachments from "./details/taskAttachments";
import TaskTeam from "./details/taskTeam";

export default {
    name: "taskDetails",
    components: {TaskTeam, TaskAttachments},
    data() {
        return {
            title: "تفاصيل المهمة",
            form: {"id": 0, "name": "", is_internal:0},
            api_url:"/api/tasks",
            form_reply: {note: ""},
            file: null,
            employees:[],
            form_team:{},
            emp:{name:"", number:""},
            form_finish: {"note": ""},
            colors : [
                { color: '#f56c6c', percentage: 20 },
                { color: '#e6a23c', percentage: 40 },
                { color: '#5cb87a', percentage: 60 },
                { color: '#1989fa', percentage: 80 },
                { color: '#6f7ad3', percentage: 100 },
            ],
        }
    },


    async created() {
        api.vw= this;
        this.employees = await shared.employees()
        this.form = await api.show(this.$route.params.id)
    },

    methods: {
        addReply() {
            this.form_reply.id =this.$route.params.id;
            api.reply(this.form_reply )
        },
        finish() {
            api.finish(this.form_finish);
        },


    },


}
</script>


