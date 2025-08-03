<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5">  {{ title }} </h2>
                </div>

                <div class="card-body">

                    <form class="form" method="post" >

                        <div class="row mb-5">
                            <div class="mb-10 col-md-3">
                                <label class="form-label fw-bold">النموذج الرئيسي :</label>
                                <select :disabled="is_edit" @change="setPages()" v-model="form.controller" class="form-select form-select-solid">
                                    <option v-for="c in controllers" :value="c" >{{c.name}}</option>
                                </select>
                                <span class="text-danger fw-light" v-for="error of v$.form.controller_id.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>

                            <div class="mb-10 col-md-3">
                                <label class="form-label fw-bold">النموذج الفرعي :</label>
                                <select :disabled="is_edit" @change.prevent="getPerms"  v-model="form.page_id" class="form-select form-select-solid">
                                    <option v-for="c in pages" :value="c.id" >{{c.name}}</option>
                                </select>
                                <span class="text-danger fw-light" v-for="error of v$.form.page_id.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الاسم</label>
                                <input :readonly="is_edit" type="text" class="form-control form-control-solid"  v-model="form.title" />
                                <span class="text-danger fw-light" v-for="error of v$.form.title.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                            <div class="col-md-3 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الوصف</label>
                                <input type="text" class="form-control form-control-solid" v-model="form.caption" />
                                <span class="text-danger fw-light" v-for="error of v$.form.caption.$errors"
                                      :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-center">
                            <button type="submit"  class="btn btn-primary" @click.prevent="submit()">
                                <span class="indicator-label" :class="{'visually-hidden':loading}">حفظ</span>
                                <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
                                <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
                            </button>
                            <button @click.prevent="$router.back()" class="btn btn-light me-3">تراجع</button>
                        </div>
                    </form>

                    <h4>{{page_perms}}</h4>
                    <h4>{{controller_hint}}</h4>
                    <el-table :data="perms" height="500" :stripe="true" style="width: 50%">
                        <el-table-column label="الاسم" prop="title" />
                        <el-table-column label="الوصف" prop="caption" />
                    </el-table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, minLength  } from '@vuelidate/validators'
import shared from "../../../src/shared";
import api from "../../../src/api";
    export default {
        name: "permissionForm",
        setup() {
            return {v$: useVuelidate()}
        },
        validationConfig: {
            $dirty: true,
        },
        data() {
            return {
                title: "الصلاحيات ",
                loading:false,
                form: {},
                edit_route:"editPermission",
                base_route : "permissions",
                api_url: "/api/permissions",
                controllers:[],
                pages:[],
                perms:[],
                page_perms:"",
                controller_hint:"",
                is_edit:false,
            }
        },
        validations() {
            return {
                form: {
                    title: {required, min: minLength(7)},
                    caption: {required, min: minLength(3)},
                    controller_id: {required},
                    page_id: {required},
                }
            }
        },
        async created() {
            api.vw=this;
            this.controllers = (await shared.search("/api/controllers")).data;
            if (this.$router.currentRoute.value.name === this.edit_route) {
                this.is_edit=true;
                this.form = await shared.show(this.api_url, this.$route.params.id)
                const controllerId = Number(this.form.controller_id); // Convert to number

                this.form.controller = this.controllers.find(controller => {
                    return Number(controller.id) === controllerId; // Strict equality check
                });
                this.setPages();
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
                    await api.store(false);
                    this.v$.form.$reset();
                    this.form.title="";
                    this.form.caption="";
                    this.getPerms();
                }
            },
            setPages(){
                this.form.controller_id =-1;
                this.pages=[];
                if(this.form.controller !== null){
                    this.form.controller_id= this.form.controller.id;
                    this.pages= this.form.controller.functions;
                }
            },
            async getPerms(){
                this.page_perms = "page_" + this.form.page_id;
                this.controller_hint = "Controller id :: " + this.form.controller_id;
                this.perms = (await shared.search(this.api_url, {page_id:this.form.page_id})).data;
            }
        },

    }
</script>


