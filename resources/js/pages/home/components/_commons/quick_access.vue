<template>
    <!--begin::Mixed Widget 2-->
    <div className="card card-xxl-stretch mb-5">
        <!--begin::Header-->
        <div className="card-header border-0 bg-primary py-5">
            <h3 className="card-title fw-bolder text-white">الوصول السريع</h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div className="card-body p-0" style="position: relative;">

            <!--begin::Stats-->
            <div className="card-p position-relative">
                <!--begin::Row-->
                <div className="row g-0">
                    <!--begin::Col-->
                    <div class="col-5 px-6 py-8 rounded-2 me-7 mb-7 "
                         v-for="link in quick_links" :class="link.class" >
                                <span className="svg-icon svg-icon-3x  d-block my-2 fa-3x " >
                                    <i :class="link.icon"></i>
								</span>
                        <a :href="link.url.fullPath" className=" fw-bold fs-6">{{link.title}}</a>
                    </div>
                    <!--end::Col-->

                </div>
                <!--end::Row-->

            </div>
            <!--end::Stats-->
            <div className="resize-triggers">
                <div className="expand-trigger">
                    <div style="width: 404px; height: 462px;"></div>
                </div>
                <div className="contract-trigger"></div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Mixed Widget 2-->
</template>

<script>
export default {
    name: "quick_access",
    props:["quick_links"],
}
</script>


