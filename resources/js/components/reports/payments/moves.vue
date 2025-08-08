<template>

    <div v-loading="loading" class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <div class="container mt-5">
                        <h2 class="mb-4 text-center">حركات التعديل على سجل المدفوعات</h2>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered bg-white">
                                <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">تم التعديل بواسطة</th>
                                    <th scope="col">الوقت والتاريخ</th>
                                    <th scope="col">الحقل الذي تم تغييرة</th>
                                    <th scope="col">القيمة القديمة</th>
                                    <th scope="col">القيمة الجديدة</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>محمد أحمد</td>
                                        <td>2025-08-06 14:30</td>
                                        <td>الحالة</td>
                                        <td>قيد التدقيق</td>
                                        <td>تم الاعتماد</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                <i class="bi bi-eye"></i> عرض
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>محمد أحمد</td>
                                        <td>2025-08-06 14:30</td>
                                        <td>الحالة</td>
                                        <td>قيد التدقيق</td>
                                        <td>تم الاعتماد</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                <i class="bi bi-eye"></i> عرض
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>محمد أحمد</td>
                                        <td>2025-08-06 14:30</td>
                                        <td>الحالة</td>
                                        <td>قيد التدقيق</td>
                                        <td>تم الاعتماد</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                <i class="bi bi-eye"></i> عرض
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Modification Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Modified By:</strong> John Doe</p>
                    <p><strong>Date:</strong> 2025-08-06 14:30</p>
                    <p><strong>Field:</strong> Status</p>
                    <p><strong>Old Value:</strong> Pending</p>
                    <p><strong>New Value:</strong> Approved</p>
                    <p><strong>Reason:</strong> Document verification completed.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import shared from "../../src/shared";
import api from "../../src/api";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import CodeSelect from "../_common/codeSelect";
import ValidationServerErrors from "../_common/ValidationServerErrors";
import ExpensesBasicDataForm from "./tabs/basic_data";
import ExpensesDetailsForm from "./tabs/expensesDetailsForm";

export default {
    name: "expensesMoves",
    components: {ExpensesDetailsForm, ExpensesBasicDataForm, ValidationServerErrors, CodeSelect},
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    validations() {
        return {
            form: {
                name: {required},
                address: {required},
                priority_cd: {required},
                start_date: {required},
                end_date: {required},
                details: {required},
            }
        }
    },
    data() {
        return {
            title: "حركات المصروف",
            form: {},
            edit_route: "editAgenda",
            loading: false,
            api_url: "/api/agenda",
            errors:[],
            teams:[],
        }
    },
    async created() {
        api.vw = this;
        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.form = await api.show(this.$route.params.id)
        }
    },
    methods: {
        async submit() {
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            if (this.$router.currentRoute.value.name === this.edit_route) {
                await api.update();
            } else {
                await api.store();
            }
        },
    },

}
</script>


