<template>
    <div class="card card-xl-stretch mb-5 ">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">ادارة المستخدمين</span>
                <span class="text-muted mt-1 fw-bold fs-7">
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary show menu-dropdown" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                        <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks-2.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                    <!--begin::Menu 3-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true" data-popper-placement="top-end" style="z-index: 105; position: fixed; inset: auto auto 0px 0px; margin: 0px; transform: translate(910px, 86.3125px);" data-popper-reference-hidden="">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">العمليات</div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" id="user_edit">تعديل</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" id="user_activate">تفعيل</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link flex-stack px-3" id="user_deactivate">الغاء تفعيل
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_user">اضافة مستخدم جديد</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" id="user_destroy" >حذف</a>
                        </div>
                        <!--end::Menu item-->

                    </div>
                    <!--end::Menu 3-->
                    <!--end::Menu-->

                    &nbsp;&nbsp;

                    <div class="me-4" data-select2-id="select2-data-76-uqdj">
                        <!--begin::Menu-->
                        <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            <!--begin::Svg Icon | path: icons/duotone/Text/Filter.svg-->
                            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->البحث</a>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-450px w-md-500px" data-kt-menu="true" style="" data-select2-id="select2-data-75-5w43">

                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <form method="post" id="users_search_formx" >
                                <div class="px-7 py-5">

                                    <div class="row">

                                        <div class="mb-10 col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">الاسم:</label>
                                            <!--end::Label-->
                                            <input type="text" name="full_name" class="form-control form-control-solid"/>

                                        </div>


                                        <div class="mb-10 col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">القسم :</label>
                                            <!--end::Label-->
                                            <select name="department" class="form-select form-select-solid">
                                                <option value="-1">الكل</option>
                                                <option v-for=" dept in departments" :value="dept.id">{{ dept.name}}</option>
                                            </select>

                                        </div>
                                        <div class="mb-10 col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">النوع :</label>
                                            <!--end::Label-->
                                            <select name="user_type" class="form-select form-select-solid">
                                                <option value="-1">الكل</option>

                                                <option v-for="ut in user_types" :value="ut.id">{{ ut.name}}</option>


                                            </select>

                                        </div>
                                        <div class="mb-10 col-md-6">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">الحالة :</label>
                                            <!--end::Label-->
                                            <select name="status" class="form-select form-select-solid">
                                                <option value="-1">الكل</option>
                                                <option value="0">غير فعال</option>
                                                <option value="1">فعال</option>
                                            </select>
                                        </div>

                                        <div class="mb-10 col-md-4">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">انشاء حزم :</label>
                                            <!--end::Label-->
                                            <select name="can_create" class="form-select form-select-solid">
                                                <option value="-1">الكل</option>
                                                <option value="0">نعم</option>
                                                <option value="1">لا</option>
                                            </select>
                                        </div>

                                        <div class="mb-10 col-md-4">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold"> محصل :</label>
                                            <!--end::Label-->
                                            <select name="can_cash" class="form-select form-select-solid">
                                                <option value="-1">الكل</option>
                                                <option value="1">نعم</option>
                                                <option value="0">لا</option>
                                            </select>
                                        </div>

                                        <div class="mb-10 col-md-4">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">ترحيل الصندوق:</label>
                                            <!--end::Label-->
                                            <select name="can_transfer_to_box" class="form-select form-select-solid">
                                                <option value="-1">الكل</option>
                                                <option value="1">نعم</option>
                                                <option value="0">لا</option>
                                            </select>
                                        </div>

                                    </div>
                                    <!--begin::Actions-->
                                    <div class="d-flexjustify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">تفريغ</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">بحث</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                        <!--end::Menu-->
                    </div>
                </div>
            </span>

            </h3>
            <div class=                                        "card-toolbar" data-bs-toggle="toolt                                        ip" data-bs-placement="top" data-bs-trigger="                                    hover" title="" data-bs-origina                                    l-title="اضغط هنا لاضافة مستخدم جديد">
                <a href="#" class="btn btn-sm                                btn-light-primary ml-2 mr-                        2" data-bs-toggle="moda                        l" data-bs-target="#kt_modal_new_user">
                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                    <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                    </svg>
                </span>
                    <!--end::Svg Icon-->مستخدم جديد</a>

            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="users_table" class="table table-row-dashed table-row-gray-300  gs-0 gy-4 table-striped">
                    <thead>
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#users_table .form-check-input" value="1"/>
                            </div>
                        </th>
                        <th>اسم المستخدم</th>
                        <th>الاسم </th>
                        <th>القسم</th>
                        <th>المدينة</th>
                        <th>رقم الهاتف</th>
                        <th>نوع المستخدم</th>
                        <th>حالة المستخدم</th>
                        <th>ترحيل الصندوق</th>
                        <th> انشاء حزم جديدة</th>
                        <th> محصل</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
</template>

<script>
export default {
    name: "users",
    data(){
        return {
            departments:[],
            user_types:[],

        };
    },
}
</script>


