<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//];
//前台
Route::any('/','index/index/index');
Route::miss('index/MISS');
//文章
Route::group('index',function(){
    Route::get('/article/:id','index/article/index');
    Route::any('/search/','index/search/index');
    Route::any('/searchTips','index/search/tips');
    Route::get('/cate/:id','index/cate/index');
});

//后台
Route::group('admin',function(){
    Route::get('','admin/index/index');
    Route::any('login','admin/login/index');
    Route::any('logout','admin/login/logout');

    Route::get('lst','admin/admin/lst');
    Route::any('add','admin/admin/add');
    Route::any('edit/:id','admin/admin/edit');
    Route::any('del/:id','admin/admin/del');
});
//栏目
Route::group('cate',function(){
    Route::get('lst','admin/cate/lst');
    Route::any('add','admin/cate/add');
    Route::any('edit/:id','admin/cate/edit');
    Route::any('del/:id','admin/cate/del');
});
//文章
Route::group('document',function(){
    Route::get('lst','admin/document/lst');
    Route::any('add','admin/document/add');
    Route::any('edit/:id','admin/document/edit');
    Route::any('del/:id','admin/document/del');
});
//友情链接
Route::group('link',function(){
    Route::get('lst','admin/link/link_lst');
    Route::any('add','admin/link/link_add');
    Route::any('edit/:id','admin/link/link_edit');
    Route::any('del/:id','admin/link/del');
});

