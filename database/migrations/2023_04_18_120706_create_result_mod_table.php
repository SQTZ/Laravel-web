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
        Schema::create('result_mod', function (Blueprint $table) {
            $table->integer('Code_dossier');
            $table->text('Metier');
            $table->integer('Nb_etp');
            $table->integer('Cadence_horaire');
            $table->integer('Resultat_mod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_mod');
    }
};
