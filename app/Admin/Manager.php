<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Manager extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //
    protected $table = 'manager';

    //使用trait
    use Authenticatable;

    //定义与角色模型的关联操作
    public function role(){
        return $this -> hasOne('App\Admin\Role','id','role_id');
    }

}
