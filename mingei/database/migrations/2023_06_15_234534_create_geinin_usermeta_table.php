<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeininUsermetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geinin_usermeta', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('pin_name');
            $table->string('indies_combi_name');
            $table->string('truth_combi_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geinin_usermeta');
    }
}
