<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSynthstucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synthstucs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('client_id')->constrained('users');
            $table->string('status')->nullable();
            $table->string('photoProfil')->default('none');
            $table->string('CV')->default('none');
            $table->string('prenom');
            $table->string('nom');
            $table->string('metier');
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('reseau_autre')->nullable();
            $table->longtext('formations')->nullable();
            $table->longtext('experiences')->nullable();
            $table->string('departement')->nullable();
            $table->longtext('synthese')->nullable();
            $table->string('type')->nullable()->default('tuc');
            $table->timestamps();
        });


	/*
        Schema::table('synthstucs', function (Blueprint $table) {
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
        });
	*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('synthstucs');
    }
}
