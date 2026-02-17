<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LicenseApiController;

/* Demo API Routes
Estas rutas son solo de demostración y no corresponden al sistema real.
*/

Route::prefix('demo')->group(function () {
    Route::post('/validate', [LicenseApiController::class, 'check']);
    Route::post('/heartbeat', [LicenseApiController::class, 'verify']);
});
