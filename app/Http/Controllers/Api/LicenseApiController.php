<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LicenseApiController extends Controller
{
    /**
     * Simula validación de licencia sin lógica real
     */
    public function check(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'hwid' => 'required|string',
        ]);

        // Simulación: cualquier licencia que empiece con DEMO- es válida
        if (!str_starts_with($request->license_key, 'DEMO-')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Licencia inválida (modo demostración)'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'client' => 'Cliente Demo',
            'gym' => 'Gimnasio Ejemplo',
            'expires_at' => Carbon::now()->addDays(30)->format('Y-m-d'),
            'token' => 'demo-token'
        ]);
    }

    /**
     * Verificación offline DEMO
     */
    public function verify(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'hwid' => 'required|string',
        ]);

        if (!str_starts_with($request->license_key, 'DEMO-')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Licencia inválida'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'expires_at' => Carbon::now()->addDays(30)->format('Y-m-d')
        ]);
    }
}
