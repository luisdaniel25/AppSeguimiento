<?php

namespace App\Http\Controllers;


use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Traer todos los usuarios de la BD
        $usuarios = User::paginate(10);

        // Enviar datos a la vista
        return view('usuarios.index', compact('usuarios'));
    }
}
