<template>

    <div class="row gy-5 g-xl-8">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab_1">{{ title }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                            <Codes />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
import Codes from './tabs/table';
export default {
    name: "codesIndex",
    components: { Codes },
    data() {
        return {
            title: 'ثوابت النظام',
        }
    },

}
</script>


