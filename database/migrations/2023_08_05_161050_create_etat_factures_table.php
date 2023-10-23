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
        Schema::create('etat_factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facture_id');
            $table->unsignedBigInteger('workflow_id');
            $table->unsignedBigInteger('etapetraitement_id')->nullable(); 
            $table->date('date_entree')->nullable();
            $table->date('date_sortie')->nullable();
            $table->string('who_update');
            $table->timestamps();
    
            $table->foreign('facture_id')->references('id')->on('factures');
            $table->foreign('workflow_id')->references('id')->on('workflows');
            $table->foreign('etapetraitement_id')->references('id')->on('etapetraitements'); // Clé étrangère vers la table "etapetraitements"
        });
    }
    


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etat_factures');
    }
};
