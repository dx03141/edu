<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//后台路由

Route::group(['prefix'=>'admin'],function () {
    //后台登录
    Route::get('public/login',  'Admin\PublicController@login') -> name('login');
    //后台登录处理
    Route::post('public/check', 'Admin\PublicController@check');
    //退出
    Route::get('public/logout', 'Admin\PublicController@logout');

});


//需要权限判断
Route::group(['prefix'=>'admin','middleware' => ['auth:admin','checkrbac']],function () {
    // 后台首页
    Route::get('index/index',  'Admin\IndexController@index') ;
    Route::get('index/welcome',  'Admin\IndexController@welcome');
    //管理员模块
    Route::get('manager/index',  'Admin\ManagerController@index');
    //添加权限
    Route::get('auth/index',  'Admin\AuthController@index');
    Route::any('auth/add',  'Admin\AuthController@add');
    //角色
    Route::get('role/index',  'Admin\RoleController@index');
    Route::any('role/assign',  'Admin\RoleController@assign');
    //会员
    Route::get('member/index',  'Admin\MemberController@index');
    Route::any('member/add',  'Admin\MemberController@add');
    //异步头像上传地址
    Route::post('uploader/webuploader','Admin\UploaderController@webuploader');//异步上传
    Route::post('uploader/qiniu','Admin\UploaderController@qiniu');//异步上传
    Route::get('member/getarebyid','Admin\MemberController@getarebyid');//ajax联动

    //专业分类列表专业列表
    Route::get('protype/index','Admin\ProtypeController@index');
    Route::get('profession/index','Admin\ProfessionController@index');

    //课程与点播课程管理
    Route::get('course/index','Admin\CoureController@index');
    Route::get('lesson/index','Admin\LessonController@index');
    Route::get('lesson/play','Admin\LessonController@play');

    //试卷试题
    Route::get('paper/index','Admin\PaperController@index');
    Route::get('question/index','Admin\QuestionController@index');
    //试卷导入导出
    Route::get('question/export','Admin\QuestionController@export');
    Route::any('question/import','Admin\QuestionController@import');

});


