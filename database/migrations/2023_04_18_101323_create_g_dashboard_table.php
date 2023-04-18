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
        Schema::create('g_dashboard', function (Blueprint $table) {
            $table->integer('Code_article');
            $table->integer('MAT');
            $table->integer('EMB');
            $table->integer('MOD');
            $table->integer('FF');
            $table->integer('MC');
            $table->integer('PV');
            $table->integer('Version');
            $table->date('Date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_dashboard');
    }
};
