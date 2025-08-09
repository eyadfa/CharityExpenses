<template>

    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">

                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <validation-server-errors :errors="errors" />
                    <form class="form" method="post" >

                        <div class="row mb-5">

                            <div class="row">
                                <div class="col-md-3 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">الاسم</label>
                                    <input type="text"  v-model="form.name" disabled class="form-control form-control-solid" />
                                </div>

                                <div class="col-md-3 fv-row">
                                    <label class=" fs-5 fw-bold mb-2">اسم المستخدم</label>
                                    <input type="text" v-model="form.email" disabled class="form-control form-control-solid" />
                                </div>

                                <div class="col-md-3 fv-row">
                                    <label class=" fs-5 fw-bold mb-2">الرقم الوظيفي </label>
                                    <input type="text" v-model="form.related_emp_id" disabled class="form-control form-control-solid" />
                                </div>


                            </div>
                            <div class="row mt-5">

                                <div class="col-2  bg-light-success">
                                    <label class=" fs-5 fw-bold mb-2"> الأدوار</label>

                                    <div class="form-check form-check-custom form-check-solid mx-5 mt-5"
                                         v-for="role in roles"  >
                                        <input v-model="role.status" class="form-check-input" type="checkbox" :key="role.id" :value="role.id">{{role.title}}
                                    </div>
                                </div>

                                <div class="col-10 row bg-light-primary mr-5">
                                    <label class="required fs-5 fw-bold mb-2"> الصلاحيات</label>
                                    <div v-for="c in permissions">
                                        <h4>
                                            {{c.title}}
                                        </h4>
                                        <div class="mt-5" v-for="p in c.pages" >
                                            <h6>
                                                <input
                                                    @change="handlePagePermissions(c,p)"
                                                    class="form-check-input ml-2"
                                                    type="checkbox"
                                                    :checked="isPageChecked(p)"
                                                />
                                                {{p.title}}
                                            </h6>
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
                        </div>

                        <div class="d-flex flex-center">
                        <button type="submit" class="btn btn-primary" @click.prevent="submit()">
                            <span class="indicator-label" :class="{'visually-hidden':loading}">حفظ</span>
                            <span class="indicator-label" :class="{'visually-hidden':!loading}">جار الحفظ...</span>
                            <div class="spinner-border text-light" :class="{'visually-hidden': !loading}"></div>
                        </button>
                        <button @click.prevent="$router.back()" class="btn btn-light me-3">رجوع</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</template>



<script>

    import shared from "../../../src/shared";
    import api from "../../../src/api";
    import ValidationServerErrors from "../../_common/ValidationServerErrors";

    export default {
        name: "usersPermissions",
        components: {ValidationServerErrors},
        data(){
            return {
                title: "صلاحيات المستخدمين",
                loading:false,
                form: {},
                base_route : "users",
                api_url: "/api/users",
                api_update:"/api/users/update_permissions/",
                permissions: [],
                roles: [],
                errors:[],
            }
        },
        async created() {
            api.vw=this;
            this.form = await shared.show(this.api_url, this.$route.params.id)
            this.permissions = this.form.permissions;
            this.roles = this.form.roles;
            this.permissions=[
                {
                    "title": "المصروفات",
                    "pages": [
                        {
                            "title": " المصروفات",
                            "permissions": [
                                { "id": 1, "caption": "بحث", "status": true },
                                { "id": 1, "caption": "عرض", "status": true },
                                { "id": 2, "caption": "إضافة", "status": false },
                                { "id": 3, "caption": "تعديل", "status": false },
                                { "id": 4, "caption": "حذف", "status": false },
                                { "id": 5, "caption": "اعتماد", "status": false },
                                { "id": 6, "caption": "تصدير لاكسل", "status": false },
                                { "id": 7, "caption": "طباعة", "status": false },
                                { "id": 8, "caption": "عرض حركات التعديل", "status": false }
                            ]
                        },
                        {
                            "title": "استيراد المصروفات",
                            "permissions": [
                                { "id": 9, "caption": "استيراد المصروفات", "status": true },
                            ]
                        }
                    ]
                },
                {
                    "title": "إدارة المدفوعات",
                    "pages": [
                        {
                            "title": "المدفوعات ",
                            "permissions": [
                                { "id": 10, "caption": "بحث", "status": true },
                                { "id": 11, "caption": "عرض", "status": true },
                                { "id": 12, "caption": "إضافة", "status": false },
                                { "id": 13, "caption": "تعديل", "status": false },
                                { "id": 14, "caption": "حذف", "status": false },
                                { "id": 15, "caption": "اعتماد", "status": false },
                                { "id": 16, "caption": "تصدير لاكسل", "status": false },
                                { "id": 17, "caption": "طباعة", "status": false },
                                { "id": 18, "caption": "عرض حركات التعديل", "status": false }
                            ]
                        }
                    ]
                },
                {
                    "title": "التقارير",
                    "pages": [
                        {
                            "title": "تقرير المصروفات ",
                            "permissions": [
                                { "id": 19, "caption": "بحث", "status": true },
                                { "id": 20, "caption": "تصدير لاكسل", "status": false },
                                { "id": 21, "caption": "طباعة", "status": false },
                            ]
                        },
                        {
                            "title": "تقرير المدفوعات ",
                            "permissions": [
                                { "id": 22, "caption": "بحث", "status": true },
                                { "id": 23, "caption": "تصدير لاكسل", "status": false },
                                { "id": 24, "caption": "طباعة", "status": false },
                            ]
                        },
                        {
                            "title": "تقرير الفرق ",
                            "permissions": [
                                { "id": 25, "caption": "بحث", "status": true },
                                { "id": 26, "caption": "تصدير لاكسل", "status": false },
                                { "id": 27, "caption": "طباعة", "status": false },
                            ]
                        },
                        {
                            "title": "تقرير الجهات المرتبطة ",
                            "permissions": [
                                { "id": 28, "caption": "بحث", "status": true },
                                { "id": 29, "caption": "تصدير لاكسل", "status": false },
                                { "id": 30, "caption": "طباعة", "status": false },
                            ]
                        }
                    ]
                }
            ]


        },
        methods: {
            async submit() {
                let formx = {
                    perms:this.permissions,
                    roles:this.roles,
                    id:this.$route.params.id
                }

                let res = (await shared.post(this.api_update+`${this.$route.params.id}`, formx));
                if(res.status){
                    shared.success(res.message);
                    this.$router.push({name: this.base_route})
                }else{
                    this.errors=res.data;
                    shared.alert(res.message);
                }

            },


            handlePagePermissions(controller, page) {
                const isChecked = !this.isPageChecked(page);
                page.permissions.forEach(perm => {
                    perm.status = isChecked; // Check or uncheck inner permissions
                });
            },
            isControllerChecked(controller) {
                return controller.pages.every(page => page.checked);
            },
            isPageChecked(page) {
                return page.permissions.every(perm => perm.status);
            }

        },
    }
</script>


