<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('role');
            $table->string('PDPuser')->default('none');
            $table->string('id_creator')->nullable();
            $table->string('id_synthese')->nullable()->default('none');
            $table->string('organisme')->nullable()->default('none');
            $table->string('civilite')->nullable()->default('none');
            $table->string('intervenant')->nullable()->default('none');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    // {
    // Schema::table('users', function (Blueprint $table) {
    //         $table->string('role')->change();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
