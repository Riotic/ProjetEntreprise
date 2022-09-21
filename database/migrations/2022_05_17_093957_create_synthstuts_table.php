<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSynthstutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synthstuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('client_id')->constrained('users');
            $table->string('status')->nullable();
            $table->string('photoProfil')->default('none');
            $table->string('photoCouverture')->default('none');
            $table->string('photoCarrousel1')->default('none');
            $table->string('photoCarrousel2')->default('none');
            $table->string('photoCarrousel3')->default('none');
            $table->string('prenom');
            $table->string('nom');
            $table->string('metier');
            $table->string('adresse')->nullable();
            $table->string('adresseBis')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('horaire')->nullable();
            $table->longtext('motsClefs')->nullable();
            $table->string('departement')->nullable();
            $table->longtext('citation')->nullable();
            $table->longtext('synthese')->nullable();
            $table->string('type')->nullable()->default('tut');
            $table->timestamps();
        });
	//        Schema::table('synthstuts', function (Blueprint $table) {
        //    $table->string('instagram')->nullable();
        //    $table->string('twitter')->nullable();
        //});
        // Schema::table('synthstuts', function (Blueprint $table) {
        //     $table->string('adresseBis')->nullable();
        //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('synthstuts');

    }
}
