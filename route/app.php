<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');
Route::rule('doLogin', 'LoginController/doLogin', 'POST');
Route::rule('host_group/save', 'HostGroup/save', 'POST');
Route::rule('login', 'LoginController/login', 'GET');

Route::rule('logout', 'LoginController/logout', 'GET');
//Route::get('host_group/search', 'host_group/search');
