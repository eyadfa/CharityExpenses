<template>
    <!--begin::List Widget 3-->
    <div className="card card-xl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div className="card-header border-0">
            <h3 className="card-title fw-bolder text-dark">المراسلات</h3>
            <div className="card-toolbar">
                    <button class="btn btn-sm btn-light-primary float-end" type="button"
                            @click.prevent="this.$router.push(add_url)">
                        <span class="svg-icon svg-icon-3 fas fa-plus"></span>
                        {{ add_title }}
                    </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div className="card-body pt-2">
            <!--begin::Item-->
            <div v-for="c in mails" className="d-flex align-items-center mb-8">
                <!--begin::Bullet-->
                <span class="bullet bullet-vertical h-40px bg-warning"></span>
                <!--end::Bullet-->

                <!--begin::Description-->
                <div className="flex-grow-1 ps-5">
                    <router-link :to="{name: 'handleMailInternal', params: { id: c.id }}"
                                 class="text-gray-800 text-hover-primary fw-bolder fs-6">
                        {{c.title}}
                    </router-link>
                    <span className="text-muted fw-bold d-block"> {{c.sender.full_name}}</span>
                </div>
                <!--end::Description-->
                <span className="badge badge-light-success fs-8 fw-bolder"> {{c.created_at}}</span>
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
    name: "newMailing",
    data:function(){
        return {
            api_search: "/api/mail/mail/internal/latest",
            add_title: 'مراسلة جديدة',
            add_url: this.$router.resolve({name: 'addMailInternal'}),
            mails:[]
        }
    },
    created() {
        this.search();
    },
    methods: {
        async search() {
            this.mails = (await shared.post(this.api_search)).data;
        },
    }

}
</script>


