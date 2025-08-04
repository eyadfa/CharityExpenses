<template>

    <!--begin::Row-->
    <div className="row gy-5 g-xl-8">
        <!--begin::Col-->
        <div className="col-xxl-4 ">
            <quick_access :quick_links="quick_links"></quick_access>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div className="col-xxl-8 ">
            <charts></charts>
        </div>
        <!--end::Col-->

    </div>
    <!--end::Row-->
    <div className="row gy-5 g-xl-8">
        <div className="col-xxl-4">
            <my-followups></my-followups>
        </div>
        <div className="col-xxl-4">
            <agenda/>
        </div>
        <div className="col-xl-8">
            <my-tasks></my-tasks>
        </div>
    </div>



</template>

<script>
import quick_access from "../_commons/quick_access";
import charts from "./charts";
import MyTasks from "../_commons/myTasks";
import Agenda from "../_commons/agenda";
import MyFollowups from "../_commons/myFollowups";
export default {
    name: "adminHome",
    components:{MyFollowups, Agenda, MyTasks, quick_access,charts},
    data(){
        return{
            quick_links:[
                {
                    "title":"مستخدم جديد" , "url":this.$router.resolve({ name: 'addUser' }),
                    "class":"bg-light-primary", "icon":"fas fa-user-plus"
                },
                {
                    "title":"قسم جديد" , "url":this.$router.resolve({ name: 'addDepartment' }),
                    "class":"bg-light-success", "icon":"fas fa-tasks"
                },
                {
                    "title":"ثوابت النظام" , "url":this.$router.resolve({ name: 'codes' }),
                    "class":"bg-light-warning", "icon":"fas fa-mail-bulk"
                },
                {
                    "title":"تغيير كلمة المرور" , "url":this.$router.resolve({ name: 'changePassword' }),
                    "class":"bg-light-primary", "icon":"fab fa-watchman-monitoring"
                },
                {
                    "title":"التنبيهات" , "url":this.$router.resolve({ name: 'notifications' }),
                    "class":"bg-light-success", "icon":"far fa-bell"
                },
            ]
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    }
}
</script>

