<?php

namespace app\controller;

use think\Request;
use think\Facade\View;
use app\model\User as  UserModel;
use think\facade\Session;

class LoginController
{

    public function doLogin(){
        if (\request()->isPost()){
            $username = input('post.username');
            $password = input('post.password');
            $user = UserModel::where('username', $username)->findOrEmpty();
            if (!$user->isEmpty()&&$user['password']==md5($password)) {
                Session::set('userId', $user['id']);
                Session::set('username', $user['username']);
                return redirect(url('host/index'));
            }else{
                Session::flash('msg','账号或密码错误');
                return redirect(url('LoginController/login'));
            }
        }
    }

    public function login(){

        return View::fetch();
    }

    public function Logout() {
        Session::clear();
        return redirect(url('LoginController/login'));
    }

}