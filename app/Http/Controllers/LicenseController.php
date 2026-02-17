<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LicenseController extends Controller
{
    // Listado demo
    public function index()
    {
        $licenses = collect([
            (object)[
                'id' => 1,
                'license_key' => 'DEMO-GYM-1234-ABCD',
                'status' => 'active',
                'expiration_date' => Carbon::now()->addDays(30),
                'client' => (object)['name' => 'Cliente Demo', 'gym_name' => 'Gym Ejemplo'],
                'service' => (object)['name' => 'Sistema Gym']
            ]
        ]);

        return view('licenses.index', compact('licenses'));
    }

    // Formulario
    public function create()
    {
        return view('licenses.generatorGym');
    }

    // Genera licencia falsa
    public function store(Request $request)
    {
        $licenseKey = 'DEMO-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));

        return redirect()->back()->with('success', 'Licencia DEMO generada: ' . $licenseKey);
    }

    // Descarga archivo demo
    public function download($id)
    {
        $content = "HYTECH LICENSE DEMO\n";
        $content .= "KEY: DEMO-1234-ABCD\n";
        $content .= "EXPIRES: " . Carbon::now()->addDays(30)->format('d/m/Y') . "\n";
        $content .= "\nEste archivo es solo una demostración.";

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="license_demo.txt"');
    }

    // Actualización ficticia
    public function update(Request $request, $id)
    {
        return back()->with('success', 'Licencia actualizada (modo demo)');
    }
}
