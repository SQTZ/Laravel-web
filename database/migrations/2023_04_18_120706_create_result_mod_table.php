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
            $table->integer('Ligne_version');
            $table->text('Metier');
            $table->integer('Nb_etp');
            $table->decimal('Cadence_horaire', 8, 2);
            $table->decimal('Taux_horaire', 8, 2);
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
