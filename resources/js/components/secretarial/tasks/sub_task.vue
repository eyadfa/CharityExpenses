<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <div class="col-md-12 fv-row ">
                        <div class="row">
                            <div class="col-md-4 fv-row">
                                <label class="required fs-5 fw-bold mb-2">اسم الشخص المكلف</label>
                                <select v-model="form.assigned_to"  class="form-select form-select-solid" >
                                    <option v-for="c in team" :value="c.id" :key="c.id">{{ c.participant_name}}</option>
                                </select>
                                <span v-for="error of v$.form.assigned_to.$errors"
                                      :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label>تاريخ البداية:</label>
                                <input v-model="form.start_date" class="form-control form-control-solid" type="date"/>
                                <span v-for="error of v$.form.start_date.$errors"
                                      :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label>تاريخ الاستحقاق :</label>
                                <input v-model="form.due_date" class="form-control form-control-solid" type="date"/>
                                <span v-for="error of v$.form.due_date.$errors"
                                      :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-12 ">
                                <label class="required fs-5 fw-bold mb-2">المهمة</label>
                                <input class="form-control form-control-solid" type="text" v-model="form.title" />
                                <span v-for="error of v$.form.title.$errors"
                                      :key="error.$uid" class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                        </div>

                    </div>
                    <div class="d-flex flex-center mt-5 border-top-1 border-gray-300">
                        <button class="btn btn-primary" type="submit" @click.prevent="submit()">
                            <span class="indicator-label">حفظ</span>
                        </button>
                        <button class="btn btn-light me-3" @click.prevent="$router.back()">تراجع</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>



<script>
import Multiselect from '@vueform/multiselect';

import {useVuelidate} from '@vuelidate/core'
import {required} from '@vuelidate/validators'
import shared from "../../../src/shared";
import api from "../../../src/api";
import ValidationServerErrors from "../../_common/ValidationServerErrors";

export default {
    name: "subTaskForm",
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    components: {
        ValidationServerErrors,
        Multiselect
    },
    data() {
        return {
            title: "  مهمة فرعية جديدة",
            form: {},
            team:[],
            edit_route:"editSubTask",
            api_url: "/api/tasks/sub",
            errors:[],

        }
    },
    validations() {
        return {
            form: {
                title: {required},
                assigned_to: {required},
                start_date: {required},
                due_date: {required}
            }
        }
    },
   async  created() {
        api.vw=this;
        let task_id = this.$route.params.id;
       if (this.$router.currentRoute.value.name === this.edit_route) {
           this.form = (await shared.show(this.api_url, this.$route.params.id)).data
           task_id= this.form.task_id;
       }
       this.team = (await shared.get('/api/tasks/participant/' + task_id)).data;
    },
    methods: {
        async submit() {
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            if (this.$router.currentRoute.value.name !== this.edit_route) {
                this.form.task_id = this.$route.params.id;
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


