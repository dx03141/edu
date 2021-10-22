<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表的方式
        Schema::create('manager' , function(Blueprint $tabel){
            $tabel -> increments('id'); //主键字段
            $tabel -> string('username',20) -> notNull(); //用户名 不能为空
            $tabel -> string('password') -> notNull();
            $tabel -> enum('gender', [1,2,3]) -> notNull() ->default('1');
            $tabel -> string('phone',11);
            $tabel -> string('email',40);
            $tabel -> tinyInteger('role_id');
            $tabel -> timestamps();
            $tabel -> rememberToken();
            $tabel -> enum('status',[1,2]) -> notNUll() ->default('2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('manager');
    }
}
