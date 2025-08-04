<template>
    <!--begin::List Widget 3-->
    <div className="card card-xl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div className="card-header border-0">
            <h3 className="card-title fw-bolder text-dark">المتابعات</h3>
            <div className="card-toolbar">

            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div className="card-body pt-2">
            <!--begin::Item-->
            <div v-for="c in results" className="d-flex align-items-center mb-8">
                <!--begin::Bullet-->
                <span class="bullet bullet-vertical h-40px bg-warning"></span>
                <!--end::Bullet-->

                <!--begin::Description-->
                <div className="flex-grow-1 ps-5">
                    <router-link :to="{name: 'followupDetails', params: { id: c.id }}"
                                 class="text-gray-800 text-hover-primary fw-bolder fs-6">
                        {{c.title}}
                    </router-link>
                    <span className="text-muted fw-bold d-block"> {{c.sourcex.desc_ar}}</span>
                </div>
                <!--end::Description-->
                <span className="badge badge-light-success fs-8 fw-bolder"> {{c.created_at}} // {{c.due_date}}</span>
            </div>
            <!--end:Item-->

        </div>
        <!--end::Body-->
    </div>
    <!--end:List Widget 3-->
</template>

<script>
import shared from "../../../../src/shared";
export default {
    name: "myFollowups",
    data:function(){
        return {
            api_search: "/api/followups/latest",
            results:[]
        }
    },
    created() {
        this.search();
    },
    methods: {
        async search() {
            this.results = (await shared.post(this.api_search)).data;
        },
    }

}
</script>


