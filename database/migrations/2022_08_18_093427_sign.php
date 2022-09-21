<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_user')->nullable();
            $table->string('id_creator')->nullable();
            $table->longText('do_at_one')->nullable();
            $table->longText('do_at_two')->nullable();
            $table->longText('do_at_three')->nullable();
            $table->longText('do_at_four')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    public function down()
    {
        Schema::dropIfExists('sign');
    }
}
