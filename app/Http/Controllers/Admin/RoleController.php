<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Role;
use App\Admin\Auth;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    //
    public function index(){
        $data = Role::get();
        return view('admin.role.index',compact('data'));
    }

    public function assign(){

        if(Input::method() == 'POST'){
            $data = Input::only(['id','auth_id']);
            $role = new Role();
            return  $role -> assignAuth($data);
        }else{
            $parentAuth = Auth::where('pid',0) -> get();
            $childAuth = Auth::where('pid','!=',0) -> get();
            $ids = Role::where('id', Input::get('id')) -> value('auth_ids');
            return view('admin.role.assign', compact('parentAuth','childAuth','ids'));
        }
    }
}
