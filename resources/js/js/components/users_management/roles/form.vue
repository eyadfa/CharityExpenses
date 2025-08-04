<template>


    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="mt-5"> {{ title }} </h2>
                </div>

                <div class="card-body">

                    <form class="form" method="post" id="kt_modal_departments_form">

                        <div class="row mb-5">

                            <div class="col-md-4 fv-row">
                                <label class="required fs-5 fw-bold mb-2">الاسم</label>
                                <input type="text" class="form-control form-control-solid" v-model="form.title" />
                                <span class="text-danger fw-light" v-for="error of v$.form.title.$errors" :key="error.$uid">
                                    <p>{{ msg(error) }}</p>
                                </span>
                            </div>


                            <div >
                                <div v-for="c in permissions">
                                    <h4>{{c.title}}</h4>
                                    <div class="mt-5" v-for="p in c.pages" >
                                        <h6>{{p.title}}</h6>
                                        <div class="row">
                                            <div class="form-check form-check-custom form-check-solid  mt-5 col-2"
                                                 v-for="perm in p.permissions"  >
                                                <input v-model="perm.status" class="form-check-input ml-2" type="checkbox" :key="perm.id"  :value="perm.id">
                                                {{perm.caption}}
                                            </div>
                                        </div>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-center">
                            <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                                <span class="indicator-label" :class="{'visually-hidden':loading}">حفظ</span>
                                <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
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
import { required, minLength  } from '@vuelidate/validators'
import api from "../../../src/api";
import shared from "../../../src/shared";
export default {
    name: "rolesForm",
    setup() {
        return {v$: useVuelidate()}
    },
    validationConfig: {
        $dirty: true,
    },
    data() {
        return {
            title: "الأدوار",
            loading:false,
            options: [
                { value: '1', label: 'user-show' },
            ],
            form: {title:"", perms: []},
            edit_route:"editRole",
            base_route : "roles",
            api_url: "/api/roles",
            permissions:[],
        }
    },
    validations() {
        return {
            form: {
                title: {required, min: minLength(5)}
            }
        }
    },
    async created() {
        api.vw=this;
        if (this.$router.currentRoute.value.name === this.edit_route) {
            this.form = await shared.show(this.api_url, this.$route.params.id)
            this.permissions = this.form.permissions;
        }else{
            this.permissions = (await shared.get("/api/permissions/permsM")).data;
        }


    },
    methods: {
        async submit() {
            this.v$.form.$touch();
            if (this.v$.form.$invalid) {
                shared.alert("يوجد بيانات مفقودة");
                return;
            }
            this.form.perms = this.permissions
            if (this.$router.currentRoute.value.name === this.edit_route) {
                await api.update();
            } else {
                await api.store();
            }

        },

    },

}
</script>

