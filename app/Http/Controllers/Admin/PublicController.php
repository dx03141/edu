<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PublicController extends Controller
{
    //登录页面的展示
    public function login(){
        return view('admin.public.login');

    }

    //验证数据
    public function check(Request $request){
        $this -> validate($request,[
            //用户名 不能为空 长度组少是2-20
            'username' => 'required|min:2|max:20',
            //密码也是必填  长度最少6
            'password' =>  'required|min:6',
            //验证码 必填 长度5 必须是合法验证码
            'captcha' => 'required|size:5|captcha'
        ]);
        //验证用户的合法性
        $data = $request -> only(['username','password']);
        $data['status'] = '2';
        $request = Auth::guard('admin') -> attempt($data,$request -> get('online'));
//        dd($request);
        if($request){
            return redirect('/admin/index/index');
        }else{
            //带错误信息跳转
            return redirect('/admin/public/login') -> withErrors([
                'loginError' => '用户名或密码错误'
            ]);
        }
    }

    public function logout(){
        Auth::guard('admin') -> logout();
        return redirect('/admin/public/login');
    }
}
