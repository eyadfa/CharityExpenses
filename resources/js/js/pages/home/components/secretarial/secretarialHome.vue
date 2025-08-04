<template>

    <div className="row gy-5 g-xl-8">
        <div className="col-xxl-4 ">
            <quick_access :quick_links="quick_links"></quick_access>
        </div>
        <div className="col-xxl-8 ">
            <charts></charts>
        </div>
        <div className="col-xxl-4">
            <appointments></appointments>
        </div>
        <div className="col-xxl-4">
            <new-mailing ></new-mailing>
        </div>
        <div className="col-xxl-4">
            <my-followups></my-followups>
        </div>
    </div>
    <div className="row gy-5 g-xl-8">
        <div className="col-xxl-4">
            <depts-requests></depts-requests>
        </div>
        <div className="col-xl-8">
            <my-tasks></my-tasks>
        </div>
    </div>


</template>

<script>
import quick_access from "../_commons/quick_access";
import charts from "./charts";
import appointments from "./appointments";
import newMailing from "../_commons/newMailing";
import deptsRequests from "../_commons/deptsRequests";
import myFollowups from "../_commons/myFollowups";
import myTasks from "../_commons/myTasks";
export default {
    components:{quick_access,charts , appointments, newMailing, deptsRequests, myFollowups, myTasks},
    name: "adminHome",
    data(){
        return{
            quick_links:[
                {
                    "title":"موعد جديد" , "url":this.$router.resolve({ name: 'addAppointment' }),
                    "class":"bg-light-primary", "icon":"fas fa-user-plus"
                },
                {
                    "title":"مراسلة جديدة" , "url":this.$router.resolve({ name: 'addMailExternal' }),
                    "class":"bg-light-success", "icon":"fas fa-tasks"
                },
                {
                    "title":"اجتماع جديد" , "url":this.$router.resolve({ name: 'addMeetingBoard' }),
                    "class":"bg-light-warning", "icon":"fas fa-mail-bulk"
                },
                {
                    "title":" مهمة جديدة" , "url":this.$router.resolve({ name: 'addTask' }),
                    "class":"bg-light-danger", "icon":"fa fa-comment-alt "
                },
                {
                    "title":"تغيير كلمة المرور" , "url":this.$router.resolve({ name: 'changePassword' }),
                    "class":"bg-light-primary", "icon":"fab fa-watchman-monitoring"
                },
                {
                    "title":"التنبيهات" , "url":this.$router.resolve({ name: 'notifications' }),
                    "class":"bg-light-success", "icon":"far fa-bell"
                },
            ],

        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    }
}
</script>

