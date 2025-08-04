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
 /////////////////////////////////////  Expenses :: start :://///////////////////////////////
    ///////////
    {
        name: 'expenses',
        path: '/expenses',
        component: ()=> import("../components/expenses/index"),
        meta: {
            gate: ["page_27"]
        }
    },
    {
        name: 'addExpenses',
        path: '/expenses/add',
        component: ()=> import("../components/expenses/form"),
        meta: {
            gate: ["expenses_add"]
        }
    },
    {
        name: 'importExpenses',
        path: '/expenses/import',
        component: ()=> import("../components/expenses/importForm"),
        meta: {
            gate: ["expenses_add"]
        }
    },
    {
        name: 'editExpenses',
        path: '/expenses/edit/:id',
        component: ()=> import("../components/expenses/form"),
        meta: {
            gate: ["expenses_edit"]
        }
    },
 /////////////////////////////////////  Expenses :: End :://///////////////////////////////

 /////////////////////////////////////  Payments :: start :://///////////////////////////////
    ///////////
    {
        name: 'payments',
        path: '/payments',
        component: ()=> import("../components/payments/index"),
        meta: {
            gate: ["page_27"]
        }
    },
    {
        name: 'addPayments',
        path: '/payments/add',
        component: ()=> import("../components/payments/form"),
        meta: {
            gate: ["payments_add"]
        }
    },
    {
        name: 'editPayments',
        path: '/payments/edit/:id',
        component: ()=> import("../components/payments/form"),
        meta: {
            gate: ["payments_edit"]
        }
    },
 /////////////////////////////////////  Payments :: end :://///////////////////////////////
 /////////////////////////////////////  Reports :: start ::////////////////////////////////
    {
        name: 'reportsExpenses',
        path: '/reports/expenses',
        component: ()=> import("../components/reports/expenses/index"),
        meta: {
            gate: ["page_27"]
        }
    },
    {
        name: 'reportsPayments',
        path: '/reports/payments',
        component: ()=> import("../components/reports/payments/index"),
        meta: {
            gate: ["page_27"]
        }
    },
    {
        name: 'teamsReports',
        path: '/reports/teams',
        component: ()=> import("../components/reports/teams/index"),
        meta: {
            gate: ["page_27"]
        }
    },
 /////////////////////////////////////  Reports :: end :://///////////////////////////////

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

router.beforeEach((to, from, next) => {
    //const title = to.meta.title || 'Default Title'; // Set a default title if needed
    //check for multiple permisisons for the same route

    document.title = "نظام ادارة المصروفات";
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
