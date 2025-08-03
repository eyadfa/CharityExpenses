<template>

    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">

                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1_1"> {{title}}</a>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_1" role="tabpanel">
                            <data_table/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->


</template>



<script>
import  data_table  from './tabs/table';
export default {
    name: "tasks",
    components:{data_table},
    data() {
        return {

            title:"ادارة المهام"
        }
    },
    created() {

    },
    methods: {
        showAlert() {
            // Use sweetalert2
            this.$swal('Hello Vue world!!!');
        },
    },

}
</script>


