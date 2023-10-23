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
            Schema::create('workflows', function (Blueprint $table) {
                $table->id();
                $table->integer('num_ordre')->nullable();
                $table->string('type');
                $table->string('libelle');
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
        Schema::dropIfExists('workflows');
    }
};
