<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class AbilitiesController extends Controller
{
    //

    public function index(){
        if(auth()->user() == null){
            return response()->json(["data"=>[]]);
        }
        if(auth()->id() ==1){
            return $this->adminPermissions();
        }else{
            return $this->userPermissions();
        }


    }

    public function adminPermissions(){
        $permissions = Permission::all();
        $perms= $permissions->pluck('title')->toArray();
        $controllers= $permissions->pluck('controller_id')->toArray();
        $pages= $permissions->pluck('page_id')->toArray();

        $pagePrefix = 'page_';
        $controllerPrefix = 'controller_';

        $pages_prefixed = array_map(function($page) use ($pagePrefix) {
            return $pagePrefix . $page;
        }, $pages);

        $controllers_prefixed = array_map(function($controller) use ($controllerPrefix) {
            return $controllerPrefix . $controller;
        }, $controllers);


        $permsx = array_merge( $perms, $pages_prefixed,$controllers_prefixed);
        $unique_perms = array_values(array_unique($permsx));
        return response()->json(["data"=>$unique_perms]);
    }

    public function userPermissions(){
        $permissions =  auth()->user()->roles()->with('permissions')->get()
            ->pluck('permissions')
            ->flatten();
        $perms_1= $permissions->pluck('title')->toArray();
        $controllers_1= $permissions->pluck('controller_id')->toArray();
        $pages_1= $permissions->pluck('page_id')->toArray();

        $permissions_2 =  auth()->user()->permissions()->get();
        $perms_2= $permissions_2->pluck('title')->toArray();
        $controllers_2= $permissions_2->pluck('controller_id')->toArray();
        $pages_2= $permissions_2->pluck('page_id')->toArray();

        // Define your prefixes
        $pagePrefix = 'page_';
        $controllerPrefix = 'controller_';

// Add prefix to each element in $pages_1
        $pages_1_prefixed = array_map(function($page) use ($pagePrefix) {
            return $pagePrefix . $page;
        }, $pages_1);

// Add prefix to each element in $controllers_1
        $controllers_1_prefixed = array_map(function($controller) use ($controllerPrefix) {
            return $controllerPrefix . $controller;
        }, $controllers_1);



// Add prefix to each element in $pages_2
        $pages_2_prefixed = array_map(function($page) use ($pagePrefix) {
            return $pagePrefix . $page;
        }, $pages_2);

// Add prefix to each element in $controllers_2
        $controllers_2_prefixed = array_map(function($controller) use ($controllerPrefix) {
            return $controllerPrefix . $controller;
        }, $controllers_2);

        $perms = array_merge(
            $perms_1,$perms_2,
            $pages_1_prefixed,$controllers_1_prefixed,
            $pages_2_prefixed,$controllers_2_prefixed
        );
        $unique_perms = array_values(array_unique($perms));
        return response()->json(["data"=>$unique_perms]);
    }
}
