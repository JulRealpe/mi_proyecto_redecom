<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // 🔹 Mostrar la lista de usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // 🔹 Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // 🔹 Guardar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'contraseña' => 'required|string|max:255',
            'rol' => 'required|string',
            'estado' => 'required|string',
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // 🔹 Mostrar el formulario para editar un usuario existente
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // 🔹 Actualizar usuario existente
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id,
            'contraseña' => 'required|string|max:255',
            'rol' => 'required|string',
            'estado' => 'required|string',
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // 🔹 Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}