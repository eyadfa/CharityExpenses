<template>

    <div class="row gy-5 g-xl-8" v-loading="loading">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{title}} </h2>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <form class="form" method="post">

                        <div class="row mb-5">
                            <div class="mb-10 col-md-3">
                                <label class="form-label fw-bold">النموذج الرئيسي :</label>
                                <select @change="setPages()" v-model="form.controller" class="form-select form-select-solid">
                                    <option v-for="c in controllers" :value="c" >{{c.name}}</option>
                                </select>
                            </div>

                            <div class="mb-10 col-md-3">
                                <label class="form-label fw-bold">النموذج الفرعي :</label>
                                <select @change="filteringCodes()" v-model="form.page_id" class="form-select form-select-solid">
                                    <option v-for="c in pages" :value="c.id" >{{c.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2"> التصنيف الرئيسي</label>
                                <select v-model="form.main_cd" data-placeholder="اختر..."
                                    class="form-select form-select-solid">
                                    <option v-for="c in filteredCodes" :key="c.id" :value="c.main_cd">{{ c.desc_ar }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger fw-light" v-for="error of v$.form.main_cd.$errors"
                                    :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الوصف</label>
                                <input type="text" class="form-control form-control-solid" v-model="form.desc_ar" />
                                <span class="text-danger fw-light" v-for="error of v$.form.desc_ar.$errors"
                                    :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class=" fs-5 fw-bold mb-2">الوصف English</label>
                                <input type="text" class="form-control form-control-solid" v-model="form.desc_en" />
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class=" fs-5 fw-bold mb-2"> الحالة</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <span class="form-check-label fw-bold text-muted">غير فعال</span>
                                        <input class="form-check-input" v-model="form.is_active" name="status"
                                            type="checkbox" value="1" checked="checked" />
                                        <span class="form-check-label fw-bold text-muted">فعال</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-center">
                            <el-alert :closable="false"  v-if="filtered_length ==0"
                                      type="warning" title="لا يوجد أكواد رئيسية مرتبطة بانموذج الفرعي الحالي لذا لايمكن اضافة كود فرعي" />
                            <button v-else type="submit" class="btn btn-primary" @click.prevent="submit">
                                <span class="indicator-label" :class="{'visually-hidden':loading}">حفظ</span>
                                <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
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

import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength } from '@vuelidate/validators'
import shared from "../../../src/shared";
import ValidationServerErrors from "../../_common/ValidationServerErrors";
import {toInteger} from "lodash";
export default {
    name: "codesForm",
    components: {ValidationServerErrors},
    setup() {
        return { v$: useVuelidate() }
    },
    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            main_codes: [],
            form: { is_active: true },
            api_url:"/api/codes",
            edit_route:"editCode",
            loading: false,
            title: 'قيمة جديدة',
            controllers:[],
            pages:[],
            filteredCodes:[],
            errors:[],
            filtered_length:0,
        }
    },
    validations() {
        return {
            form: {
                main_cd: { required },
                desc_ar: { required, min: minLength(3) }
            }
        }
    },
    async created() {
        this.loading=true;
        this.controllers = (await shared.search("/api/controllers")).data;
        this.main_codes = (await shared.get('/api/codes/main')).data;

        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.form = await shared.show(this.api_url, this.$route.params.id)
            const controllerId = Number(this.form.controller_id); // Convert to number

            this.form.controller = this.controllers.find(controller => {
                return Number(controller.id) === controllerId; // Strict equality check
            });
            this.setPages();
            this.filteringCodes();
        }

        this.loading=false;
    },

    methods: {
        async submit() {
            this.errors=[];
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            if (this.$router.currentRoute.value.name === this.edit_route) {
                await this.update();
            } else {
                await this.add();
            }
        },
        async update() {
            this.loading = true;
            let res = await shared.update(this.api_url, this.form.id, this.form);
            shared.notify(res.message,res.status);
            if (res.status) {
                this.$router.back();
            }else{
                this.errors=res.data;
            }
            this.loading = false
        },
        async add() {
            this.loading = true;
            let res = await shared.store(this.api_url, this.form);
            shared.notify(res.message,res.status);
            if (res.status) {
                this.$router.back();
            }else{
                this.errors=res.data;
            }
            this.loading = false;
        },
        setPages(){
            this.form.controller_id =-1;
            this.pages=[];
            if(this.form.controller !== null){
                this.form.controller_id= this.form.controller.id;
                this.pages= this.form.controller.functions;
            }
            this.filteredCodes=[];
            this.filtered_length=0;
        },
        filteringCodes(){
            // Filter the data based on controller_id and page_id
            this.filteredCodes =  this.main_codes.filter(
                item =>
                    item.controller_id === this.form.controller_id &&
                    item.page_id === this.form.page_id
            );
            this.filtered_length= this.filteredCodes.length;
        }
    },

}
</script>


