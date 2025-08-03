<template>
    <!--begin::List Widget 3-->
    <div className="card card-xl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div className="card-header border-0">
            <h3 className="card-title fw-bolder text-dark">طلبات الموظفين</h3>
            <div className="card-toolbar">

            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div className="card-body pt-2">
            <!--begin::Item-->
            <div v-for="c in results" className="d-flex align-items-center mb-8">
                <!--begin::Bullet-->
                <span class="bullet bullet-vertical h-40px bg-success"></span>
                <!--end::Bullet-->

                <!--begin::Description-->
                <div className="flex-grow-1 ps-5">
                    <a :href="c.url" className="text-gray-800 text-hover-primary fw-bolder fs-6">{{c.title}}</a>
                    <span className="text-muted fw-bold d-block"> {{c.employee}}</span>
                </div>
                <!--end::Description-->
                <span className="badge badge-light-success fs-8 fw-bolder"> {{c.date}}</span>
            </div>
            <!--end:Item-->

        </div>
        <!--end::Body-->
    </div>
    <!--end:List Widget 3-->
</template>
<script>
export default {
    name: "appointments",
    data:function(){
        return {
            results:[
                {date:"1/4/2023" , type:"'طلب سلفة'",employee:"محمد أحمد", title:" 200 $", url:""},
                {date:"1/4/2023" , type:"'طلب قرض'", employee:"خالد", title:"2500 $", url:""},
                {date:"1/4/2023" , type:"'طلب قرض'",employee:"علي",  title:"3000$", url:""},
            ]
        };
    }
}
</script>


