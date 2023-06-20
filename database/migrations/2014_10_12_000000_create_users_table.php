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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('poste');
            $table->string('type_connexion')->default('SQL');
            $table->integer('est_actif')->default(1);
            $table->date('date_derniere_connexion')->default(date('Y-m-d'));
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('droit');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
