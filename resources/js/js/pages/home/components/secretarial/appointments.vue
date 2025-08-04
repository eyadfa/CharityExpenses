<template>
    <div className="card card-xxl-stretch mb-5">
        <!--begin::Header-->
        <div className="card-header align-items-center border-0 mt-4">
            <h3 className="card-title align-items-start flex-column">
                <span className="fw-bolder mb-2 text-dark"> تذكير</span>
                <span className="text-muted fw-bold fs-7">20 موعد</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div className="card-body pt-5">
            <!--begin::Timeline-->
            <div className="timeline-label">
                <!--begin::Item-->
                <div v-for="c in results" className="timeline-item">
                    <!--begin::Label-->
                    <div className="timeline-label fw-bolder text-gray-800 fs-6">{{c.time}}</div>
                    <!--end::Label-->
                    <!--begin::Badge-->
                    <div className="timeline-badge">
                        <i className="fa fa-genderless text-warning fs-1"></i>
                    </div>
                    <!--end::Badge-->
                    <!--begin::Text-->
                    <div className="fw-normal timeline-content  ps-3">
                        <a class="text-gray-800 text-hover-primary fw-bolder fs-6" :href="c.url">{{c.title}}</a>
                        <div class="text-muted">
                            {{c.type}}
                        </div>
                    </div>
                    <div class="text-muted">{{c.date}}</div>
                    <!--end::Text-->
                </div>
                <!--end::Item-->

            </div>
            <!--end::Timeline-->
        </div>
        <!--end: Card Body-->
    </div>
</template>

<script>
export default {
    name: "appointments",
    data:function(){
        return {
            results:[
                {time:"8:45" , date:"1/4/2023" , type:"مواعيد مجلس الادارة", title:"اجتماع مع مؤسسة", url:""},
                {time:"8:45" , date:"1/4/2023" , type:"مراسلات داخلية", title:"اجتماع مع مؤسسة", url:""},
                {time:"8:45" , date:"1/4/2023" , type:"اجتماعات مجلس الادارة", title:"اجتماع مع مؤسسة", url:""},
                {time:"8:45" , date:"1/4/2023" , type:"متابعات", title:"اجتماع مع مؤسسة", url:""},
                {time:"8:45" , date:"1/4/2023" , type:"مهام", title:"اجتماع مع مؤسسة", url:""},
            ]
        };
    }
}
</script>


