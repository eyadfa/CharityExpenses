<template>

    <admin-home v-if="department_id==0"></admin-home>
    <secretarial-home v-if="department_id==1" ></secretarial-home>
    <hr-home v-if="department_id==2" ></hr-home>
    <finance-home v-if="department_id==3" ></finance-home>

</template>

<script>
import adminHome from "./components/admin/adminHome";
import secretarialHome from "./components/secretarial/secretarialHome";
import hrHome from "./components/hr/hrHome";
import financeHome from "./components/finance/financeHome";
export default {
    name: "Home",
    components:{adminHome,secretarialHome,hrHome
        ,financeHome
    },
    data(){
        return{
            department_id:0,
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
            this.department_id = window.Laravel.user.department_id;
        }
    }
}
</script>
