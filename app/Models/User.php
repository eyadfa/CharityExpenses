<?php

namespace App\Models;

use App\Http\Controllers\API\Admin\AbilitiesController;
use App\Traits\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "department_id",
        "is_active",
        "related_emp_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        "created_at" => 'datetime:Y-m-d',
        "is_active"=>"boolean"
    ];

    protected $with=["department"];
    protected $appends=["user_permissions"];



    public function department(){
        return $this->hasOne(Department::class , "id" , "department_id")->withDefault(new Department());
    }


    function employee(){
        return $this->hasOne(Employee::class , "id" , "related_emp_id");
    }
    function getUserPermissionsAttribute(){
         if($this->id == 1){
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
             return $unique_perms;
         }else{
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
             return $unique_perms;
         }
    }


}
