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
            $table->integer('user_id');
            $table->string('pin_name');
            $table->string('combi_name');
            $table->string('geireki');
            $table->string('shozoku');
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
