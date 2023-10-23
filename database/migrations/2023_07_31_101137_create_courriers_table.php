<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('courriers', function (Blueprint $table) {
        $table->id();
        $table->date('date_arriver');
        $table->string('expediteur');
        $table->string('motif');
        $table->string('affectation')->nullable();
        $table->date('date_debut_traitement')->nullable();
        $table->date('date_fin_traitement')->nullable();
        $table->text('observation')->nullable();
        $table->string('statut')->default('ENREGISTREMENT');
        $table->string('who_create');
        $table->string('who_update')->nullable();
        $table->timestamps();
    }); 
  
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courriers');
    }
};
