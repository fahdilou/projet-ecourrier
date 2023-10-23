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
            Schema::create('factures', function (Blueprint $table) {
                $table->id();
                $table->string('fournisseur');
                $table->date('date_facture');
                $table->date('date_arriver_facture');
                $table->string('numero_facture');
                $table->string('devise');
                $table->decimal('montant', 12, 2);
                $table->string('commentaire')->nullable();
                $table->string('who_create');
                $table->integer('etat_workflow');
                $table->integer('etat_traitement');
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
        Schema::dropIfExists('factures');
    }
};
