<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appels_offres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('numero')->nullable();
            $table->string('objet');
            $table->text('description')->nullable();
            $table->date('date_publication')->nullable();
            $table->date('date_limite')->nullable();
            $table->enum('statut', ['ouvert', 'ferme', 'archive'])->default('ouvert');
            $table->string('fichier_path')->nullable();
            $table->string('fichier_nom')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appels_offres');
    }
};
