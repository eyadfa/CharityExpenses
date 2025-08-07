<template>

    <div v-loading="loading" class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <div class="container my-5">
                        <h2 class="text-center mb-4">Record Modification Details</h2>

                        <!-- Modification Card -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <i class="bi bi-person-fill"></i> Modified by: <strong>Sarah Ali</strong>
                                <span class="float-end"><i class="bi bi-clock-fill"></i> 2025-08-06 10:15 AM</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Field: <span class="text-info">Email</span></h5>
                                <p class="mb-1"><strong>Old Value:</strong> sarah@example.com</p>
                                <p class="mb-1"><strong>New Value:</strong> sarah.ali@company.com</p>
                                <p><strong>Reason for Change:</strong> User updated her company domain email.</p>
                            </div>
                        </div>

                        <!-- Another Modification Card -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-success text-white">
                                <i class="bi bi-person-fill"></i> Modified by: <strong>Admin</strong>
                                <span class="float-end"><i class="bi bi-clock-fill"></i> 2025-08-06 12:42 PM</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Field: <span class="text-info">Account Status</span></h5>
                                <p class="mb-1"><strong>Old Value:</strong> Inactive</p>
                                <p class="mb-1"><strong>New Value:</strong> Active</p>
                                <p><strong>Reason for Change:</strong> User completed verification process.</p>
                            </div>
                        </div>

                        <!-- Add more cards as needed -->
                    </div>
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
    name: "expensesView",
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
            title: " تفاصيل المصروف",
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


