<template>

    <div v-loading="loading" class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>
                <div class="card-body">

                    <validation-server-errors :errors="errors" />
                    <form class="form" method="post">

                        <div class="row mb-5">

                            <div class="col-md-12 fv-row">
                                <label class="required fs-5 fw-bold mb-2">العنوان </label>
                                <input type="text" v-model="form.title" class="form-control form-control-solid"  />
                                <span v-for="error of v$.form.title.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="mb-10 col-md-3">
                                <code-select :main_cd="115" title="متعلقة بـ"  v-model:sub_cd="form.related_to" />
                                <span v-for="error of v$.form.related_to.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-3 fv-row">
                                <label class=" fs-5 fw-bold mb-2">رقم النموذج التابع </label>
                                <input type="number" v-model="form.item_id" class="form-control form-control-solid" />
                            </div>

                            <div class="col-md-3 fv-row">
                                <code-select :main_cd="116" title="مصدر التكليف"  v-model:sub_cd="form.commissioning_source_cd" />
                                <span v-for="error of v$.form.commissioning_source_cd.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">جهة التكليف</label>
                                <input type="text" class="form-control form-control-solid" v-model="form.commissioner" />
                                <span v-for="error of v$.form.commissioner.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2"> المكلف بالمتابعة</label>
                                <select v-model="form.follower_id" class="form-select form-select-solid">
                                    <option  v-for="(c , index) in employees" :value="c.id" :key="c.id"> {{ c.full_name}}</option>
                                </select>
                                <span v-for="error of v$.form.follower_id.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>


                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">تاريخ  الاستحقاق:</label>
                                <input  type="date" v-model="form.due_date" class="form-control form-control-solid" />
                                <span v-for="error of v$.form.due_date.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-6 fv-row">
                                <label class="required fs-5 fw-bold mb-2"> نص المتابعة</label>
                                <textarea v-model="form.details" class="form-control form-control-solid" rows="5"></textarea>
                                <span v-for="error of v$.form.details.$errors" :key="error.$uid"
                                      class="text-danger fw-light">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label class=" fs-5 fw-bold mb-2"> ملاحظات</label>
                                <textarea v-model="form.notes" class="form-control form-control-solid" rows="5"> </textarea>
                            </div>
                        </div>

                        <div class="d-flex flex-center">
                            <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                                <span class="indicator-label">حفظ</span>
                            </button>
                            <button @click.prevent="$router.back()" class="btn btn-light me-3">تراجع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
import {useVuelidate} from '@vuelidate/core'
import {required} from '@vuelidate/validators'
import shared from "../../../src/shared";
import api from "../../../src/api";
import ValidationServerErrors from "../../_common/ValidationServerErrors";

export default {
    name: "followupForm",
    components: {ValidationServerErrors},
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            title: "  متابعة جديدة",
            employees: [],
            form:{},
            edit_route: "editfollowups",
            base_route: "followups",
            api_url: "/api/followups",
            errors:[],
            loading:false,
        }
    },
    validations() {
        return {
            form: {
                title: {required},
                follower_id: {required},
                related_to: {required},
                commissioning_source_cd: {required},
                commissioner: {required},
                details: {required},
                due_date: {required}
            }
        }
    },
    async created() {
        api.vw=this;
        this.employees =await shared.employees();
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


