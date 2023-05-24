<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('result_mods', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Code_dossier');
            $table->integer('Version');
            $table->text('Metier');
            $table->integer('Nb_etp');
            $table->integer('Cadence_horaire');
            $table->integer('Taux_horaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_mods');
    }
};
