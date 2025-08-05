<?php

namespace App\Http\Controllers;

use App\Models\Plataforma;

class PlataformaPublicController extends Controller
{
    public function index()
    {
        $plataformas = Plataforma::all();
        return view('plataformas.public', compact('plataformas'));
    }
}
