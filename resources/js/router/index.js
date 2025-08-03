import {createWebHistory, createRouter} from "vue-router";

import Auth from '../Auth';
import Home from '../pages/home/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import shared from "../src/shared";
import permissions from "../mixins/Permissions";



export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },

    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            noRequiresAuth: true
        }
    },
    {
        path: '/unauthorized',
        name: 'unAuthorized',
        component: ()=> import("../components/_common/UnAuthorized"),
        meta: {
            noRequiresAuth: true
        }
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Home
    },
    {
        name: 'changePassword',
        path: '/user/change_password',
        component: ()=> import("../pages/change_password")
    },

    {
        name: 'codes',
        path: '/codes',
        component: () =>  import("../components/settings/codes/index"),
        meta: {
            gate: ["page_2"]
        }
    },
    {
        name: 'addCode',
        path: '/codes/add',
        component: () =>  import("../components/settings/codes/form"),
        gate: ["codes_store"]
    },
    {
        name: 'editCode',
        path: '/codes/edit/:id',
        component: () =>  import("../components/settings/codes/form"),
        gate: ["codes_edit"]
    },
    ////////////////
    {
        name: 'appSettings',
        path: '/settings',
        component:() =>  import("../components/settings/settings/index"),
        meta: {
            gate: ["page_3"]
        }
    },

    {
        name: 'editSettings',
        path: '/settings/edit/:id',
        component:() =>  import("../components/settings/settings/form"),
        meta: {
            gate: ["system_settings_edit"]
        }
    },
    ////////////////

    {
        name: 'cities',
        path: '/cities',
        component: () =>  import("../components/settings/cities/index"),
        meta: {
            gate: ["page_7"]
        }
    },
    {
        name: 'addCity',
        path: '/cities/add',
        component: () =>  import("../components/settings/cities/form"),
        meta: {
            gate: ["cities_add"]
        }
    },
    {
        name: 'editCity',
        path: '/cities/edit/:id',
        component: () =>  import("../components/settings/cities/form"),
        meta: {
            gate: ["cities_edit"]
        }
    },
///////////////////////////////////////////////////////
    {
        name: 'countries',
        path: '/countries',
        component: () =>  import("../components/settings/country/index"),
        meta: {
            gate: ["page_6"]
        }
    },
    {
        name: 'addCountry',
        path: '/countries/add',
        component: () =>  import("../components/settings/country/form"),
        meta: {
            gate: ["countries_add"]
        }
    },
    {
        name: 'editCountry',
        path: '/countries/edit/:id',
        component: () =>  import("../components/settings/country/form"),
        meta: {
            gate: ["countries_edit"]
        }
    },

 ////////////////////////////////////////////
    {
        name: 'controllers',
        path: '/controllers',
        component: () => import("../components/settings/controllers/index"),
        meta: {
            gate: ["page_4"]
        }
    },
    {
        name: 'editController',
        path: '/controllers/edit/:id',
        component: () => import("../components/settings/controllers/form"),
        meta: {
            gate: ["controllers_edit"]
        }
    },
/////////////////////////////////////////
    {
        name: 'functions',
        path: '/functions',
        component: () =>  import("../components/settings/functions/index"),
        meta: {
            gate: ["page_5"]
        }
    },
    {
        name: 'addFunction',
        path: '/functions/add',
        component: () =>  import("../components/settings/functions/form"),
        meta: {
            gate: ["functions_add"]
        }
    },
    {
        name: 'editFunction',
        path: '/functions/edit/:id',
        component: () =>  import("../components/settings/functions/form"),
        meta: {
            gate: ["functions_edit"]
        }
    },
/////////////////////////////////////////
    {
        name: 'permissions',
        path: '/permissions',
        component: () =>  import("../components/users_management/permissions/index"),
        meta: {
            gate: ["page_9"]
        }
    },
    {
        name: 'addPermission',
        path: '/permissions/add',
        component: () =>  import("../components/users_management/permissions/form"),
        meta: {
            gate: ["permissions_add"]
        }
    },
    {
        name: 'editPermission',
        path: '/permissions/edit/:id',
        component: () =>  import("../components/users_management/permissions/form"),
        meta: {
            gate: ["permissions_edit"]
        }
    },
//////////////////////////////////////

    {
        name: 'roles',
        path: '/roles',
        component: () =>  import("../components/users_management/roles/index"),
        meta: {
            gate: ["page_10"]
        }
    },
    {
        name: 'addRole',
        path: '/roles/add',
        component: () =>  import("../components/users_management/roles/form"),
        meta: {
            gate: ["roles_add"]
        }
    },
    {
        name: 'editRole',
        path: '/roles/edit/:id',
        component: () =>  import("../components/users_management/roles/form"),
        meta: {
            gate: ["roles_edit"]
        }
    },

//////////////////////////////////
    {
        name: 'departments',
        path: '/departments',
        component: () =>  import("../components/users_management/departments/index"),
        meta: {
            gate: ["page_12"]
        }
    },
    {
        name: 'addDepartment',
        path: '/departments/add',
        component: () =>  import("../components/users_management/departments/form"),
        meta: {
            gate: ["departments_add"]
        }
    },
    {
        name: 'editDepartment',
        path: '/departments/edit/:id',
        component: () =>  import("../components/users_management/departments/form"),
        meta: {
            gate: ["departments_edit"]
        }
    },

//////////////////////////////////////////////////////////
    {
        name: 'users',
        path: '/users',
        component: () =>  import("../components/users_management/users/index"),
        meta: {
            gate: ["page_11"]
        }
    },
    {
        name: 'addUser',
        path: '/users/add',
        component:  () =>  import("../components/users_management/users/form"),
        meta: {
            gate: ["users_add"]
        }
    },
    {
        name: 'editUser',
        path: '/users/edit/:id',
        component:  () =>  import("../components/users_management/users/form"),
        meta: {
            gate: ["users_edit"]
        }
    },

    {
        name: 'userPermissions',
        path: '/users/perms/:id',
        component: () => import("../components/users_management/users/perms"),
        meta: {
            gate: ["users_permissions"]
        }
    },
/////////////////////////////////////////////
    {
        name: 'notifications',
        path: '/notifications',
        component:  () =>  import("../components/users_management/notifications/index")
    },



/////////////////////////////////////////////////////////////////////////////////
    {
        name: 'tasks',
        path: '/tasks',
        component: ()=> import("../components/secretarial/tasks/index"),
        meta: {
            gate: ["page_22"]
        }
    },
    {
        name: 'addTask',
        path: '/tasks/add',
        component: ()=> import("../components/secretarial/tasks/form"),
        meta: {
            gate: ["tasks_add"]
        }
    },
    {
        name: 'editTask',
        path: '/tasks/edit/:id',
        component: ()=> import("../components/secretarial/tasks/form"),
        meta: {
            gate: ["tasks_edit"]
        }
    },
    {
        name: 'taskDetails',
        path: '/tasks/details/:id',
        component: ()=> import("../components/secretarial/tasks/details"),
        meta: {
            gate: ["taks_handle"]
        }
    },
    {
        name: 'addSubTask',
        path: '/tasks/sub/:id',
        component: ()=> import("../components/secretarial/tasks/sub_task"),
        meta: {
            gate: ["tasks_add_sub_tasks"]
        }
    },
    {
        name: 'editSubTask',
        path: '/tasks/sub/edit/:id',
        component: ()=> import("../components/secretarial/tasks/sub_task"),
        meta: {
            gate: ["tasks_edit_sub_tasks"]
        }
    },
    {
        name: 'finishSubTask',
        path: '/tasks/sub/finish/:id',
        component: ()=> import("../components/secretarial/tasks/finish_sub_task"),
        meta: {
            gate: ["tasks_close_sub_tasks"]
        }
    },



////////////////////////////// ::followups:: ///////////////////////////////
    {
        name: 'followups',
        path: '/followups',
        component: ()=> import("../components/secretarial/followups/index"),
        meta: {
            gate: ["page_23"]
        }
    },
    {
        name: 'addFollowup',
        path: '/followups/add',
        component: ()=> import("../components/secretarial/followups/form"),
        meta: {
            gate: ["followup_add"]
        }
    },
    {
        name: 'followupDetails',
        path: '/followup/details/:id',
        component: ()=> import("../components/secretarial/followups/details"),
        meta: {
            gate: ["followup_handle"]
        }
    },

////////////// Departments Requests::end//////////////////////////
///////////

    ///////////
    {
        name: 'agenda',
        path: '/agenda',
        component: ()=> import("../components/agenda/index"),
        meta: {
            gate: ["page_27"]
        }
    },
    {
        name: 'addAgenda',
        path: '/agenda/add',
        component: ()=> import("../components/agenda/form"),
        meta: {
            gate: ["agenda_add"]
        }
    },
    {
        name: 'editAgenda',
        path: '/agenda/edit/:id',
        component: ()=> import("../components/agenda/form"),
        meta: {
            gate: ["agenda_edit"]
        }
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

router.beforeEach((to, from, next) => {
    //const title = to.meta.title || 'Default Title'; // Set a default title if needed
    //check for multiple permisisons for the same route

    document.title = "نظام ادارة المعلومات";
    if (to.matched.some(record => record.meta.noRequiresAuth) ) {
        next();//only for login route
    } else {
        if (Auth.check()) {
            if(to.meta.gatex){
                to.meta.gate = to.meta.gatex[to.params.type];
            }
            if (to.meta.ext) {
                to.meta.gate= permissions.methods.getGateType(to)
            }
            if(permissions.methods.can(to.meta.gate)){
                next();
            }else{
               shared.alert("لا تملك صلاحية دخول هذه الصفحة")
                next({ name: 'unAuthorized' });
            }


        } else {
            router.push('/login');
        }
    }
});

/*
router.afterEach((to, from) => {
    const componentInstance =  router.currentRoute.value.component;
    if (componentInstance) {
        componentInstance.$nextTick(() => {
            // Access the component data or perform any desired actions
            console.log(componentInstance.title);
            document.title = componentInstance.title;
        });
    }
});
*/
export default router;
