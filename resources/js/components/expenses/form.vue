<template>

    <div v-loading="loading" class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">

                <div class="card-body">
                    <expenses-basic-data-form />

                    <expenses-details-form />
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
    name: "expensesForm",
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
            title: "بند جديد",
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


