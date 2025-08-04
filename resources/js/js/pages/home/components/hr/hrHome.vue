<template>

    <div className="row gy-5 g-xl-8">
        <div className="col-xxl-4 ">
            <quick_access :quick_links="quick_links"></quick_access>
        </div>
        <div className="col-xxl-8 ">
            <charts></charts>
        </div>

        <div className="col-xxl-4">
            <employees-requests ref="leaves"  title="اذونات الخروج الساعية"></employees-requests>
        </div>
        <div className="col-xxl-4">
            <employees-requests ref="loans"  title="طلبات القروض"></employees-requests>
        </div>
        <div className="col-xxl-4">
            <employees-requests ref="advanced" title="طلبات السلف"></employees-requests>
        </div>
        <div className="col-xxl-4">
            <employees-requests ref="vacations"  title="طلبات الاجازات"></employees-requests>
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
        <div className="col-xxl-4">
            <agenda></agenda>
        </div>
        <!--div className="col-xl-8">
            <my-tasks></my-tasks>
        </div-->
    </div>


</template>

<script>
import quick_access from "../_commons/quick_access";
import charts from "./charts";
import employeesRequests from "./employeesRequests";
import newMailing from "../_commons/newMailing";
import deptsRequests from "../_commons/deptsRequests";
import myFollowups from "../_commons/myFollowups";
import myTasks from "../_commons/myTasks";
import agenda from "../_commons/agenda";
import shared from "../../../../src/shared";
export default {
    components:{quick_access,charts , employeesRequests, newMailing, deptsRequests, myFollowups, myTasks , agenda},
    name: "adminHome",
    data(){
        return{
            quick_links:[
                {
                    "title":"موظف جديد" , "url":this.$router.resolve({ name: 'addEmployee' }),
                    "class":"bg-light-primary", "icon":"fas fa-user-plus"
                },
                {
                    "title":"صنف جديد" , "url":this.$router.resolve({ name: 'addStoreCategory' }),
                    "class":"bg-light-success", "icon":"fas fa-tasks"
                },
                {
                    "title":" طلبية شراء" , "url":this.$router.resolve({ name: 'addStoreOrder' }),
                    "class":"bg-light-warning", "icon":"fas fa-mail-bulk"
                },
                {
                    "title":" المخازن" , "url":this.$router.resolve({ name: 'storeItems' }),
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
            ]
        }
    },
    async created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }

        let results = (await shared.post('/api/hr/hr/latest',{})).data;
        this.$refs.advanced.setData(results.advanced);
        this.$refs.leaves.setData(results.leaves);
        this.$refs.vacations.setData(results.vacations);
        this.$refs.loans.setData(results.loans);
    }
}
</script>

