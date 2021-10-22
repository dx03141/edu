<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use App\Admin\Auth;
use DB;

class AuthController extends Controller
{
    //
    public function index(){
        $data = DB::table('auth as t1') -> select ('t1.*','t2.auth_name as parent_name') -> leftJoin('auth as t2','t1.pid','=','t2.id') ->get();
//        dd($data);
        return view('admin.auth.index',compact('data'));
    }

    public function add(){
        //判断请求类型
        if(Input::method() == 'POST'){
            $data = Input::except('_token');
            $result = Auth::insert($data);
            return $result ? '1' : '0';
        }else{
            $parents = Auth::where('pid', '=', '0') -> get();
            return view('admin.auth.add', compact('parents'));
        }

    }
}
