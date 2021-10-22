<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';
    public $timestamps = false;

    public function assignAuth($data){
        $post['auth_ids'] = implode(',',$data['auth_id']);
        $tmp = \App\Admin\Auth::where('pid', '!=' ,'0')-> whereIn('id',$data['auth_id']) -> get();

        $ac = '';
        foreach ($tmp as $value){
            $ac .= $value -> controller . '@' . $value -> action . ',';
        }
        $post['auth_ac'] = strtolower(rtrim($ac,','));
        //修改数据
        return Role::where('id',$data['id']) -> update($post);
    }
}
