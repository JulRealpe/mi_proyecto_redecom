<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'contraseña' => 'required|string|min:6',
            'rol' => 'required|string|max:50',
        ]);

        $datos = $request->all();
        $datos['contraseña'] = Hash::make($request->contraseña);
        $datos['estado'] = 'activo';

        Usuario::create($datos);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'contraseña' => 'nullable|string|min:6',
            'rol' => 'required|string|max:50',
            'estado' => 'required|string|max:20',
        ]);

        $datos = $request->all();

        if ($request->filled('contraseña')) {
            $datos['contraseña'] = Hash::make($request->contraseña);
        } else {
            unset($datos['contraseña']);
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function inactivar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->estado = 'inactivo';
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario inactivado correctamente.');
    }

    public function activar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->estado = 'activo';
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario activado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
