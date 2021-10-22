<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //
    protected $table = 'profession';

    //定义关联模型
    public function protype(){
        return $this -> hasOne('App\Admin\Protype','id','protype_id');
    }
}
