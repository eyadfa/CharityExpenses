<template>
    <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
         data-kt-drawer-activate="{default: true, lg: false}"
         data-kt-drawer-direction="start" data-kt-drawer-name="aside"
         data-kt-drawer-overlay="true" data-kt-drawer-toggle="#kt_aside_mobile_toggle"
         data-kt-drawer-width="{default:'200px', '300px': '250px'}">
        <!--begin::Brand-->
        <div id="kt_aside_logo" class="aside-logo flex-column-auto">
            <!--begin::Logo-->
            <a href="/public">
                <h3 class="text-white">نظام ادارة البيانات</h3>
            </a>
            <!--end::Logo-->
            <!--begin::Aside toggler-->
            <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                 data-kt-toggle="true" data-kt-toggle-name="aside-minimize" data-kt-toggle-state="active"
                 data-kt-toggle-target="body">
                <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
                <span class="svg-icon svg-icon-1 rotate-180">
                <svg height="24px" version="1.1" viewBox="0 0 24 24"
                     width="24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.5"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
                    </g>
                </svg>
            </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Aside toggler-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid">
            <!--begin::Aside Menu-->
            <div id="kt_aside_menu_wrapper" class="hover-scroll-overlay-y my-5 my-lg-5" data-kt-scroll="true"
                 data-kt-scroll-activate="{default: false, lg: true}"
                 data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                 data-kt-scroll-height="auto" data-kt-scroll-offset="0"
                 data-kt-scroll-wrappers="#kt_aside_menu">
                <!--begin::Menu-->
                <div
                    id="#kt_aside_menu"
                    class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                    data-kt-menu="true">
                    <div class="menu-item">
                        <div class="menu-content pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">لوحة التحكم</span>
                        </div>
                    </div>

                    <div v-for="link in links" v-show="canDept(link.depts) && can(link.gate)" class="menu-item menu-accordion" data-kt-menu-trigger="click">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                            <span class="svg-icon svg-icon-2">
                               <i :class="link.icon"></i>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ link.caption }}</span>
                        <span class="menu-arrow"></span>
                    </span>

                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <MenuItemx v-for="f in link.functions" :item="f"></MenuItemx>

                        </div>
                    </div>

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->
        <!--begin::Footer-->

        <!--end::Footer-->
    </div>
</template>

<script>
export default {
    name: "asidex",
    data() {
        let links = [

            {
                caption: "الاعدادات",depts:[0], /*gate:["controller_2"],*/ icon:"fas fa-cogs", url: "/settings", "functions": [
                    {caption: "ثوابت النظام", url: "/codes"/*, gate: ["page_2"]*/},
                    {caption: "اعدادات النظام", url: "/settings" /*, gate: ["page_3"]*/},
                    {caption: "النماذج الرئيسية", url: "/controllers" /*, gate: ["page_4"]*/},
                    {caption: "الروابط الفرعية", url: "/functions"/* , gate: ["page_5"]*/},
                    {caption: "الجهات المرتبطة", url: "/parties" /* , gate: ["page_7"]*/},
                    {caption: "فرق العمل", url: "/teams" /* , gate: ["page_7"]*/},
                ]
            },
            {
                caption: "ادارة المستخدمين",depts:[0], /*gate:["controller_3"],*/ icon:"fas fa-user-cog", url: "/settings", "functions": [
                    {caption: "الصلاحيات", url: "/permissions" /*, gate: ["page_9"]*/},
                    {caption: "الأدوار", url: "/roles" /*, gate: ["page_10"]*/},
                    {caption: "المستخدمين", url: "/users" /*, gate: ["page_11"]*/},
                    {caption: "الأقسام", url: "/departments" /*, gate: ["page_12"]*/},
                    {caption: "التنبيهات", url: "/notifications" /*, gate: ["page_13"]*/},
                ]
            },
            {caption: "المصروفات" ,depts:["*"],/* gate:["controller_7"],*/ icon:"fas fa-tasks", url: "/expenses", "functions": [
                    {caption: "المصروفات",/*gate:["page_22"],*/ url: "/expenses"},
                    {caption: "استيراد المصروفات",/*gate:["page_22"],*/ url: "/expenses/import"}
                ]},
            {caption: "المدفوعات",depts:["*"], /*gate:["controller_8"],*/ icon:"fa fa-poll", url: "/payments", "functions": [
                    {caption: "المدفوعات", /*gate:["page_23"],*/ url: "/payments"}
                ]},
            {caption: " التقارير",depts:["*"], /*gate:["controller_12"],*/ icon:"far fa-list-alt", url: "/reports", "functions":[
                    {caption: " تقرير المصروفات", /*gate:["page_27"],*/ url: "/reports/expenses"},
                    {caption: " تقرير المدفوعات", /*gate:["page_27"],*/ url: "/reports/payments"},
                    {caption: " تقرير الفرق", /*gate:["page_27"],*/ url: "/reports/teams"},
                    {caption: " تقرير الجهات المرتبطة", /*gate:["page_27"],*/ url: "/reports/parties"},
                    {caption: " تقرير حركات المصروفات", /*gate:["page_27"],*/ url: "/reports/expenses/moves"},
                    {caption: " تقرير حركات المدفوعات", /*gate:["page_27"],*/ url: "/reports/payments/moves"},
                ]
            },



        ];
        return {
            links: links
        }
    },
}
</script>

]
