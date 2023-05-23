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
        Schema::create('result_embs', function (Blueprint $table) {
            $table->text('Code_dossier');
            $table->integer('Code_article');
            $table->text('Designation');
            $table->integer('Prix_kg');
            $table->integer('Quantite');
            $table->integer('Freinte');
            $table->integer('Poids_mat');
            $table->integer('Cout_matiere');
            $table->integer('Freinte_globale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_embs');
    }
};
