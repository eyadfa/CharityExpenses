<!-- Wizard.vue -->
<template>


    <div v-show="currentStep > 0" class="card mb-5 mb-xxl-8">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a  class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{form.full_name}}</a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a  class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <span class="svg-icon svg-icon-4 me-1">	{{ form.id}}</span>
                                </a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        <div class="d-flex my-4">
                            <button @click.prevent="$router.back()" class="me-3 btn btn-sm btn-light-dark ">الرجوع لادارة المصروفات</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder counted" >{{form.team}}</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400"> الفريق</div>
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder counted" >{{form.bill_date}}</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">تاريخ الفاتورة</div>
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder counted">{{form.agent}}</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">الجهة المرتبطة</div>
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder counted">{{form.band}}</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">بند المصروف</div>
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder counted">{{form.total}}</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">المبلغ الاجمالي بالشيكل</div>
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-bold fs-6 text-gray-400">نسبة الانجاز</span>
                                <span class="fw-bolder fs-6">{{progress}}%</span>
                            </div>

                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

        </div>
    </div>
    <div class="card">

        <div class="card-body">

            <el-steps :active="currentStep" finish-status="success"  :space="20"  simple>
                <el-step title="البيانات الأساسية" :icon="editIcon" />
                <el-step title="تفاصيل الفاتورة" :icon="UploadFilledIcon" />
            </el-steps>


            <div v-show="currentStep === 0">
                <!-- البيانات الأساسية -->
                <expenses-basic-data-form   ref="basic_tab" :wizard="true" @nextStep="nextStep"/>
                <el-button @click="nextStep">التالي</el-button>
            </div>
            <div v-show="currentStep === 1">
                <!-- تفاصيل الفاتورة -->
                <expenses-details-form ref="details_tab" :wizard="true" @nextStep="nextStep"/>
                <el-button type="primary" @click="finish">إنهاء</el-button>
            </div>

        </div>
    </div>
</template>

<script>
import {markRaw} from "vue";
import { Edit, Picture, UploadFilled } from '@element-plus/icons-vue'
import {round} from "lodash/math";
import ExpensesForm from "./form";
import ExpensesDetailsForm from "./tabs/expensesDetailsForm";
import ExpensesBasicDataForm from "./tabs/basic_data";
export default {
    components:{
        ExpensesBasicDataForm,
        ExpensesDetailsForm,
        ExpensesForm, Edit,Picture,UploadFilled},
    data() {
        return {
            editIcon: markRaw(Edit),
            pictureIcon: markRaw(Picture),
            UploadFilledIcon: markRaw(UploadFilled),
            currentStep: 0,
            form:{nationality:{desc_ar:""}},
        };
    },
    computed: {
        progress() {
            return round(100 * this.currentStep/2,2);
        }
    },
    methods: {
        async nextStep() {
            this.form={bill_date:"05/08/2025", agent:"مطبخ السعادة", team:"فريق خانيونس", band:"تكية", total:1250};
            this.currentStep++; // for MVP
            return; //for MVP
            if (this.currentStep < 2) {
                let res = false;
                switch (this.currentStep) {
                    case 0:
                        res = await (this.$refs.basic_tab.submit());
                        break;
                    case 1:
                        res = await (this.$refs.details_tab.submit());
                        break;
                }
                if (res)
                    this.currentStep++;
            }
        },
        prevStep() {
            if (this.currentStep > 0) {
                this.currentStep--;
            }
        },
        finish() {
            // Handle finish action
           // console.log('Wizard finished!');
            let add_url = this.$router.resolve({name: 'familiesMurtyre'});
            this.$router.push(add_url)
        },
        setFamilyData(family){
            this.family = family;
            this.family_id =family.id;
            this.form= family;
            this.image_path = "/" + family.image_path;
        }
    },
};
</script>

<style scoped>
/* Add this CSS to your styles to handle RTL */
.el-step__arrow {
    right: auto;
    left: 20px; /* Adjust the value as needed */
}

.el-step__title {
    text-align: right;
}

.el-step__description {
    text-align: right;
}

/* If needed, adjust the padding for the content inside el-step */
.el-step__main {
    padding: 0 20px; /* Adjust the value as needed */
}
.el-steps--simple {
    padding: 5px ;
    border-radius: 4px;
    background: var(--el-fill-color-light);
}
.el-step.is-simple .el-step__arrow {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: rotate(90deg);
}
</style>
