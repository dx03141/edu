<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;


class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin') -> user() -> role_id != '1'){
            //Rbac 鉴权
            //获取路由
            $route = Route::currentRouteAction();
//            $action = rtrim('\',$route);
            $ac = Auth::guard('admin') -> user() -> role -> auth_ac;
            $ac = strtolower($ac.',indexcontroller@index,indexcontroller@welcome');
            //判断权限
            $routeArr = explode('\\',$route);
            if(strpos($ac,strtolower(end($routeArr))) === false){
                exit("<h1>您没有访问权限</h1>");
            }
        }

        return $next($request);
    }
}
