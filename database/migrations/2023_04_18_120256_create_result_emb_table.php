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
            $table->increments('id');
            $table->text('Code_dossier');
            $table->integer('Version');
            $table->integer('Ligne_version');
            $table->integer('Code_article');
            $table->text('Designation');
            $table->decimal('Prix_kg', 8, 2);
            $table->integer('Quantite');
            $table->decimal('Freinte', 8, 2);
            $table->decimal('Poids_mat', 8, 2);
            $table->decimal('Cout_matiere', 8, 2);
            $table->decimal('Freinte_globale', 8, 2);
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
