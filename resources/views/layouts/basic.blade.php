<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
    <!--begin::Head-->
    <head><base href="../">
        <meta charset="utf-8" />
        <title>{{env('APP_NAME')}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Updates and statistics">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->

        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
        @yield("css")


        <style>
            @font-face {
                font-family: 'Droid Arabic Kufi';
                font-style: normal;
                font-weight: 400;
                src: url(/assets/fonts/DroidKufi/DroidKufi-Regular.ttf) format('truetype');
            }
            @font-face {
                font-family: 'Droid Arabic Kufi';
                font-style: normal;
                font-weight: 700;
                src: url(/assets/fonts/DroidKufi/DroidKufi-Bold.ttf) format('truetype');
            }

            *{
                font-family: 'Droid Arabic Kufi';
                font-weight: normal;
                font-style: normal;
            }
            #toast-container > .toast {
                background-image: none !important;
            }

            th , .table th { font-size: 13px; padding: 0.25rem;}
            td ,.table td  { font-size: 12px; padding: 0.25rem; text-align: center;}
            td .btn{padding: 0.25rem; font-size: 11px;}

            @media (min-width: 1025px){
                .kt-header--fixed.kt-subheader--fixed.kt-subheader--enabled .kt-wrapper {
                    padding-top: 50px;
                }
                .kt-widget17{
                    padding-top: 119px;
                }
            }

            .select2-container--open .select2-dropdown { transform: translate(100%, 0); }
        </style>
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    @yield("body")
    <!--end::Body-->

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->

    @stack("js")
    <!--end::Javascript-->

</html>
