<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSynthstuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synthstues', function (Blueprint $table) {
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
            $table->string('type')->nullable()->default('tue');
            $table->timestamps();
        });
        // Schema::table('synthstues', function (Blueprint $table) {
        //         $table->string('type')->default('tue')->change();
        //     });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('synthstues');
    }
}
