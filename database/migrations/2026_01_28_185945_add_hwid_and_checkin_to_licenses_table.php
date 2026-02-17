<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('licenses', function (Blueprint $table) {
        // El HWID es único por equipo, lo ponemos nullable para que se asigne en la primera activación
        $table->string('hwid')->nullable()->after('license_key')->index();
        
        // El latido (heartbeat) para saber si está en funcionamiento
        $table->timestamp('last_check_in')->nullable()->after('expiration_date');
    });
}

public function down(): void
{
    Schema::table('licenses', function (Blueprint $table) {
        $table->dropColumn(['hwid', 'last_check_in']);
    });
}
};
