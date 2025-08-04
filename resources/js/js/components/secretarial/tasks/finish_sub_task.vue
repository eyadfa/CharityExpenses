<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ form.title }} </h2>
                </div>
                <div class="card-body">
                    <div class="col-md-12 fv-row ">
                        <div class="row">
                            <div class="col-md-4 fv-row">
                                <label class="col-md-3 fv-row">الاسم</label>
                                <input v-model="form.participant.participant_name" disabled class="form-control form-control-solid" type="text"/>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label>تاريخ البداية:</label>
                                <input v-model="form.start_date" disabled class="form-control form-control-solid" type="text"/>
                            </div>

                            <div class="col-md-3 fv-row ">
                                <label>تاريخ الاستحقاق :</label>
                                <input v-model="form.due_date" disabled class="form-control form-control-solid" type="text"/>
                            </div>

                        </div>

                    </div>


                    <div class="col-md-12 fv-row  mt-5">
                        <div class="row">
                            <hr/>
                            <div class="col-12 ">
                                <label class="required fs-5 fw-bold mb-2">ملاحظة الاغلاق</label>
                                <input class="form-control form-control-solid" type="text" v-model="form.finish_note" />
                                <span v-for="error of v$.form.finish_note.$errors"
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

import {useVuelidate} from '@vuelidate/core'
import {required} from '@vuelidate/validators'
import api from "../../../src/api";
import shared from "../../../src/shared";

export default {
    name: "subTaskForm",
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            title: "  مهمة جديدة",
            form: {},
            api_url: "/api/tasks/sub",

        }
    },
    validations() {
        return {
            form: {
                finish_note: {required}
            }
        }
    },
    async  created() {
        api.vw=this;
        this.form = (await  api.show(this.$route.params.id)).data;
    },
    methods: {
        async submit() {
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            await api.finish();
        },
    },

}
</script>


