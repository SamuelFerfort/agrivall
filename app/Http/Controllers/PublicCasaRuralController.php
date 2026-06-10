<?php

namespace App\Http\Controllers;

use App\Models\SemanaCasilla;
use App\Mail\ReservaNotificacionAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PublicCasaRuralController extends Controller
{
    public function index()
    {
        $semanas = SemanaCasilla::orderBy('anyo')->orderBy('numero_sem')->get();

        return view('public.casa-rural.index', compact('semanas'));
    }

    public function reservar(Request $request)
    {
        $validated = $request->validate([
            'semana_id' => 'required|exists:semanas_casilla,id',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tlf' => ['nullable', 'string', 'max:20', 'regex:/^(\+34\s?)?[6-9](\s?\d){8}$/'],
            'observaciones' => 'nullable|string|max:1000',
        ], [
            'tlf.regex' => 'Introduce un numero de telefono valido (9 digitos).',
        ]);

        $semana = SemanaCasilla::findOrFail($validated['semana_id']);

        if ($semana->estado !== 'disponible') {
            return redirect()->route('casa-rural.index')
                ->with('error', 'Esa semana ya no esta disponible. Elige otra, por favor.');
        }

        // La semana pasa a PRE-RESERVA a la espera de confirmacion del admin.
        $semana->update(['estado' => 'pre-reserva']);

        // Aviso por correo al administrador del sitio.
        try {
            Mail::to(config('mail.admin_address'))->send(new ReservaNotificacionAdmin(
                $semana,
                $validated['nombre'],
                $validated['email'],
                $validated['tlf'] ?? null,
                $validated['observaciones'] ?? null,
            ));
        } catch (\Throwable $e) {
            Log::warning('No se pudo enviar el correo de reserva de la semana #'.$semana->id.': '.$e->getMessage());
        }

        return redirect()->route('casa-rural.index')
            ->with('success', 'Solicitud enviada. Hemos reservado provisionalmente la semana '.$semana->numero_sem.' y nos pondremos en contacto contigo.');
    }
}
