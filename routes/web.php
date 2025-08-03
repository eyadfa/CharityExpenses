<?php

use App\Models\ExternalMail;
use Illuminate\Support\Facades\Route;
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get("/mail_view/{id}" , function ($id){
    $email = ExternalMail::with(["sender" , "receiver","priority" ,"mailType"])->find($id);
    return view("mail.print.template_full" , ["email" =>$email]);
});

Route::get("/qaid/{id}" , function ($id){
    $email = [];
    return view("finance.qaid" , ["email" =>$email]);
});
Route::get("/srf/{id}" , function ($id){
    $email = [];
    return view("finance.srf" , ["email" =>$email]);
});

Route::get('{any}', function () {
  //  if(\Illuminate\Support\Facades\Auth::check()){
        return view('layouts.app');
  //  }else{
 //       return view('auth.login');
  //  }

})->where('any', '.*');
