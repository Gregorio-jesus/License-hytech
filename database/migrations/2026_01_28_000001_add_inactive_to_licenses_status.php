<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Agregamos 'inactive' al enum de status
        DB::statement("ALTER TABLE licenses MODIFY COLUMN status ENUM('active', 'expired', 'revoked', 'inactive') NOT NULL DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertimos el enum (Nota: si hay registros con 'inactive', esto podría fallar o truncar datos en MySQL dependiendo del modo SQL)
        DB::statement("ALTER TABLE licenses MODIFY COLUMN status ENUM('active', 'expired', 'revoked') NOT NULL DEFAULT 'active'");
    }
};
