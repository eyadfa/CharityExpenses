<?php

use App\Http\Controllers\API\Admin\AbilitiesController;
use App\Http\Controllers\API\Agenda\AgendaController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DownloadController;
use App\Http\Controllers\API\Management\DepartmentsController;
use App\Http\Controllers\API\Management\NotificationsController;
use App\Http\Controllers\API\Management\PermissionsController;
use App\Http\Controllers\API\Management\RolesController;
use App\Http\Controllers\API\Management\UsersController;
use App\Http\Controllers\API\sec\Followup\FollowUpController;
use App\Http\Controllers\API\sec\Followup\FollowupsAttachmentsController;
use App\Http\Controllers\API\sec\Tasks\TasksAttachmentsController;
use App\Http\Controllers\API\sec\Tasks\TasksController;
use App\Http\Controllers\API\sec\Tasks\TasksParticipantsController;
use App\Http\Controllers\API\sec\Tasks\TasksSubsController;
use App\Http\Controllers\API\Settings\CitiesController;
use App\Http\Controllers\API\Settings\CodesController;
use App\Http\Controllers\API\Settings\ControllersController;
use App\Http\Controllers\API\Settings\CountryController;
use App\Http\Controllers\API\Settings\FunctionsController;
use App\Http\Controllers\API\Settings\SystemSettingsController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware("auth:sanctum")->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('change_password', [AuthController::class, 'changePassword']);
    Route::post("get_user", [AuthController::class, 'getAuthUser']);

    Route::get("abilities", [AbilitiesController::class, 'index']);

    Route::controller(NotificationsController::class)
        ->prefix("/notifications")->group(function () {
            Route::post('/search', 'index');
            Route::post('/seen', 'seen');
        });

    Route::controller(CodesController::class)
        ->prefix("/codes")->group(function () {
            Route::post('/search', 'index');
            Route::post('/', 'store');
            Route::post('/export', 'export');
            Route::post('/activation', 'activation');
            Route::get('show/{id}', 'edit');
            Route::post('update/{id}', 'update');
            Route::get('main', 'getMainCodes');
            Route::get('sub/{id}', 'getSubCodes');
            Route::get('active/all', 'getAllActiveCodes');
        });
    Route::controller(SystemSettingsController::class)
        ->prefix("/settings")->group(function () {
            Route::post("/", "store");
            Route::post('/search', 'index');
            Route::get('/show/{id}', 'show');
            Route::post('/activation', 'activation');
            Route::post('/active', 'active');
            Route::post('/update/{id}', 'update');
        });
    Route::controller(CountryController::class)
        ->prefix("/countries")->group(function () {
            Route::post('/search', 'index');
            Route::post('/activation', 'activation');
            Route::post('/', 'store');
            Route::post('/active', 'active');
            Route::get('show/{id}', 'show');
            Route::post('update/{id}', 'update');
            //  Route::delete('/{id}', 'destroy');
        });
    Route::controller(CitiesController::class)
        ->prefix("/cities")->group(function () {
            Route::post('/search', 'index');
            Route::post('/activation', 'activation');
            Route::post('/', 'store');
            Route::get('show/{id}', 'show');
            Route::post('update/{id}', 'update');
        });

    Route::controller(ControllersController::class)
        ->prefix("/controllers")->group(function () {
            Route::post('/search', 'index');
            Route::post('/activation', 'activation');
            Route::get('show/{id}', 'edit');
            Route::post('active', 'active');
            Route::post('update/{id}', 'update');
        });
    Route::controller(FunctionsController::class)
        ->prefix("/functions")->group(function () {
            Route::post('/search', 'index');
            Route::post('/activation', 'activation');
            Route::post('/', 'store');
            Route::get('show/{id}', 'show');
            Route::post('update/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });


    Route::controller(PermissionsController::class)
        ->prefix("permissions")
        ->group(function () {
            Route::post('/', 'store');
            Route::post('/search', 'index');
            Route::get('/permsM', 'permsM');
            Route::get('show/{id}', 'show');
            Route::post('update/{id}', 'update');
        });


    Route::controller(RolesController::class)->prefix('roles')
        ->group(function () {
            Route::post('/search', 'index');
            Route::get('/rolesM', 'rolesM');
            Route::post('/', 'store');
            Route::get('show/{id}', 'show');
            Route::post('update/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

    Route::controller(UsersController::class)->prefix('users')
        ->group(function () {
            Route::post('/search', 'index');
            Route::get('/managers', 'managers');
            Route::post('/', 'store');
            Route::get('show/{id}', 'show');
            Route::post('update/{id}', 'update');
            Route::post('update_permissions/{id}', 'updatePermissions');
            Route::delete('{id}', 'destroy');
            Route::post('activation', 'activation');
            Route::post('change_password', 'changePassword');
        });

    Route::controller(DepartmentsController::class)->prefix('departments')
        ->group(function () {
            Route::post('/search', 'index');
            Route::post('/', 'store');
            Route::get('show/{id}', 'show');
            Route::post('update/{id}', 'update');
            Route::delete('/{id}', 'destroy');
            Route::post('activation', 'activation');
        });
    Route::prefix("/arch")->group(function () {
        Route::controller(BranchController::class)
            ->prefix("/branch")->group(function () {
                Route::post('/search', 'index');
                Route::post('/', 'store');
                Route::post('activation', 'activation');
                Route::post('active', 'active');
                Route::get('show/{id}', 'show');
                Route::post('update/{id}', 'update');
                Route::delete('/{id}', 'destroy');
                Route::post('/export', 'export');
            });

        Route::controller(BoardController::class)
            ->prefix("/board")->group(function () {
                Route::post('/search', 'index');
                Route::post('/', 'store');
                Route::post('activation', 'activation');
                Route::post('active', 'active');
                Route::get('show/{id}', 'show');
                Route::post('update/{id}', 'update');
                Route::delete('/{id}', 'destroy');
                Route::post('/export', 'export');
            });

        Route::controller(EmployeeController::class)
            ->prefix("/employees")->group(function () {
                Route::post('/search', 'index');
                Route::post('/managers', 'managers');
                Route::post('/init', 'init');
                Route::post('/export', 'export');
            });

    });


    Route::controller(FollowUpController::class)->prefix('followups')
        ->group(function () {
            Route::post('/search', 'index');
            Route::post('/latest', 'latest');
            Route::post('/', 'store');
            Route::get('show/{id}', 'show');
            Route::post('/reply/{id}', 'addReply');
            Route::post('finish/{id}', 'finish');
            Route::post('/export', 'export');

        });
    Route::controller(FollowupsAttachmentsController::class)->prefix("followup/attachment")->group(function () {
        Route::post('/{id}', 'store');
    });
    Route::group(['prefix' => 'tasks'], function () {
        Route::post('/search', [TasksController::class, 'index']);
        Route::post('/', [TasksController::class, 'store']);
        Route::get('show/{id}', [TasksController::class, 'show']);
        Route::post('update/{id}', [TasksController::class, 'update']);
        Route::post('participant/{id}', [TasksParticipantsController::class, 'store']);
        Route::get('participant/{id}', [TasksParticipantsController::class, 'index']);
        Route::post('reply/{id}', [TasksController::class, 'addReply']);
        Route::post('finish/{id}', [TasksController::class, 'finish']);
        Route::post('attachment/{id}', [TasksAttachmentsController::class, 'store']);
        Route::post('/export', [TasksController::class, 'export']);

        Route::get('sub/show/{id}', [TasksSubsController::class, 'edit']);
        Route::post('sub', [TasksSubsController::class, 'store']);
        Route::post('sub/finish/{id}', [TasksSubsController::class, 'finish']);
        Route::post('sub/update/{id}', [TasksSubsController::class, 'update']);//update
    });


    Route::group(['prefix' => 'download'], function () {
        Route::post('/', [DownloadController::class, 'download']);
    });


    Route::controller(AgendaController::class)
        ->prefix("agenda")->group(function () {
            Route::post("/", "store");
            Route::post('/search', 'index');
            Route::post('/latest', 'latest');
            Route::post('/export', 'export');
            Route::get('/show/{id}', 'show');
            Route::post('/update/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });


});
