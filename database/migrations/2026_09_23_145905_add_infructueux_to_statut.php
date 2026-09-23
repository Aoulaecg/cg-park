<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE appels_offres
            MODIFY statut ENUM('ouvert', 'ferme', 'archive', 'infructueux')
            NOT NULL DEFAULT 'ouvert'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE appels_offres
            MODIFY statut ENUM('ouvert', 'ferme', 'archive')
            NOT NULL DEFAULT 'ouvert'
        ");
    }
};