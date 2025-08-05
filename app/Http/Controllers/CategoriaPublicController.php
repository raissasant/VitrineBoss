<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

class CategoriaPublicController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome')->paginate(12);

        return view('categorias.public', compact('categorias'));
    }
}