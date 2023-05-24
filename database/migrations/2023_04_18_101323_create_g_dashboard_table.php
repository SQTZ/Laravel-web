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
        Schema::create('g_dashboards', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Code_dossier');
            $table->integer('MAT');
            $table->integer('EMB');
            $table->integer('MOD');
            $table->integer('FF');
            $table->integer('TOTAL');
            $table->integer('MC');
            $table->integer('PV');
            $table->integer('Version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_dashboards');
    }
};
