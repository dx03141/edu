<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Member;
use Input;
use DB;
use Date;

class MemberController extends Controller
{
    //
    public function index(){
        //
        $data = Member::get();

        return view('admin.member.index',compact('data'));
    }

    public function add(){

        if(Input::method() == 'POST'){
            $result = Member::insert([
                'username'  => Input::get('username'),
                'password'  => bcrypt('password'),
                'gender'    => Input::get('gender'),
                'email'    => Input::get('email'),
                'mobile'    => Input::get('mobile'),
                'avatar'    => Input::get('avatar'),
                'type'    => Input::get('type'),
                'status'    => Input::get('status'),
                'created_at'    => date('Y-m-d H:i:s')
            ]);
         return $result ? '1' :'0';
        }else{
//            $country =DB::table('area') ->where('pid', '0') ->get();

//            return view('admin.member.add',compact('country'));
            return view('admin.member.add');
        }
    }

    //ajax司机联动获取下级地区
    public function getarebyid(){
        $id = Input::get('id');
        $data = db::table('area') -> where('pid', $id) ->get();
        return response() ->json($data);
    }

}
