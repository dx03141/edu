<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('protype', function (Blueprint $table){
            $table -> increments('id');
            $table -> string('protype_name', 20) -> notNUll();
            $table -> tinyInteger("sort") ->notNull() ->default('0');
            $table -> timestamps();
            $table -> enum('status',[1,2]) ->notNUll() ->default('2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protype');
    }
}
