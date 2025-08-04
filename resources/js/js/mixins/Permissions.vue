<script>

import Auth from "../Auth";
export default {
    methods: {
        canDept(depts){
            if( depts.includes("*")
                ||
                depts.includes(window.Laravel.user.department_id)
                ||
                window.Laravel.user.department_id === 0
            ){
                return true;
            }else{
                return false;
            }

        },
         can(permissionName) {
            if(window.Laravel.user.department_id === 0 ) {
                return true;
            }
            let userPermissions =Auth.user().user_permissions;

            if(permissionName === undefined){
                return true; // that is means the action does not need permissions
            }
             const setArray2 = new Set(userPermissions);
            if(Array.isArray(permissionName)){

                const mutualElements = permissionName.filter(element => setArray2.has(element));

                if(mutualElements.length >0){
                    return true;
                }else{
                    return false;
                }
            }else{
               return setArray2.has(permissionName) ;
            }



        },
        denies(permissionName){
            return ! this.can(permissionName)
        },

        getGateType(to){
            if(to.meta.ext == "OrgsMeetingsIndex"){
                switch (to.params.type) {
                    case 5:
                        return ["page_115"];
                    case 6:
                        return ["page_116"];
                    case 7:
                        return ["page_117"];
                    case 8:
                        return ["page_118"];

                }
            }else if(to.meta.ext == "OrgsMeetingsAdd"){
                switch (to.params.type) {
                    case 5:
                        return ["meetings_ext_orgs_1_add"];
                    case 6:
                        return ["meetings_ext_orgs_2_add"];
                    case 7:
                        return ["meetings_ext_orgs_3_add"];
                    case 8:
                        return ["meetings_ext_orgs_4_add"];

                }
            }


            return [];
        },
        getFamiliesPermPrefix(family_type_cd) {
            switch (family_type_cd) {
                case 1:
                    return "mur";
                case 2:
                    return "wounded";
                case 3:
                    return "prisoner";
                default:
                    return "";
            }
        },

        msg(error) {
           switch(error.$validator){
                case "required":
                    return "هذا الحقل مطلوب";
                    break;
                case "min":
                    return "الحد الأدنى للحروف هو: " + error.$params.min;
                case "minValue":
                    return "يجب أن تكون القيمة أكبر من تاريخ البداية";
               case "max":
                    return "الحد الأقصى للحروف هو: " + error.$params.max;
               case "email":
                   return "عنوان ايميل غير صالح";
               case "numeric":
                   return "القيمة يجب ان تكون رقمية";
               case "between":
                   return "يجب أن تكون القيمة محصورة بين : " + error.$params.min + " - " + error.$params.max ;
            }
            console.log(error);
            return error.$message;
        },

    },
}
</script>


