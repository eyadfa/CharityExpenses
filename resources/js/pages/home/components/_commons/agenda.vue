<template>
    <div className="card card-xxl-stretch mb-5">
        <!--begin::Header-->
        <div className="card-header align-items-center border-0 mt-4">
            <h3 className="card-title align-items-start flex-column">
                <span className="fw-bolder mb-2 text-dark"> الأجندة</span>
                <span className="text-muted fw-bold fs-7"></span>
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
                    <div className="timeline-label fw-bolder text-gray-800 fs-6">{{c.start_date}}</div>
                    <!--end::Label-->
                    <!--begin::Badge-->
                    <div className="timeline-badge">
                        <i className="fa fa-genderless text-warning fs-1"></i>
                    </div>
                    <!--end::Badge-->
                    <!--begin::Text-->
                    <div className="fw-normal timeline-content  ps-3">
                        <a class="text-gray-800 text-hover-primary fw-bolder fs-6" :href="sanitizeUrl(c.url)">{{c.name}}</a>
                        <div class="text-muted">
                            {{c.priority.desc_ar}}
                        </div>
                    </div>
                    <div class="text-muted">{{c.end_date}}</div>
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
import shared from "../../../../src/shared";
import DOMPurify from "dompurify";

export default {
    name: "Agenda",
    data: function () {
        return {
            results: [],
            api_search: "/api/agenda/latest",
            add_title: '،جندة جديدة',
            add_url: this.$router.resolve({name: 'addAgenda'}),
        }
    },
    created() {
        this.search();
    },
    methods: {
        async search() {
            this.results = (await shared.post(this.api_search)).data;
        },
        sanitizeUrl(url) {
            return DOMPurify.sanitize(url);
        },
    }
}
</script>


