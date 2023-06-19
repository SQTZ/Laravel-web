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
        Schema::create('g_produits', function (Blueprint $table) {
            $table->integer('Reference');
            $table->text('Designation');
            $table->decimal('Prix_article_kg', 8, 2);
            $table->text('Fournisseur');
            $table->decimal('Poids_MAT', 8, 2);
            $table->decimal('Cout_Matiere', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_produits');
    }
};
