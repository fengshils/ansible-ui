<?php

namespace app\middleware;

use think\facade\Session;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
        $userId = Session::get('userId');
        if(!$userId){
            return redirect(url('LoginController/login'));
        }else{
            return $next($request);
        }
    }
}
