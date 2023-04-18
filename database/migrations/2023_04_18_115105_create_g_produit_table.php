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
        Schema::create('g_produit', function (Blueprint $table) {
            $table->integer('Reference');
            $table->text('Designation');
            $table->integer('Prix_article_kg');
            $table->text('Fournisseur');
            $table->integer('Poids_MAT');
            $table->integer('Cout_Matiere');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_produit');
    }
};
