<template>

    <div v-loading="loading" class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <div class="container my-5">
                        <h2 class="text-center mb-4">تفاصيل الدفعة</h2>

                        <div class="row">
                            <div v-for="c in form" class="border border-gray-300 border-dashed rounded col-md-3 py-3 px-4  mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bolder counted" >{{c.value}}</div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400"> {{c.key}}</div>
                            </div>
                        </div>
                        <hr/>
                        <h2 class="text-center mb-4"> الفواتير التي تمت تغطيتها في هذه الدفعة</h2>
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="departments_table" class="table table-row-dashed table-row-gray-300 table-striped gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                <tr>
                                    <th> رقم الفاتورة </th>
                                    <th> تاريخ الفاتورة </th>
                                    <th>الجهة المرتبطة </th>
                                    <th>مبلغ الفاتورة بالشيكل</th>
                                    <th>المبلغ المدفوع</th>
                                    <th>ملاحظات  </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2025-08-06 14:30</td>
                                    <td>مطبخ السعادة</td>
                                    <td>1500</td>
                                    <td>1500</td>
                                    <td>
                                        <router-link  class="btn btn-sm btn-primary":to="{name: 'viewExpenses', params: { id: 1 }}" >
                                            <i class="bi bi-eye"></i> عرض
                                        </router-link>
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

export default {
    name: "paymentsView",
    components: { CodeSelect},
    data() {
        return {
            title: " تفاصيل المصروف",
            form: [
                {key:"الفريق", value:"فريق خانيونس"},
                {key:"العملة", value:"شيكل"},
                {key:"المبلغ", value:"150"},
                {key:"سعر الصرف", value:"1"},
                {key:"المبلغ الكلي", value:"150"},
                {key:"تاريخ الدفع", value:"12/7/2025"},
                {key:" طريقة الدفع", value:"تطبيق"},
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


