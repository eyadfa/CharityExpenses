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
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1_1">الكل</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_1">ادارة المستخدمين</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3"> الأقسام</a>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="card-body">


                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="kt_tab_pane_1_1" role="tabpanel">
                           <All/>
                        </div>
                        <div class="tab-pane fade " id="kt_tab_pane_1" role="tabpanel">
                            <Users/>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                            <Departments/>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->


    <AddUser/>
    <AddDepartment/>


</template>



<script>
import All from '../users/tabs/all';
import Departments  from '../users/tabs/departments';
import Users from '../users/tabs/users';
import AddDepartment from "./modals/add_department";
import AddUser from "./modals/add_user";
export default {
    name: "users",
    components:{All,Departments,Users, AddUser,AddDepartment},

}
</script>


