<template>
    <!--begin::List Widget 3-->
    <div className="card card-xl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div className="card-header border-0">
            <h3 className="card-title fw-bolder text-dark"> {{title}}</h3>
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
                    <a :href="c.url" className="text-gray-800 text-hover-primary fw-bolder fs-6">{{c.employee.full_name}}</a>
                    <span className="text-muted fw-bold d-block"> {{c.created_at}}</span>
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
    name: "hrHomeEmployeesRequest",
    props: {
        title: {
            type: String,
            required: true,
            default: "طلبات الموظفين",
        }
    },
    data:function(){
        return {

            results:[
                {date:"1/4/2023" , type:"'طلب اجازة'",employee:"محمد أحمد", title:" طلب اجازة لمدة أسبوع", url:""},
                {date:"1/4/2023" , type:"'طلب سلفة'", employee:"خالد", title:"طلب سلفة من الراتب", url:""},
                {date:"1/4/2023" , type:"'طلب اذن خروج'",employee:"علي",  title:"اذن خروج", url:""},
            ]
        };
    },
    methods:{
        setData(data){
            this.results=data;
        }
    },
}
</script>


