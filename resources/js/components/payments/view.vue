<template>

    <div v-loading="loading" class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <div class="container my-5">
                        <h2 class="text-center mb-4">تفاصيل الفاتورة</h2>

                        <div class="row">
                            <div v-for="c in form" class="border border-gray-300 border-dashed rounded col-md-3 py-3 px-4  mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bolder counted" >{{c.value}}</div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400"> {{c.key}}</div>
                            </div>
                        </div>
                        <hr/>

                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="departments_table" class="table table-row-dashed table-row-gray-300 table-striped gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                <tr>
                                    <th> البند </th>
                                    <th>الكمية </th>
                                    <th>سعر الوحدة</th>
                                    <th>العملة</th>
                                    <th>سعر الصرف</th>
                                    <th>المبلغ الكلي  </th>
                                    <th>ملاحظات  </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                <tr v-for="c in results">
                                    <td>{{ c.full_name }}</td>
                                    <td>{{ c.desc_ar }}</td>
                                    <td>{{ c.start_date}}</td>
                                    <td>{{ c.end_date}}</td>
                                    <td>{{ c.job_title}}</td>
                                    <td>{{ c.job_title}}</td>
                                    <td>{{ c.salary }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a v-show="canEdit" class="btn btn-primary" @click.prevent="edit(c)">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <button v-show="canDelete" class="btn btn-danger"  @click.prevent="_delete(c.id)">
                                                <i class="far fa-trash-alt"/>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
import shared from "../../src/shared";
import api from "../../src/api";
import CodeSelect from "../_common/codeSelect";
import ExpensesBasicDataForm from "./tabs/basic_data";
import ExpensesDetailsForm from "./tabs/expensesDetailsForm";

export default {
    name: "expensesView",
    components: {ExpensesDetailsForm, ExpensesBasicDataForm, CodeSelect},
    data() {
        return {
            title: " تفاصيل المصروف",
            form: [
                {key:"الفريق", value:"فريق خانيونس"},
                {key:"الجهة المرتبطة", value:"مطبخ السعادة"},
                {key:"بند المصروف", value:"تكية"},
                {key:"الكمية", value:"12"},
                {key:"سعر الوحدة", value:"10"},
                {key:"العملة", value:"شيكل"},
                {key:"سعر الصرف", value:"1"},
                {key:"المبلغ الكلي", value:"120"},
                {key:"تاريخ الصرف", value:"12/7/2025"},
                {key:"نوع الصرف", value:"تطبيق"},
                {key:"حالة الاعتماد", value:"معتمد"},
                {key:"تاريخ الاعتماد", value:"20/07/2025"},
                {key:"ملاحظات", value:""},
                {key:"الشخص الذي قام بالادخال", value:"محمد"},
                {key:"تاريخ الادخال", value:"20/07/2025"},
                {key:"الشخص الذي قام بآخر تعديل", value:"علي"},
                {key:"تاريخ آخر تعديل", value:"25/07/2025"},
            ],
            results:[],
            edit_route: "editAgenda",
            loading: false,
            api_url: "/api/agenda",
        }
    },
    async created() {
        api.vw = this;
        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.form = await api.show(this.$route.params.id)
        }
    },
    methods: {
        async search() {

        },
    },

}
</script>


