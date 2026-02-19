<?php

namespace App\Http\Controllers;

use App\Models\SemanaCasilla;

class PublicCasaRuralController extends Controller
{
    public function index()
    {
        $semanas = SemanaCasilla::orderBy('anyo')->orderBy('numero_sem')->get();

        return view('public.casa-rural.index', compact('semanas'));
    }
}
