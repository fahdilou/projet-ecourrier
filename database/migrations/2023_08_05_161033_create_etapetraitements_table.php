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
            Schema::create('etapetraitements', function (Blueprint $table) {
                $table->id();
                $table->string('libelle');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->string('num_ordre')->nullable();;
                $table->string('who_create');
                $table->string('who_update')->nullable();
                $table->timestamps();

                $table->foreign('parent_id')->references('id')->on('workflows');
            });
        }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etapetraitements');
    }
};






